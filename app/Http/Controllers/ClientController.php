<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use App\Mail\SupportRequest;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Mail\ClientSupport;

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

    public function dashboard()
    {
        try {
            $orders = Order::where('user_id', auth()->id())
                ->latest()
                ->take(5)
                ->get();

            $projects = Order::where('user_id', auth()->id())
                ->with('projectStatus')
                ->latest()
                ->take(5)
                ->get();

            $stats = [
                'total_orders' => Order::where('user_id', auth()->id())->count(),
                'active_projects' => Order::where('user_id', auth()->id())
                    ->whereHas('projectStatus', function ($query) {
                        $query->whereNotIn('status', ['completed', 'cancelled']);
                    })->count(),
                'completed_projects' => Order::where('user_id', auth()->id())
                    ->whereHas('projectStatus', function ($query) {
                        $query->where('status', 'completed');
                    })->count()
            ];

            return Inertia::render('Client/Dashboard', [
                'orders' => $orders,
                'projects' => $projects,
                'stats' => $stats,
                'auth' => [
                    'user' => auth()->user()
                ]
            ]);
        } catch (\Exception $e) {
            Log::error('Erreur lors de la récupération du dashboard:', [
                'error' => $e->getMessage()
            ]);
            return redirect()->back()->with('error', 'Une erreur est survenue.');
        }
    }

    public function orders()
    {
        try {
            $orders = Order::where('user_id', auth()->id())
                ->latest()
                ->get();

            return Inertia::render('Client/Orders/Index', [
                'orders' => $orders
            ]);
        } catch (\Exception $e) {
            Log::error('Erreur lors de la récupération des commandes:', [
                'error' => $e->getMessage()
            ]);
            return redirect()->back()->with('error', 'Une erreur est survenue.');
        }
    }

    public function projects()
    {
        try {
            $projects = Order::where('user_id', auth()->id())
                ->with('projectStatus')
                ->latest()
                ->get()
                ->map(function ($project) {
                    $projectStatus = $project->projectStatus;
                    return [
                        'id' => $project->id,
                        'order_number' => $project->order_number,
                        'project_type' => $project->project_type,
                        'status' => $projectStatus ? $projectStatus->status : 'pending',
                        'created_at' => $project->created_at,
                        'description' => $projectStatus ? $projectStatus->description : null,
                        'status_changed_at' => $projectStatus ? $projectStatus->status_changed_at : null
                    ];
                });

            return Inertia::render('Client/Projects/Index', [
                'projects' => $projects,
                'statusLabels' => [
                    'pending' => 'En attente',
                    'development' => 'En développement',
                    'finalizing' => 'Finalisation',
                    'production' => 'En production',
                    'completed' => 'Terminé'
                ]
            ]);
        } catch (\Exception $e) {
            Log::error('Erreur lors de la récupération des projets:', [
                'error' => $e->getMessage()
            ]);
            return redirect()->back()->with('error', 'Une erreur est survenue.');
        }
    }

    public function support()
    {
        return Inertia::render('Client/Support/Index', [
            'auth' => [
                'user' => auth()->user()
            ]
        ]);
    }

    public function sendSupport(Request $request)
    {
        try {
            $user = auth()->user();

            $request->validate([
                'subject' => 'required|string',
                'message' => 'required|string'
            ]);

            Mail::to('studiowebspark@gmail.com')
                ->send(new ClientSupport(
                    $user,
                    $request->subject,
                    $request->message
                ));

            return response()->json([
                'success' => true,
                'message' => 'Votre message a été envoyé avec succès.'
            ]);
        } catch (\Exception $e) {
            Log::error('Erreur lors de l\'envoi de l\'email de support', [
                'error' => $e->getMessage(),
                'user_id' => auth()->id()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue lors de l\'envoi du message.'
            ], 500);
        }
    }

    public function showProject(Order $project)
    {
        try {
            // Vérifier que le projet appartient à l'utilisateur
            if ($project->user_id !== auth()->id()) {
                abort(403);
            }

            return Inertia::render('Client/Projects/Show', [
                'project' => [
                    'id' => $project->id,
                    'project_type' => $project->project_type,
                    'project_description' => $project->project_description,
                    'status' => $project->status,
                    'created_at' => $project->created_at,
                    'total_amount' => $project->total_amount,
                ]
            ]);
        } catch (\Exception $e) {
            Log::error('Erreur lors de l\'affichage du projet:', [
                'error' => $e->getMessage()
            ]);
            return redirect()->back()->with('error', 'Une erreur est survenue.');
        }
    }

    public function showOrder(Order $order)
    {
        try {
            // Vérifier que la commande appartient à l'utilisateur
            if ($order->user_id !== auth()->id()) {
                abort(403);
            }

            return Inertia::render('Client/Orders/Show', [
                'order' => [
                    'id' => $order->id,
                    'order_number' => $order->order_number,
                    'project_type' => $order->project_type,
                    'total_amount' => $order->total_amount,
                    'status' => $order->status,
                    'created_at' => $order->created_at,
                    'selected_forfait' => $order->selected_forfait,
                    'selected_options' => $order->selected_options,
                ]
            ]);
        } catch (\Exception $e) {
            Log::error('Erreur lors de l\'affichage de la commande:', [
                'error' => $e->getMessage()
            ]);
            return redirect()->back()->with('error', 'Une erreur est survenue.');
        }
    }
}
