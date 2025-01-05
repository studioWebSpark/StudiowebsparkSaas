<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use App\Mail\NewsletterConfirmation;
use App\Mail\NewsletterWelcome;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        try {
            Log::info('Début inscription newsletter', ['email' => $request->email]);

            $existingNewsletter = Newsletter::where('email', $request->email)->first();

            if ($existingNewsletter) {
                return response()->json([
                    'status' => 'info',
                    'message' => 'Cette adresse est déjà inscrite à notre newsletter.'
                ]);
            }

            $newsletter = Newsletter::create([
                'email' => $request->email,
                'token' => Str::random(32),
                'is_active' => true
            ]);

            Log::info('Newsletter créée, tentative d\'envoi email', [
                'newsletter_id' => $newsletter->id
            ]);

            try {
                Mail::to($newsletter->email)
                    ->send(new NewsletterConfirmation($newsletter));

                Log::info('Email de confirmation envoyé avec succès');
            } catch (\Exception $e) {
                Log::error('Erreur envoi email', [
                    'error' => $e->getMessage(),
                    'newsletter_id' => $newsletter->id
                ]);
                throw $e;
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Merci pour votre inscription ! Veuillez vérifier votre email.'
            ]);
        } catch (\Exception $e) {
            Log::error('Erreur inscription newsletter', [
                'error' => $e->getMessage(),
                'email' => $request->email ?? 'non fourni'
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Une erreur est survenue lors de l\'inscription.'
            ], 500);
        }
    }

    public function confirm($token)
    {
        try {
            $newsletter = Newsletter::where('token', $token)->firstOrFail();

            $newsletter->update([
                'confirmed_at' => now(),
                'token' => null,
            ]);

            Log::info('Tentative d\'envoi de l\'email de bienvenue', [
                'email' => $newsletter->email
            ]);

            try {
                Mail::to($newsletter->email)
                    ->send(new NewsletterWelcome());

                Log::info('Email de bienvenue envoyé avec succès');
            } catch (\Exception $e) {
                Log::error('Erreur lors de l\'envoi de l\'email de bienvenue', [
                    'error' => $e->getMessage()
                ]);
            }

            return redirect('/')
                ->with('success', 'Votre inscription à la newsletter a été confirmée !');
        } catch (\Exception $e) {
            Log::error('Erreur lors de la confirmation newsletter', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect('/')
                ->with('error', 'Une erreur est survenue lors de la confirmation.');
        }
    }

    public function unsubscribe($token)
    {
        try {
            $newsletter = Newsletter::where('token', $token)->firstOrFail();

            $newsletter->delete();

            Log::info('Désinscription newsletter et suppression réussie', [
                'email' => $newsletter->email
            ]);

            return redirect('/')
                ->with('success', 'Vous avez été désinscrit de notre newsletter avec succès.');
        } catch (\Exception $e) {
            Log::error('Erreur lors de la désinscription newsletter', [
                'error' => $e->getMessage()
            ]);

            return redirect('/')
                ->with('error', 'Une erreur est survenue lors de la désinscription.');
        }
    }
}
