<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RedirectBasedOnContext
{
    public function handle(Request $request, Closure $next)
    {
        // Stocker l'URL précédente dans la session si elle contient "demarrer-projet"
        if (str_contains($request->fullUrl(), 'demarrer-projet')) {
            session(['intended_redirect' => $request->fullUrl()]);
        }

        return $next($request);
    }
}
