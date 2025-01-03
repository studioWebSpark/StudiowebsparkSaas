<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class ClientController extends Controller
{
    public function index()
    {
        try {
            $clients = Order::query()
                ->select(
                    'id',
                    'first_name',
                    'last_name',
                    'email',
                    'phone',
                    'project_type',
                    'project_description'
                )
                ->distinct('email')
                ->latest()
                ->get()
                ->map(function ($client) {
                    return [
                        'id' => $client->id,
                        'name' => $client->first_name . ' ' . $client->last_name,
                        'email' => $client->email,
                        'phone' => $client->phone,
                        'project_type' => $client->project_type,
                        'project_description' => $client->project_description
                    ];
                });

            return Inertia::render('Clients/Index', [
                'clients' => $clients,
                'currentRoute' => 'clients.index'
            ]);
        } catch (\Exception $e) {
            Log::error('Erreur lors de la récupération des clients:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()->with('error', 'Une erreur est survenue lors de la récupération des clients.');
        }
    }
}
