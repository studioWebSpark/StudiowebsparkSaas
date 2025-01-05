<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!auth()->check() || !auth()->user()->is_admin) {
                return redirect('/dashboard');
            }
            return $next($request);
        });
    }

    // Vos méthodes de contrôleur existantes...
}
