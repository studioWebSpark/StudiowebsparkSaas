<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Mail\LoginNotification;
use Illuminate\Support\Facades\Mail;

class AuthenticatedSessionController extends Controller
{
    public function store(Request $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        // Détection simple du navigateur via User-Agent
        $userAgent = $request->header('User-Agent');

        Mail::to(Auth::user()->email)->send(new LoginNotification(
            Auth::user(),
            $request->ip(),
            $userAgent
        ));

        return redirect()->intended(RouteServiceProvider::HOME);
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
