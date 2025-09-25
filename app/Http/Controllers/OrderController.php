<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return Order::with(['user', 'items.produit'])->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'statut'  => 'required|in:pending,confirmed,shipped,delivered,cancelled',
            'total'   => 'required|numeric|min:0',
        ]);

        $order = Order::create($request->all());
        return response()->json($order, 201);
    }

    public function show(Order $order)
    {
        return $order->load(['user', 'items.produit']);
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'statut' => 'sometimes|in:pending,confirmed,shipped,delivered,cancelled',
            'total' => 'sometimes|numeric|min:0',
        ]);

        $order->update($request->all());
        return response()->json($order, 200);
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return response()->json(null, 204);
    }
}
