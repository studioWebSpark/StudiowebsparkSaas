<?php

namespace App\Http\Controllers;

use App\Mail\OrderConfirmation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;

class PaymentController extends Controller
{
    public function processPayment(Request $request)
    {
        try {
            // Récupérer les données du projet depuis le localStorage
            $projectData = json_decode($request->input('projectData'), true);

            // Logique de paiement ici
            // ... intégration avec votre système de paiement ...

            // Si le paiement est réussi
            if ($paymentSuccessful) {
                // Envoyer l'email de confirmation
                Mail::to($request->user())->send(new OrderConfirmation(
                    $request->user(),
                    $projectData
                ));

                // Rediriger vers la page de succès
                return Inertia::location(route('payment.success'));
            }
        } catch (\Exception $e) {
            return Inertia::location(route('payment.error'));
        }
    }

    public function success(Request $request)
    {
        // Récupérer les données du projet depuis la session
        $projectData = session('projectData');

        // Envoyer l'email de confirmation
        Mail::to($request->user())->send(new OrderConfirmation(
            $request->user(),
            $projectData
        ));

        return Inertia::render('Website/Project/PaymentSuccess');
    }

  

    public function handlePaymentSuccess(Request $request)
    {
        // Récupérer les données du projet
        $projectData = json_decode(session('projectData'), true);

        // Envoyer l'email de confirmation
        Mail::to($request->user())->send(new OrderConfirmation(
            $request->user(),
            $projectData
        ));

        return Inertia::location(route('payment.success'));
    }

    public function cancel()
    {
        return Inertia::render('Website/Project/PaymentCancel');
    }
}
