<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderItemController extends Controller
{
    public function index()
    {
        return OrderItem::with(['order', 'produit'])->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'order_id'   => 'required|exists:orders,id',
            'produit_id' => 'required|exists:produits,id',
            'quantite'   => 'required|integer|min:1',
            'prix'      => 'required|numeric|min:0',
        ]);

        $item = OrderItem::create($request->all());
        return response()->json($item, 201);
    }

    public function show(OrderItem $orderItem)
    {
        return $orderItem->load(['order', 'produit']);
    }

    public function update(Request $request, OrderItem $orderItem)
    {
        $request->validate([
            'quantite' => 'sometimes|integer|min:1',
            'prix'    => 'sometimes|numeric|min:0',
        ]);

        $orderItem->update($request->all());
        return response()->json($orderItem, 200);
    }

    public function destroy(OrderItem $orderItem)
    {
        $orderItem->delete();
        return response()->json(null, 204);
    }
}
