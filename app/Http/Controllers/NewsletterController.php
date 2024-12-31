<?php

namespace App\Http\Controllers;

use App\Models\NewsletterSubscription;
use App\Mail\Newsletter\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:newsletter_subscriptions,email'
        ]);

        try {
            $subscription = NewsletterSubscription::create([
                'email' => $request->email,
                'is_active' => true,
                'subscribed_at' => now()
            ]);

            // Envoyer l'email de confirmation
            Mail::to($request->email)->send(new Subscription($request->email));

            return response()->json([
                'status' => 'success',
                'message' => 'Inscription à la newsletter réussie'
            ]);
        } catch (\Exception $e) {
            \Log::error('Erreur lors de l\'inscription à la newsletter', [
                'error' => $e->getMessage(),
                'email' => $request->email
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Une erreur est survenue lors de l\'inscription'
            ], 500);
        }
    }

    public function unsubscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:newsletter_subscriptions,email'
        ]);

        try {
            NewsletterSubscription::where('email', $request->email)
                ->update([
                    'is_active' => false,
                    'unsubscribed_at' => now()
                ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Désinscription réussie'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Une erreur est survenue lors de la désinscription'
            ], 500);
        }
    }
}
