<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Carbon\Carbon;

class StatisticsController extends Controller
{
    public function index()
    {
        $totalRevenue = Order::whereNotNull('paid_at')->sum('total_amount');
        $totalOrders = Order::count();
        $paidOrders = Order::whereNotNull('paid_at')->count();

        // Données mensuelles pour 2025
        $startDate = Carbon::create(2025, 1, 1);
        $endDate = Carbon::create(2025, 12, 31);

        $monthlyData = Order::whereNotNull('paid_at')
            ->whereBetween('paid_at', [$startDate, $endDate])
            ->selectRaw('DATE_FORMAT(paid_at, "%Y-%m") as month, SUM(total_amount) as revenue')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Préparer les données pour tous les mois de 2025
        $labels = [];
        $revenues = [];

        for ($month = 1; $month <= 12; $month++) {
            $date = Carbon::create(2025, $month, 1);
            $monthKey = $date->format('Y-m');
            $monthData = $monthlyData->firstWhere('month', $monthKey);

            $labels[] = $date->locale('fr')->format('F Y'); // Nom du mois en français
            $revenues[] = $monthData ? round($monthData->revenue, 2) : 0;
        }

        $stats = [
            'totalRevenue' => $totalRevenue,
            'totalOrders' => $totalOrders,
            'paidOrders' => $paidOrders,
            'pendingOrders' => $totalOrders - $paidOrders,
            'averageOrderValue' => $paidOrders > 0 ? $totalRevenue / $paidOrders : 0,
            'conversionRate' => $totalOrders > 0 ? round(($paidOrders / $totalOrders) * 100, 2) : 0,

            // Nouvelle structure pour les charges sociales
            'charges_sociales' => [
                'urssaf' => [
                    'maladie_maternite' => [
                        'label' => 'Maladie-Maternité',
                        'rate' => 6.50,
                        'amount' => $totalRevenue * 0.0650,
                    ],
                    'retraite_base' => [
                        'label' => 'Retraite de base',
                        'rate' => 8.23,
                        'amount' => $totalRevenue * 0.0823,
                    ],
                    'retraite_complementaire' => [
                        'label' => 'Retraite complémentaire',
                        'rate' => 7.10,
                        'amount' => $totalRevenue * 0.0710,
                    ],
                    'invalidite_deces' => [
                        'label' => 'Invalidité-Décès',
                        'rate' => 1.27,
                        'amount' => $totalRevenue * 0.0127,
                    ],
                    'total_urssaf' => $totalRevenue * (0.0650 + 0.0823 + 0.0710 + 0.0127),
                ],
                'impots' => [
                    'versement_liberatoire' => [
                        'label' => 'Versement libératoire IR',
                        'rate' => 2.20,
                        'amount' => $totalRevenue * 0.0220,
                    ],
                ],
                'total_charges' => $totalRevenue * (0.0650 + 0.0823 + 0.0710 + 0.0127 + 0.0220),
            ],

            // Données Stripe
            'stripe' => [
                'fees' => $this->calculateStripeFees($totalRevenue, $paidOrders),
                'netRevenue' => $totalRevenue - $this->calculateStripeFees($totalRevenue, $paidOrders),
                'successRate' => 100
            ],

            // Données du graphique mensuel
            'revenueChart' => [
                'labels' => $labels,
                'datasets' => [[
                    'label' => 'Chiffre d\'affaires 2025',
                    'data' => $revenues,
                    'borderColor' => '#6366f1',
                    'tension' => 0.1
                ]]
            ]
        ];

        return inertia('Statistics/Index', [
            'stats' => $stats
        ]);
    }

    private function calculateStripeFees($revenue, $transactions)
    {
        return ($revenue * 0.014) + ($transactions * 0.25);
    }
}
