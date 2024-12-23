<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Notifications\ProjectSubmitted;
use App\Models\Project;

class ProjectController extends Controller
{
    /**
     * Affiche le wizard de création de projet
     */
    public function wizard()
    {
        return Inertia::render('Website/Project/ProjectWizard', [
            'initialData' => [
                'personal' => [],
                'project' => [],
                'template' => null,
                'options' => [
                    'selectedOptions' => [],
                    'maintenancePlan' => null
                ]
            ]
        ]);
    }

    /**
     * Traite la soumission du projet
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'personal.clientType' => 'required|in:individual,professional',
            'personal.firstName' => 'required|string|max:255',
            'personal.lastName' => 'required|string|max:255',
            'personal.email' => 'required|email|max:255',
            'personal.phone' => 'required|string|max:20',
            'personal.companyName' => 'nullable|required_if:personal.clientType,professional|string|max:255',
            'personal.siret' => 'nullable|required_if:personal.clientType,professional|string|max:14',

            'project.projectType' => 'required|string|max:255',
            'project.budget' => 'required|string|max:255',
            'project.deadline' => 'required|string|max:255',
            'project.description' => 'required|string',
            'project.selectedFeatures' => 'required|array',

            'template.selectedTemplate' => 'required|integer',
            'template.templateDetails' => 'required|array',

            'options.selectedOptions' => 'present|array',
            'options.maintenancePlan' => 'nullable|string|max:255',
        ]);

        try {
            // Création du projet
            $project = Project::create([
                'client_type' => $validated['personal']['clientType'],
                'first_name' => $validated['personal']['firstName'],
                'last_name' => $validated['personal']['lastName'],
                'email' => $validated['personal']['email'],
                'phone' => $validated['personal']['phone'],
                'company_name' => $validated['personal']['companyName'] ?? null,
                'siret' => $validated['personal']['siret'] ?? null,

                'project_type' => $validated['project']['projectType'],
                'budget' => $validated['project']['budget'],
                'deadline' => $validated['project']['deadline'],
                'description' => $validated['project']['description'],
                'selected_features' => $validated['project']['selectedFeatures'],

                'template_id' => $validated['template']['selectedTemplate'],
                'template_details' => $validated['template']['templateDetails'],

                'selected_options' => $validated['options']['selectedOptions'],
                'maintenance_plan' => $validated['options']['maintenancePlan'],

                // Calcul du prix total (à adapter selon votre logique de prix)
                'total_price' => $validated['template']['templateDetails']['price'],
                'monthly_maintenance' => $this->calculateMaintenancePrice($validated['options']['maintenancePlan']),

                'status' => 'pending'
            ]);

            // Envoi de la notification
            $project->notify(new ProjectSubmitted($project));

            // Stockage en session pour la page de confirmation
            session(['project_email' => $project->email]);
            session(['project_reference' => $project->id]);

            return response()->json([
                'message' => 'Projet soumis avec succès',
                'redirect' => route('project.confirmation')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Une erreur est survenue lors de la soumission du projet',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Calcule le prix de la maintenance mensuelle
     */
    private function calculateMaintenancePrice(?string $maintenancePlan): ?float
    {
        $prices = [
            'basic' => 49.00,
            'pro' => 99.00,
            'enterprise' => 199.00
        ];

        return $maintenancePlan ? $prices[$maintenancePlan] : null;
    }

    public function confirmation()
    {
        return Inertia::render('Website/Project/ProjectConfirmation', [
            'email' => session('project_email'),
            'reference' => session('project_reference')
        ]);
    }
}
