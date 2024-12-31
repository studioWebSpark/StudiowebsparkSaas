<?php

namespace App\Services;

use App\Models\PendingProject;
use App\Models\ConfirmedProject;
use Illuminate\Support\Facades\Log;
use Stripe\StripeClient;

class ProjectService
{
    protected $stripe;

    public function __construct()
    {
        $this->stripe = new StripeClient(config('services.stripe.secret'));
    }

    public function createPendingProject(array $formData)
    {
        return PendingProject::create([
            'form_data_step_1' => $formData,
            'last_completed_step' => 1,
            'status' => 'pending'
        ]);
    }

    public function processPayment(array $paymentData)
    {
        try {
            $paymentIntent = $this->stripe->paymentIntents->create([
                'amount' => $paymentData['amount'],
                'currency' => 'eur',
                'payment_method' => $paymentData['payment_method_id'],
                'confirmation_method' => 'manual',
                'confirm' => true,
            ]);

            return (object) [
                'success' => true,
                'paymentIntent' => $paymentIntent,
                'amount' => $paymentData['amount']
            ];
        } catch (\Exception $e) {
            Log::error('Erreur de paiement Stripe', [
                'error' => $e->getMessage(),
                'payment_data' => $paymentData
            ]);

            return (object) [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    public function convertToConfirmedProject(PendingProject $pendingProject)
    {
        try {
            $confirmedProject = ConfirmedProject::create([
                'user_id' => $pendingProject->user_id,
                'email' => $pendingProject->email,
                'form_data' => [
                    'step1' => $pendingProject->form_data_step_1,
                    'step2' => $pendingProject->form_data_step_2,
                    'step3' => $pendingProject->form_data_step_3,
                    'step4' => $pendingProject->form_data_step_4,
                ],
                'order_number' => 'PRJ-' . time() . '-' . $pendingProject->id,
                'status' => 'confirmed'
            ]);

            $pendingProject->delete();

            return $confirmedProject;
        } catch (\Exception $e) {
            Log::error('Erreur lors de la conversion du projet', [
                'error' => $e->getMessage(),
                'pending_project_id' => $pendingProject->id
            ]);
            throw $e;
        }
    }
}
