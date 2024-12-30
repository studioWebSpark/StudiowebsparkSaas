<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AuthenticatedSessionController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'remember' => 'boolean',
        ]);

        if (!Auth::attempt($validatedData)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $request->session()->regenerate();

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
}
