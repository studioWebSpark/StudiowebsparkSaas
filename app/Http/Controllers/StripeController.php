<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class StripeController extends Controller
{
    public function createSession(Request $request)
    {
        try {
            Log::info('Début de création de session Stripe', [
                'amount' => $request->amount,
                'email' => $request->customer['email']
            ]);

            Stripe::setApiKey(config('services.stripe.secret'));

            $amount = (int)($request->amount * 100);
            if ($amount <= 0) {
                throw new \Exception('Le montant doit être supérieur à 0');
            }

            $session = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'eur',
                        'unit_amount' => $amount,
                        'product_data' => [
                            'name' => 'Projet Web',
                            'description' => 'Développement site web personnalisé'
                        ],
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => route('payment.success') . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('payment.cancel'),
                'metadata' => [
                    'project_type' => $request->projectData['projectType'] ?? '',
                    'client_type' => $request->projectData['personal']['clientType'] ?? '',
                    'customer_email' => $request->customer['email'],
                    'customer_name' => $request->customer['name']
                ]
            ]);

            Log::info('Session créée avec succès', ['session_id' => $session->id]);

            // S'assurer que la réponse est propre
            return response()->json(['sessionId' => $session->id])
                ->header('Content-Type', 'application/json')
                ->header('X-Content-Type-Options', 'nosniff');
        } catch (\Exception $e) {
            Log::error('Erreur lors de la création de la session Stripe', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'error' => $e->getMessage(),
                'details' => config('app.debug') ? $e->getTraceAsString() : null
            ], 500)
                ->header('Content-Type', 'application/json')
                ->header('X-Content-Type-Options', 'nosniff');
        }
    }

    public function success(Request $request)
    {
        try {
            Log::info('Callback de succès Stripe:', ['session_id' => $request->session_id]);

            Stripe::setApiKey(config('services.stripe.secret'));
            $session = Session::retrieve($request->session_id);

            // Nettoyer les données du projet
            $script = <<<'JS'
                <script>
                    localStorage.removeItem('projectWizardData');
                </script>
            JS;

            // Générer un ID de commande
            $orderId = 'CMD-' . strtoupper(substr(uniqid(), -8));

            // Rediriger vers la page de succès avec les données
            return Inertia::render('Website/Project/PaymentSuccess', [
                'orderId' => $orderId,
                'amount' => $session->amount_total / 100, // Convertir les centimes en euros
            ]);
        } catch (\Exception $e) {
            Log::error('Erreur lors du traitement du succès:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->route('dashboard')->with('error', 'Erreur lors de la validation du paiement.');
        }
    }

    public function cancel()
    {
        return redirect()->route('project.summary')->with('error', 'Paiement annulé.');
    }
}
