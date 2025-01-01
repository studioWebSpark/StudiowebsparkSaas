<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use App\Models\PendingProject;
use Illuminate\Support\Facades\Mail;
use App\Mail\PaymentFailed;
use App\Mail\PaymentSuccess;
use App\Mail\PaymentCancelled;
use App\Models\Payment;

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
                'cancel_url' => route('payment.cancel', ['project_id' => $request->project_id]),
                'metadata' => [
                    'project_type' => $request->projectData['projectType'] ?? '',
                    'client_type' => $request->projectData['personal']['clientType'] ?? '',
                    'customer_email' => $request->customer['email'],
                    'customer_name' => $request->customer['name'],
                    'payment_id' => session('pending_payment_id'),
                ]
            ]);

            // Mettre à jour le payment avec l'ID de session Stripe
            Payment::where('id', session('pending_payment_id'))
                ->update(['stripe_session_id' => $session->id]);

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

            // Vérifier si le paiement existe
            $payment = Payment::where('stripe_session_id', $session->id)->first();

            if (!$payment) {
                // Si le paiement n'existe pas, on le crée
                $payment = Payment::create([
                    'user_id' => auth()->id(),
                    'stripe_session_id' => $session->id,
                    'amount' => $session->amount_total / 100,
                    'status' => 'completed',
                    'order_id' => 'CMD-' . strtoupper(substr(uniqid(), -8)),
                    'paid_at' => now(),
                    'project_data' => session('projectData')
                ]);

                Log::info('Nouveau paiement créé:', ['payment_id' => $payment->id]);
            } else {
                // Mettre à jour le paiement existant
                $payment->update([
                    'status' => 'completed',
                    'order_id' => 'CMD-' . strtoupper(substr(uniqid(), -8)),
                    'paid_at' => now()
                ]);

                Log::info('Paiement existant mis à jour:', ['payment_id' => $payment->id]);
            }

            // Envoyer l'email de confirmation
            Mail::to($request->user()->email)->send(new PaymentSuccess(
                $request->user(),
                $payment->order_id,
                session('projectData')
            ));

            // Nettoyer les données de session
            session()->forget(['projectData', 'currentStep']);

            // Rediriger vers la page de succès
            return Inertia::render('Payment/PaymentSuccess', [
                'orderId' => $payment->order_id,
                'amount' => $payment->amount
            ]);
        } catch (\Exception $e) {
            Log::error('Erreur lors du traitement du succès:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->route('dashboard')->with('error', 'Erreur lors de la validation du paiement.');
        }
    }

    public function cancel(Request $request)
    {
        try {
            Log::info('Paiement annulé', [
                'user' => $request->user()->email,
                'timestamp' => now()
            ]);

            // Mettre à jour le statut du paiement
            if ($paymentId = session('pending_payment_id')) {
                Payment::where('id', $paymentId)
                    ->update(['status' => 'cancelled']);
            }

            // Générer un ID de référence pour l'annulation
            $cancelId = 'CANCEL-' . strtoupper(substr(uniqid(), -8));

            // Récupérer les données du projet
            $projectData = session('projectData');

            // Envoyer l'email d'annulation
            Mail::to($request->user()->email)->send(new PaymentCancelled(
                $request->user(),
                $cancelId,
                $projectData
            ));

            // Retourner la vue avec les données
            return Inertia::render('Payment/PaymentCancel', [
                'cancelId' => $cancelId,
                'projectData' => $projectData,
                'timestamp' => now()->format('Y-m-d H:i:s')
            ]);
        } catch (\Exception $e) {
            Log::error('Erreur lors de l\'annulation: ' . $e->getMessage());

            return Inertia::render('Payment/PaymentCancel', [
                'error' => 'Une erreur est survenue lors de l\'annulation'
            ]);
        }
    }

    public function webhook(Request $request)
    {
        $endpoint_secret = config('services.stripe.webhook_secret');
        $payload = @file_get_contents('php://input');
        $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];

        try {
            $event = \Stripe\Webhook::constructEvent(
                $payload,
                $sig_header,
                $endpoint_secret
            );

            switch ($event->type) {
                case 'checkout.session.completed':
                    $session = $event->data->object;

                    $payment = Payment::where('stripe_session_id', $session->id)->first();
                    if ($payment) {
                        $payment->markAsCompleted();

                        // Envoyer une notification à l'administrateur
                        \Notification::route('mail', config('mail.admin_address'))
                            ->notify(new NewPaymentReceived($payment));
                    }
                    break;

                case 'checkout.session.expired':
                    $session = $event->data->object;

                    $payment = Payment::where('stripe_session_id', $session->id)->first();
                    if ($payment) {
                        $payment->markAsCancelled();
                    }
                    break;
            }

            return response()->json(['status' => 'success']);
        } catch (\UnexpectedValueException $e) {
            return response()->json(['error' => 'Webhook error'], 400);
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            return response()->json(['error' => 'Invalid signature'], 400);
        }
    }
}
