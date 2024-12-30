<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;

class RegisteredUserController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        // Récupérer l'URL de redirection
        $redirect = $request->input('redirect');

        // Vérifier si l'utilisateur vient de la page de validation du projet
        if ($redirect && str_contains($redirect, 'demarrer-projet')) {
            // Vérifier si des données de projet existent dans le localStorage
            $projectData = $request->cookie('projectWizardData');

            if ($projectData) {
                $data = json_decode($projectData, true);

                // Vérifier si les formulaires sont remplis
                if ($this->isProjectDataComplete($data)) {
                    return redirect($redirect);
                }
            }
        }

        // Si pas de données de projet ou formulaires incomplets, rediriger vers la page d'accueil
        return redirect('/');
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
