<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class DashboardController extends BaseController
{
    public function __construct()
    {
        $this->middleware(\App\Http\Middleware\AdminMiddleware::class, ['only' => ['adminDashboard']]);
    }

    public function index()
    {
        return auth()->user()->is_admin
            ? redirect()->route('admin.dashboard')
            : redirect()->route('client.dashboard');
    }
    public function adminDashboard()
    {
          return Inertia::render('DashboardAdmin', [
            'recentOrders' => [],
            'stats' => [
                'total_orders' => 0,
                'total_amount' => 0,
                'pending_orders' => 0
            ],
            'orderStatuses' => [
                'pending' => 'En attente',
                'completed' => 'Payée'
            ],
            'isAdmin' => true,
            'jetstream' => [
                'hasTeamFeatures' => false
            ],
            'auth' => [
                'user' => auth()->user()
            ]
        ]);
    }

    public function clientDashboard()
    {
        $user = auth()->user();

        $stats = [
            'total_orders' => Order::where('user_id', $user->id)->count(),
            'active_projects' => Order::where('user_id', $user->id)
                ->where('status', 'in_progress')
                ->count(),
            'completed_projects' => Order::where('user_id', $user->id)
                ->where('status', 'completed')
                ->count()
        ];

        return Inertia::render('Client/Dashboard', [
            'orders' => Order::where('user_id', $user->id)
                ->latest()
                ->take(5)
                ->get(),
            'projects' => Order::where('user_id', $user->id)
                ->whereIn('status', ['pending', 'in_progress', 'completed'])
                ->latest()
                ->take(5)
                ->get(),
            'stats' => $stats
        ]);
    }
}
