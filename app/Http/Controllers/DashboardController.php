<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Récupérer TOUTES les commandes (en attente et complétées)
        $recentOrders = Order::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get()
            ->map(function ($order) {
                return [
                    'id' => $order->id,
                    'order_number' => $order->order_number,
                    'total_amount' => $order->total_amount,
                    'status' => $order->status, // 'pending' ou 'completed'
                    'created_at' => $order->created_at,
                    'project_type' => $order->project_type, // Ajout du type de projet
                    'selected_forfait' => $order->selected_forfait // Ajout du forfait
                ];
            });

        // Calculer les statistiques
        $stats = [
            'total_orders' => Order::where('user_id', auth()->id())->count(),
            'total_amount' => Order::where('user_id', auth()->id())
                ->where('status', 'completed')
                ->sum('total_amount'),
            'pending_orders' => Order::where('user_id', auth()->id())
                ->where('status', 'pending')
                ->count()
        ];

        return Inertia::render('Dashboard', [
            'recentOrders' => $recentOrders,
            'stats' => $stats,
            'orderStatuses' => [
                'pending' => 'En attente',
                'completed' => 'Payée'
            ]
        ]);
    }
}
