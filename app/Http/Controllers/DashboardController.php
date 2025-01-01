<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        // Récupérer les statistiques
        $stats = [
            'total_orders' => Order::where('user_id', $userId)->count(),
            'total_amount' => Order::where('user_id', $userId)
                ->where('status', 'completed')
                ->sum('total_amount'),
            'pending_orders' => Order::where('user_id', $userId)
                ->where('status', 'pending')
                ->count(),
        ];

        // Récupérer les 5 commandes les plus récentes
        $recentOrders = Order::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return Inertia::render('Dashboard', [
            'recentOrders' => $recentOrders,
            'stats' => $stats,
        ]);
    }
}

