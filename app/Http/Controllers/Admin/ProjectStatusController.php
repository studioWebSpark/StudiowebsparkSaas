<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\ProjectStatus;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class ProjectStatusController extends Controller
{
    public function index()
    {
        // Créer automatiquement les ProjectStatus pour les commandes payées qui n'en ont pas
        $paidOrders = Order::whereNotNull('paid_at')
            ->whereDoesntHave('projectStatus')
            ->get();

        foreach ($paidOrders as $order) {
            \Log::info('Création nouveau ProjectStatus', [
                'order_number' => $order->order_number
            ]);

            $order->projectStatus()->create([
                'status' => 'pending',
                'progress' => 0,
                'description' => 'Projet initialisé',
                'order_number' => $order->order_number
            ]);
        }

        // Récupérer tous les projets avec leur statut
        $projects = Order::with(['projectStatus', 'user'])
            ->whereNotNull('paid_at')
            ->latest()
            ->get()
            ->map(function ($order) {
                // S'assurer que nous avons un projectStatus
                $projectStatus = $order->projectStatus;

                if (!$projectStatus) {
                    \Log::warning('ProjectStatus manquant pour la commande', [
                        'order_number' => $order->order_number
                    ]);
                }

                \Log::info('Statut actuel du projet', [
                    'order_number' => $order->order_number,
                    'status' => $projectStatus?->status ?? 'pending'
                ]);

                return [
                    'id' => $order->id,
                    'client_name' => $order->user->name ?? 'Client',
                    'status' => $projectStatus?->status ?? 'pending',
                    'progress' => $projectStatus?->progress ?? 0,
                    'current_step' => $projectStatus?->current_step,
                    'started_at' => $projectStatus?->created_at,
                    'order' => [
                        'id' => $order->id,
                        'order_number' => $order->order_number,
                        'total_amount' => (float) $order->total_amount,
                        'project_type' => $order->project_type,
                        'project_description' => $order->project_description,
                        'selected_forfait' => $order->selected_forfait,
                        'selected_features' => $order->selected_features,
                        'maintenance_plan' => $order->maintenance_plan,
                        'template_name' => $order->template_name,
                        'company_name' => $order->company_name,
                        'email' => $order->email,
                        'phone' => $order->phone,
                        'paid_at' => $order->paid_at
                    ],
                    'project_status' => $projectStatus ? [
                        'id' => $projectStatus->id,
                        'order_number' => $projectStatus->order_number,
                        'status' => $projectStatus->status,
                        'progress' => $projectStatus->progress,
                        'description' => $projectStatus->description
                    ] : [
                        'status' => 'pending',
                        'progress' => 0,
                        'description' => null
                    ]
                ];
            });

        return Inertia::render('Projects/Index', [
            'projects' => $projects
        ]);
    }

    public function update(Request $request, Order $order)
    {
        try {
            $request->validate([
                'status' => ['required', Rule::in(array_keys(ProjectStatus::STATUS_DETAILS))],
                'description' => 'nullable|string|max:500'
            ]);

            $projectStatus = $order->projectStatus;

            if (!$projectStatus) {
                throw new \Exception('Statut du projet non trouvé');
            }

            $projectStatus->update([
                'status' => $request->status,
                'progress' => ProjectStatus::STATUS_DETAILS[$request->status]['progress'] ?? $projectStatus->progress,
                'description' => $request->description,
                'order_number' => $order->order_number
            ]);

            return response()->json([
                'success' => true,
                'project_status' => $projectStatus->fresh()
            ]);
        } catch (\Exception $e) {
            \Log::error('Erreur mise à jour statut', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la mise à jour du statut: ' . $e->getMessage()
            ], 500);
        }
    }

    public function show(Order $order)
    {
        $order->load(['projectStatus', 'user']);

        return Inertia::render('Admin/Projects/Show', [
            'order' => $order,
            'statusOptions' => ProjectStatus::STATUS_DETAILS,
            'currentStatus' => $order->projectStatus
        ]);
    }

    public function updateProgress(Request $request, Order $order)
    {
        $request->validate([
            'progress' => 'required|integer|min:0|max:100'
        ]);

        $order->projectStatus->update([
            'progress' => $request->progress
        ]);

        return response()->json([
            'message' => 'Progression mise à jour avec succès',
            'project_status' => $order->projectStatus->fresh()
        ]);
    }
}
