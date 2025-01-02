<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    private function calculateTotalAmount($projectData)
    {
        // Prix de base du forfait
        $totalAmount = $projectData['forfait']['forfaitDetails']['price'];

        // Ajouter le prix des options si elles existent
        if (!empty($projectData['forfait']['selectedOptions'])) {
            foreach ($projectData['forfait']['selectedOptions'] as $option) {
                if (isset($option['price'])) {
                    $totalAmount += $option['price'];
                }
            }
        }

        Log::info('Calcul du montant total:', [
            'forfaitPrice' => $projectData['forfait']['forfaitDetails']['price'],
            'options' => $projectData['forfait']['selectedOptions'] ?? [],
            'totalAmount' => $totalAmount
        ]);

        return $totalAmount;
    }

    public function store($projectData, $sessionId)
    {
        try {
            Log::info('Création de la commande avec les données:', ['projectData' => $projectData]);

            // Calculer le montant total incluant le forfait et les options
            $totalAmount = $this->calculateTotalAmount($projectData);

            $order = Order::create([
                'user_id' => auth()->id(),
                'order_number' => 'CMD-' . strtoupper(Str::random(8)),
                'total_amount' => $totalAmount, // Utiliser le montant total calculé
                'status' => 'completed',
                'stripe_session_id' => $sessionId,
                'paid_at' => now(),

                // Informations client
                'client_type' => $projectData['personal']['clientType'],
                'first_name' => $projectData['personal']['firstName'],
                'last_name' => $projectData['personal']['lastName'],
                'email' => $projectData['personal']['email'],
                'phone' => $projectData['personal']['phone'],
                'activity' => $projectData['personal']['activity'] ?? null,
                'company_name' => $projectData['personal']['companyName'] ?? null,
                'siren' => $projectData['personal']['siren'] ?? null,

                // Informations projet
                'project_type' => $projectData['project']['projectType'],
                'project_description' => $projectData['project']['description'],
                'selected_features' => $projectData['project']['selectedFeatures'],

                // Forfait et options
                'selected_forfait' => $projectData['forfait']['selectedForfait'],
                'forfait_price' => $projectData['forfait']['forfaitDetails']['price'],
                'selected_options' => $projectData['forfait']['selectedOptions'] ?? [],
                'maintenance_plan' => $projectData['forfait']['maintenancePlan'] ?? null,

                // Template
                'template_name' => $projectData['template']['selectedTemplates'][0] ?? null,
                'template_details' => $projectData['template']
            ]);

            Log::info('Commande créée avec succès:', [
                'order_id' => $order->id,
                'total_amount' => $totalAmount,
                'forfait_price' => $projectData['forfait']['forfaitDetails']['price'],
                'options' => $projectData['forfait']['selectedOptions'] ?? []
            ]);

            return $order;
        } catch (\Exception $e) {
            Log::error('Erreur lors de la création de la commande:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }
}
