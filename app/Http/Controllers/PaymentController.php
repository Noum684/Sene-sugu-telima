<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        return Payment::with('order')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'amount' => 'required|numeric|min:0',
            'methode' => 'required|in:cash,orange_money,moov_money',
            'statut' => 'in:pending,completed,failed',
        ]);

        $payment = Payment::create($request->all());
        return response()->json($payment, 201);
    }

    public function show(Payment $payment)
    {
        return $payment->load('order');
    }

    public function update(Request $request, Payment $payment)
    {
        $request->validate([
            'amount' => 'sometimes|numeric|min:0',
            'methode' => 'sometimes|in:cash,orange_money,moov_money',
            'statut' => 'sometimes|in:pending,completed,failed',
        ]);

        $payment->update($request->all());
        return response()->json($payment, 200);
    }

    public function destroy(Payment $payment)
    {
        $payment->delete();
        return response()->json(null, 204);
    }
}
