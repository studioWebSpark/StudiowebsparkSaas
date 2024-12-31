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

            // Envoyer l'email de projet en attente à la dernière étape
            if ($validatedData['step'] == 4) {
                Mail::to($project->email)->send(new ProjectPending(
                    $project,
                    auth()->user()
                ));
            }

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

    public function wizard()
    {
        return Inertia::render('Website/Project/ProjectWizard', [
            'initialStep' => request()->query('step', 0),
            'projectId' => request()->query('project_id'),
        ]);
    }
}
