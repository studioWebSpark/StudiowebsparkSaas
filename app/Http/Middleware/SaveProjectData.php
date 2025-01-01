<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SaveProjectData
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->has('projectData')) {
            Log::info('Données du projet reçues dans le middleware:', [
                'projectData' => $request->projectData
            ]);

            session(['projectData' => $request->projectData]);
        }

        return $next($request);
    }
}
