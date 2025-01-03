<?php

namespace App\Http\Controllers;

use App\Services\ProjectService;
use App\Mail\ProjectPending;
use App\Mail\ProjectConfirmed;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Models\PendingProject;
use Inertia\Inertia;
use App\Mail\PaymentSuccess;
use App\Mail\PaymentFailed;
use App\Models\Payment;
use App\Models\Order;
use App\Models\Project;
use App\Models\ProjectStatus;
use Illuminate\Validation\Rule;

class ProjectController extends Controller
{
    protected $projectService;

    public function __construct(ProjectService $projectService)
    {
        $this->projectService = $projectService;
    }

    public function saveStep(Request $request)
    {
        $validatedData = $request->validate([
            'step' => 'required|integer|between:1,4',
            'project_id' => 'nullable|exists:pending_projects,id',
            'form_data' => 'required|array'
        ]);

        try {
            $project = $validatedData['project_id']
                ? PendingProject::findOrFail($validatedData['project_id'])
                : $this->projectService->createPendingProject($validatedData['form_data']);

            $project->update([
                'form_data_step_' . $validatedData['step'] => $validatedData['form_data'],
                'last_completed_step' => $validatedData['step']
            ]);



            return response()->json([
                'status' => 'success',
                'project_id' => $project->id
            ]);
        } catch (\Exception $e) {
            Log::error('Erreur lors de la sauvegarde', [
                'error' => $e->getMessage(),
                'step' => $validatedData['step']
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Une erreur est survenue'
            ], 500);
        }
    }

    public function handlePayment(Request $request)
    {
        $validatedData = $request->validate([
            'project_id' => 'required|exists:pending_projects,id',
            'payment_data' => 'required|array'
        ]);

        $pendingProject = PendingProject::findOrFail($validatedData['project_id']);

        try {
            $confirmedProject = $this->projectService->convertToConfirmedProject(
                $pendingProject,
                $validatedData['payment_data']
            );

            \Log::info('Tentative d\'envoi d\'email de confirmation', [
                'email' => $confirmedProject->email,
                'project_id' => $confirmedProject->id
            ]);

            try {
                Mail::to($confirmedProject->email)->send(new ProjectConfirmed($confirmedProject));
                \Log::info('Email de confirmation envoyé avec succès');
            } catch (\Exception $mailError) {
                \Log::error('Erreur lors de l\'envoi de l\'email : ' . $mailError->getMessage());
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Projet confirmé avec succès',
                'order_number' => $confirmedProject->order_number,
                'reset_form' => true
            ]);
        } catch (\Exception $e) {
            \Log::error('Erreur lors du paiement : ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Erreur lors du paiement'
            ], 500);
        }
    }

    public function resumeProject($projectId)
    {
        $project = PendingProject::findOrFail($projectId);

        return response()->json([
            'status' => 'success',
            'project' => $project,
            'redirect_to_step' => 4
        ]);
    }

    public function showProjectForm(Request $request, $projectId = null)
    {
        $step = $request->query('step', 1);

        if ($projectId) {
            $project = PendingProject::findOrFail($projectId);
            $step = $request->query('from_email') ? 4 : $step;

            return view('project.form', [
                'step' => $step,
                'project' => $project
            ]);
        }

        return view('project.form', ['step' => $step]);
    }

    public function getPendingProjects()
    {
        $projects = PendingProject::where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($projects);
    }

    public function wizard(Request $request)
    {
        // Vérifier si on vient d'un paiement réussi
        if (session()->has('payment_success')) {
            // Nettoyer toutes les données du projet
            session()->forget([
                'projectData',
                'currentStep',
                'formData',
                'personal',
                'project',
                'requirements',
                'payment'
            ]);

            // Script pour nettoyer le localStorage
            $cleanupScript = <<<'JS'
                <script>
                    localStorage.removeItem('projectWizardData');
                    localStorage.removeItem('currentStep');
                    localStorage.removeItem('formData');
                    localStorage.removeItem('personal');
                    localStorage.removeItem('project');
                    localStorage.removeItem('requirements');
                    localStorage.removeItem('payment');
                </script>
            JS;

            return Inertia::render('Website/Project/ProjectWizard', [
                'step' => 1,
                'cleanupScript' => $cleanupScript
            ]);
        }

        // Votre code existant pour le wizard...
        return Inertia::render('Website/Project/ProjectWizard', [
            'step' => $request->query('step', 1),
            'projectData' => session('projectData', [])
        ]);
    }

    public function store(Request $request)
    {
        // Votre validation existante...

        // Créer un paiement en attente
        $payment = Payment::create([
            'user_id' => auth()->id(),
            'amount' => $request->amount,
            'status' => 'pending',
            'project_data' => $request->all(),
        ]);

        // Stocker l'ID du paiement en session
        session(['pending_payment_id' => $payment->id]);

        // Votre logique existante...
    }

    public function saveData(Request $request)
    {
        try {
            Log::info('Sauvegarde des données du projet:', [
                'projectData' => $request->projectData
            ]);

            session(['projectData' => $request->projectData]);

            return response()->json([
                'success' => true,
                'message' => 'Données sauvegardées avec succès'
            ]);
        } catch (\Exception $e) {
            Log::error('Erreur lors de la sauvegarde des données:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la sauvegarde des données'
            ], 500);
        }
    }

    public function index()
    {
        $completedOrders = Order::where('status', 'completed')
            ->with('project')
            ->latest()
            ->get()
            ->map(function ($order) {
                return [
                    'id' => $order->project?->id,
                    'client_name' => $order->first_name . ' ' . $order->last_name,
                    'status' => $order->project?->status,
                    'progress' => $order->project?->progress,
                    'current_step' => $order->project?->current_step_description,
                    'started_at' => $order->project?->started_at?->format('d/m/Y'),
                    'order' => [
                        'order_number' => $order->order_number,
                        'total_amount' => $order->total_amount,
                        'project_type' => $order->project_type,
                        'project_description' => $order->project_description,
                        'selected_forfait' => $order->selected_forfait,
                        'selected_features' => $order->selected_features,
                        'maintenance_plan' => $order->maintenance_plan,
                        'template_name' => $order->template_name,
                        'company_name' => $order->company_name,
                        'email' => $order->email,
                        'phone' => $order->phone,
                        'paid_at' => $order->paid_at?->format('d/m/Y'),
                    ]
                ];
            });

        $successfulPayments = Order::where('status', 'completed')
            ->count();

        $totalAmount = Order::where('status', 'completed')
            ->sum('total_amount');

        // Ajout des étapes du projet
        $projectSteps = [
            'pending' => 'En attente',
            'development' => 'En cours de développement',
            'finalizing' => 'Finalisation du développement',
            'production' => 'En production',
            'completed' => 'Terminé'
        ];

        // Ajoutez ceci temporairement pour déboguer
        \Log::info('Structure des projets:', [
            'projects' => $completedOrders->toArray()
        ]);

        return Inertia::render('Projects/Index', [
            'projects' => $completedOrders,
            'successfulPayments' => $successfulPayments,
            'totalAmount' => $totalAmount,
            'projectSteps' => $projectSteps // Ajout des étapes
        ]);
    }

    public function create(Order $order)
    {
        // Créer un nouveau projet quand la commande est payée
        $project = Project::create([
            'order_id' => $order->id,
            'status' => 'pending',
            'progress' => 0,
            'milestones' => [
                'conception' => false,
                'development' => false,
                'testing' => false,
                'deployment' => false
            ],
            'started_at' => now(),
        ]);

        // Envoyer un email au client
        $this->sendProjectStartedEmail($order);

        return redirect()->route('projects.show', $project);
    }

    public function updateProgress(Project $project, Request $request)
    {
        $request->validate([
            'progress' => 'required|integer|min:0|max:100',
            'current_step_description' => 'required|string'
        ]);

        $project->update([
            'progress' => $request->progress,
            'current_step_description' => $request->current_step_description
        ]);

        // Envoyer un email de mise à jour au client
        $this->sendProgressUpdateEmail($project);

        return back();
    }

    private function sendProjectStartedEmail(Order $order)
    {
        // Logique d'envoi d'email pour le début du projet
    }

    private function sendProgressUpdateEmail(Project $project)
    {
        // Logique d'envoi d'email pour la mise à jour du projet
    }

    public function updateProjectStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => ['required', 'string', Rule::in(array_keys(ProjectStatus::STATUS_DETAILS))],
            'description' => 'nullable|string'
        ]);

        $projectStatus = $order->projectStatus;
        $projectStatus->updateStatus($request->status, $request->description);

        return response()->json([
            'message' => 'Statut du projet mis à jour avec succès',
            'project_status' => $projectStatus->fresh()
        ]);
    }
}
