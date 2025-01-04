<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckExistingOrder
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->is('demarrer-projet*')) {
            $user = $request->user();

            if ($user && $user->hasOrder()) {
                return redirect()->route('compte-existant');
            }
        }

        return $next($request);
    }
}
