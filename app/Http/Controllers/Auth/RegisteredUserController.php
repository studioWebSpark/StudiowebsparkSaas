<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Mail\Auth\WelcomeEmail;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Illuminate\Support\Facades\Log;

class RegisteredUserController extends Controller
{
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|confirmed|min:8',
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            // Log avant l'envoi
            Log::info('Tentative d\'envoi d\'email de bienvenue', [
                'user_id' => $user->id,
                'email' => $user->email
            ]);

            // Envoi de l'email de bienvenue
            Mail::to($user->email)->send(new WelcomeEmail($user));

            // Log après l'envoi
            Log::info('Email de bienvenue envoyé');

            event(new Registered($user));

            Auth::login($user);

            return redirect(RouteServiceProvider::HOME);
        } catch (\Exception $e) {
            Log::error('Erreur lors de l\'envoi de l\'email de bienvenue', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }

    private function isProjectDataComplete($data): bool
    {
        // Vérifier si toutes les données requises sont présentes
        return isset($data['personal']) &&
            isset($data['project']) &&
            isset($data['forfait']) &&
            isset($data['template']) &&
            !empty($data['personal']['firstName']) &&
            !empty($data['personal']['lastName']) &&
            !empty($data['personal']['email']) &&
            !empty($data['project']['projectName']) &&
            !empty($data['forfait']['selectedForfait']);
    }

    // ... autres méthodes ...
}
