<?php

namespace App\Http\Controllers;

use App\Mail\PaymentCancelled;
use App\Mail\PaymentSuccess;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use App\Models\Payment;
use Illuminate\Support\Facades\Mail;
use App\Mail\PaymentSuccessEmail;
use App\Models\Order;
use App\Models\Project;
use App\Models\ProjectStatus;
use App\Mail\OrderConfirmation;

class StripeController extends Controller
{
    public function createSession(Request $request)
    {
        try {
            Log::info('1. Création session Stripe - Données reçues:', [
                'amount' => $request->amount,
                'projectData' => $request->projectData
            ]);

            Stripe::setApiKey(config('services.stripe.secret'));
            $amount = (int)($request->amount * 100);

            // Stocker les données en session
            session(['projectData' => $request->projectData]);
            Log::info('2. Données stockées en session');

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
                    'customer_email' => $request->customer['email'],
                    'customer_name' => $request->customer['name']
                ]
            ]);

            Log::info('3. Session Stripe créée:', ['session_id' => $session->id]);
            return response()->json(['sessionId' => $session->id]);
        } catch (\Exception $e) {
            Log::error('Erreur createSession:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function success(Request $request)
    {
        try {
            Log::info('Début du traitement success', [
                'session_id' => $request->session_id,
                'user_email' => auth()->user()->email
            ]);

            Log::info('1. État initial de la session:', [
                'session_data' => session()->all(),
                'user_id' => auth()->id()
            ]);

            Log::info('1. Début du traitement success avec session_id:', [
                'session_id' => $request->session_id
            ]);

            if (!$request->session_id) {
                throw new \Exception('Session ID manquant');
            }

            Stripe::setApiKey(config('services.stripe.secret'));
            $session = Session::retrieve($request->session_id);
            $projectData = session('projectData');

            // Créer la commande d'abord
            $orderController = new OrderController();
            $order = $orderController->store($projectData, $request->session_id);

            // Créer le paiement UNE SEULE FOIS avec le bon order_number
            $payment = Payment::updateOrCreate(
                ['stripe_session_id' => $request->session_id],
                [
                    'user_id' => auth()->id(),
                    'order_id' => $order->id,
                    'order_number' => $order->order_number,
                    'amount' => $session->amount_total / 100,
                    'status' => 'completed',
                    'project_data' => $projectData,
                    'paid_at' => now()
                ]
            );

            // Stocker le paiement dans la session pour le récupérer dans le wizard
            session(['payment_info' => [
                'id' => $payment->id,
                'status' => 'completed',
                'amount' => $payment->amount,
                'order_number' => $payment->order_number
            ]]);

            Log::info('Tentative d\'envoi de l\'email', [
                'to' => auth()->user()->email,
                'order_number' => $order->order_number
            ]);

            try {
                Mail::to(auth()->user()->email)
                    ->send(new PaymentSuccess(
                        auth()->user(),
                        $order->order_number,
                        $projectData,
                        $payment->amount
                    ));

                Log::info('Email envoyé avec succès');
            } catch (\Exception $e) {
                Log::error('Erreur lors de l\'envoi de l\'email', [
                    'error' => $e->getMessage()
                ]);
            }

            // Nettoyer toutes les données de session
            session()->forget([
                'projectData',
                'formData',
                'currentStep',
                'wizardState',
                'pending_payment_id',
                'selectedTemplate',
                'selectedForfait',
                'selectedOptions'
            ]);

            Log::info('2. État après nettoyage de la session:', [
                'session_data' => session()->all(),
                'cleaned_keys' => [
                    'projectData' => session()->has('projectData'),
                    'formData' => session()->has('formData'),
                    'currentStep' => session()->has('currentStep'),
                    'wizardState' => session()->has('wizardState')
                ]
            ]);

            $responseData = [
                'session_id' => $request->session_id,
                'amount' => $session->amount_total / 100,
                'status' => 'success',
                'customer' => [
                    'first_name' => $projectData['personal']['firstName'] ?? '',
                    'last_name' => $projectData['personal']['lastName'] ?? '',
                    'email' => $projectData['personal']['email'] ?? '',
                    'phone' => $projectData['personal']['phone'] ?? '',
                    'company_name' => $projectData['personal']['companyName'] ?? null,
                    'activity' => $projectData['personal']['activity'] ?? null,
                    'siren' => $projectData['personal']['siren'] ?? null
                ],
                'project' => [
                    'type' => $projectData['project']['projectType'] ?? '',
                    'description' => $projectData['project']['description'] ?? '',
                    'selected_features' => $projectData['project']['selectedFeatures'] ?? [],
                    'forfait' => $projectData['forfait']['selectedForfait'] ?? '',
                    'forfait_details' => $projectData['forfait']['forfaitDetails'] ?? [],
                    'selected_options' => $projectData['forfait']['selectedOptions'] ?? [],
                    'template' => $projectData['template']['selectedTemplates'][0] ?? null
                ],
                'order' => [
                    'number' => $order->order_number,
                    'date' => now()->format('d/m/Y')
                ],
                'payment' => $payment,
                'resetWizard' => true,
                'resetValidationStates' => true
            ];

            Log::info('3. Données envoyées au frontend:', [
                'resetWizard' => true,
                'resetValidationStates' => true,
                'user_id' => auth()->id(),
                'payment_id' => $payment->id ?? null
            ]);

            return Inertia::render('Payment/PaymentSuccess', $responseData);
        } catch (\Exception $e) {
            Log::error('Erreur dans success', [
                'error' => $e->getMessage()
            ]);
            return redirect()->route('dashboard')
                ->with('error', 'Une erreur est survenue lors du traitement du paiement.');
        }
    }

    public function cancel(Request $request)
    {
        try {
            Log::info('Début de l\'annulation du paiement', [
                'user' => auth()->check() ? auth()->user()->email : 'Non authentifié',
                'timestamp' => now()
            ]);

            // Vérifier si l'utilisateur est authentifié
            if (!auth()->check()) {
                throw new \Exception('Utilisateur non authentifié');
            }

            // Mettre à jour le statut du paiement avec plus de logging
            if ($paymentId = session('pending_payment_id')) {
                Log::info('Mise à jour du paiement', ['payment_id' => $paymentId]);

                $payment = Payment::where('id', $paymentId)->first();
                if ($payment) {
                    $payment->update(['status' => 'cancelled']);
                }
            }

            // Récupérer et logger les données du projet
            $projectData = session('projectData');
            Log::info('Données du projet récupérées', ['projectData' => $projectData]);

            // Générer l'ID d'annulation
            $cancelId = 'CLC-' . strtoupper(substr(uniqid(), -6));

            // Envoyer l'email avec try/catch dédié
            try {
                Mail::to(auth()->user()->email)
                    ->send(new PaymentCancelled(
                        auth()->user(),
                        $cancelId,
                        $projectData ?? []
                    ));

                Log::info('Email d\'annulation envoyé avec succès', [
                    'to' => auth()->user()->email,
                    'cancelId' => $cancelId
                ]);
            } catch (\Exception $emailError) {
                Log::error('Erreur lors de l\'envoi de l\'email d\'annulation', [
                    'error' => $emailError->getMessage(),
                    'trace' => $emailError->getTraceAsString()
                ]);
            }

            return Inertia::render('Payment/PaymentCancel', [
                'cancelId' => $cancelId,
                'projectData' => $projectData,
                'timestamp' => now()->format('Y-m-d H:i:s')
            ]);
        } catch (\Exception $e) {
            Log::error('Erreur lors de l\'annulation du paiement', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return Inertia::render('Payment/PaymentCancel', [
                'error' => 'Une erreur est survenue lors de l\'annulation'
            ]);
        }
    }

    public function checkPaymentStatus()
    {
        try {
            $payment = Payment::where('user_id', auth()->id())
                ->where('status', 'completed')
                ->latest()
                ->first();

            Log::info('Vérification du statut de paiement', [
                'user_id' => auth()->id(),
                'payment_found' => $payment ? true : false,
                'payment_details' => $payment
            ]);

            return response()->json([
                'hasCompletedPayment' => $payment !== null,
                'paymentInfo' => $payment ? [
                    'id' => $payment->id,
                    'status' => 'completed',
                    'amount' => $payment->amount,
                    'order_number' => $payment->order_number,
                    'created_at' => $payment->created_at
                ] : null
            ]);
        } catch (\Exception $e) {
            Log::error('Erreur lors de la vérification du statut de paiement', [
                'error' => $e->getMessage()
            ]);
            return response()->json([
                'hasCompletedPayment' => false,
                'error' => 'Erreur lors de la vérification du paiement'
            ], 500);
        }
    }

    public function webhook(Request $request)
    {
        try {
            $payload = $request->getContent();
            $sig_header = $request->header('Stripe-Signature');
            $endpoint_secret = config('services.stripe.webhook_secret');

            $event = \Stripe\Webhook::constructEvent(
                $payload,
                $sig_header,
                $endpoint_secret
            );

            if ($event->type === 'checkout.session.completed') {
                $session = $event->data->object;

                \Log::info('Webhook Stripe reçu:', ['session' => $session]);

                $order = Order::where('stripe_session_id', $session->id)->first();

                if ($order) {
                    // 1. Mettre à jour le statut de la commande
                    $order->update([
                        'status' => 'completed',
                        'paid_at' => now(),
                        'payment_id' => $session->payment_intent
                    ]);

                    // 2. Créer l'entrée dans project_status
                    $projectStatus = ProjectStatus::create([
                        'order_id' => $order->id,
                        'order_number' => $order->order_number,
                        'status' => 'pending',
                        'progress' => 0,
                        'description' => 'Nouveau projet'
                    ]);

                    \Log::info('ProjectStatus créé:', [
                        'order_number' => $order->order_number,
                        'project_status_id' => $projectStatus->id
                    ]);

                    // 3. Envoyer l'email de confirmation
                    Mail::to($order->email)->send(new OrderConfirmation($order));

                    \Log::info('Traitement terminé avec succès', [
                        'order_id' => $order->id,
                        'project_status_id' => $projectStatus->id
                    ]);
                }
            }

            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            \Log::error('Erreur Webhook:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
