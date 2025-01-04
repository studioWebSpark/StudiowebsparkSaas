<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

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
                'total_amount' => $totalAmount,
                'status' => 'pending',
                'stripe_session_id' => $sessionId,
                'paid_at' => null,

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
                'status' => 'pending'
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

    public function show(Order $order)
    {
        try {
            // Vérifier si l'utilisateur est autorisé à voir cette commande
            if (!auth()->user()->is_admin && $order->user_id !== auth()->id()) {
                abort(403, 'Non autorisé');
            }

            // Calculer le total des options
            $optionsTotal = collect($order->selected_options)->sum('price');

            Log::info('Détails des prix de la commande:', [
                'order_id' => $order->id,
                'forfait_price' => $order->forfait_price,
                'options_total' => $optionsTotal,
                'total_price' => $order->total_amount
            ]);

            // Utiliser la structure existante de $orderData
            $orderData = [
                'id' => $order->id,
                'order_number' => $order->order_number,
                'total_amount' => $order->total_amount,
                'status' => $order->status,
                'created_at' => $order->created_at->format('d/m/Y'),

                // Informations client
                'client_type' => $order->client_type,
                'first_name' => $order->first_name,
                'last_name' => $order->last_name,
                'email' => $order->email,
                'phone' => $order->phone,
                'company_name' => $order->company_name,
                'siren' => $order->siren,
                'activity' => $order->activity,

                // Informations projet
                'project_type' => $order->project_type,
                'project_description' => $order->project_description,
                'selected_features' => $order->selected_features,

                // Forfait et options
                'selected_forfait' => $order->selected_forfait,
                'forfait_price' => $order->forfait_price,
                'selected_options' => $order->selected_options,
                'maintenance_plan' => $order->maintenance_plan,

                // Template
                'template_name' => $order->template_name,
                'template_details' => $order->template_details
            ];

            return Inertia::render('Orders/Show', [
                'order' => $orderData,
                'orderStatus' => [
                    'pending' => 'En attente',
                    'completed' => 'Payée',
                    'cancelled' => 'Annulée'
                ]
            ]);
        } catch (\Exception $e) {
            Log::error('Erreur lors de l\'affichage de la commande:', [
                'order_id' => $order->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()->with('error', 'Une erreur est survenue lors de l\'affichage de la commande.');
        }
    }

    public function success(Request $request)
    {
        try {
            $session = $request->session()->get('stripe_session');
            $order = Order::where('stripe_session_id', $session)->first();

            if (!$order) {
                abort(404, 'Commande non trouvée');
            }

            // Calculer le total des options
            $optionsTotal = collect($order->selected_options)->sum('price');

            Log::info('Détails de la commande après paiement:', [
                'order_id' => $order->id,
                'forfait_price' => $order->forfait_price,
                'options_total' => $optionsTotal,
                'total_price' => $order->total_amount
            ]);

            // Utiliser le même format de données que la méthode show
            $orderData = [
                'id' => $order->id,
                'order_number' => $order->order_number,
                'total_amount' => $order->total_amount,
                'status' => $order->status,
                'created_at' => $order->created_at->format('d/m/Y'),

                // Informations client
                'client_type' => $order->client_type,
                'first_name' => $order->first_name,
                'last_name' => $order->last_name,
                'email' => $order->email,
                'phone' => $order->phone,
                'company_name' => $order->company_name,
                'siren' => $order->siren,
                'activity' => $order->activity,

                // Informations projet
                'project_type' => $order->project_type,
                'project_description' => $order->project_description,
                'selected_features' => $order->selected_features,

                // Forfait et options
                'selected_forfait' => $order->selected_forfait,
                'forfait_price' => $order->forfait_price,
                'selected_options' => $order->selected_options,
                'maintenance_plan' => $order->maintenance_plan,

                // Template
                'template_name' => $order->template_name,
                'template_details' => $order->template_details
            ];

            return Inertia::render('Orders/Success', [
                'order' => $orderData,
                'orderStatus' => [
                    'pending' => 'En attente',
                    'completed' => 'Payée',
                    'cancelled' => 'Annulée'
                ]
            ]);
        } catch (\Exception $e) {
            Log::error('Erreur lors de l\'affichage de la confirmation de commande:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->route('dashboard')->with('error', 'Une erreur est survenue lors de l\'affichage de la confirmation de commande.');
        }
    }

    public function index()
    {
        try {
            $orders = Order::query()
                ->when(!auth()->user()->is_admin, function ($query) {
                    return $query->where('user_id', auth()->id());
                })
                ->latest()
                ->get();

            $stats = [
                'total_orders' => $orders->count(),
                'total_amount' => $orders->sum('total_amount'),
                'pending_orders' => $orders->where('status', 'pending')->count()
            ];

            return Inertia::render('Orders/Index', [
                'orders' => $orders->map(function ($order) {
                    return [
                        'id' => $order->id,
                        'order_number' => $order->order_number,
                        'created_at' => $order->created_at->format('d/m/Y'),
                        'status' => $order->status,
                        'total_amount' => $order->total_amount,
                        'client_name' => $order->first_name . ' ' . $order->last_name
                    ];
                }),
                'stats' => $stats,
                'currentRoute' => 'orders.index'  // Ajout pour le suivi de la route active
            ]);
        } catch (\Exception $e) {
            Log::error('Erreur lors de la récupération des commandes:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()->with('error', 'Une erreur est survenue lors de la récupération des commandes.');
        }
    }

    public function checkExistingOrder(Request $request)
    {
        try {
            // Vérifier s'il y a une commande en cours pour l'utilisateur
            $hasActiveOrder = Order::where('user_id', auth()->id())
                ->whereIn('status', ['pending', 'processing'])
                ->exists();

            return response()->json([
                'hasActiveOrder' => $hasActiveOrder
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'hasActiveOrder' => false,
                'error' => 'Erreur lors de la vérification'
            ]);
        }
    }

    public function handleStripeWebhook(Request $request)
    {
        $payload = $request->getContent();
        $sig_header = $request->header('Stripe-Signature');
        $endpoint_secret = config('services.stripe.webhook_secret');

        try {
            $event = \Stripe\Webhook::constructEvent(
                $payload,
                $sig_header,
                $endpoint_secret
            );

            if ($event->type === 'checkout.session.completed') {
                $session = $event->data->object;

                // Mettre à jour la commande une fois le paiement confirmé
                $order = Order::where('stripe_session_id', $session->id)->first();

                if ($order) {
                    $order->update([
                        'status' => 'completed',
                        'paid_at' => now(),
                        'payment_intent_id' => $session->payment_intent
                    ]);

                    Log::info('Paiement confirmé pour la commande:', [
                        'order_id' => $order->id,
                        'stripe_session' => $session->id
                    ]);
                }
            }

            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            Log::error('Erreur webhook Stripe:', [
                'error' => $e->getMessage()
            ]);
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
