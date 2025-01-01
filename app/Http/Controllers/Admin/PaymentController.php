<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $payments = Payment::with('user')
            ->when($request->status, function ($query, $status) {
                return $query->where('status', $status);
            })
            ->when($request->search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('order_id', 'like', "%{$search}%")
                        ->orWhereHas('user', function ($q) use ($search) {
                            $q->where('email', 'like', "%{$search}%")
                                ->orWhere('name', 'like', "%{$search}%");
                        });
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        return Inertia::render('Admin/Payments/Index', [
            'payments' => $payments,
            'filters' => $request->only(['status', 'search']),
            'stats' => [
                'total' => Payment::count(),
                'pending' => Payment::pending()->count(),
                'completed' => Payment::completed()->count(),
                'cancelled' => Payment::cancelled()->count(),
                'totalAmount' => Payment::completed()->sum('amount')
            ]
        ]);
    }

    public function show(Payment $payment)
    {
        $payment->load('user');

        return Inertia::render('Admin/Payments/Show', [
            'payment' => $payment
        ]);
    }
}
