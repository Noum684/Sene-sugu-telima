<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use Illuminate\Http\Request;

class ProduitController extends Controller
{
    public function index()
    {
        return Produit::with(['category', 'user','region'])->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'description'   => 'nullable|string',
            'prix'         => 'required|numeric|min:0',
            'stock'         => 'required|integer|min:0',
            'category_id'   => 'required|exists:categories,id',
            'user_id'       => 'required|exists:users,id',
            'region_id'     => 'nullable|exists:regions,id',
            'image'         => 'nullable|image|max:2048',
        ]);

        $produit = Produit::create($request->all());
        return response()->json($produit, 201);
    }

    public function show(Produit $produit)
    {
        return $produit->load(['category', 'user','region']);
    }

    public function update(Request $request, Produit $produit)
    {
        $request->validate([
            'name'          => 'sometimes|string|max:255',
            'description'   => 'nullable|string',
            'prix'         => 'sometimes|numeric|min:0',
            'stock'         => 'sometimes|integer|min:0',
            'category_id'   => 'sometimes|exists:categories,id',
            'user_id'       => 'sometimes|exists:users,id',
            'region_id'     => 'nullable|exists:regions,id',
            'image'         => 'nullable|image|max:2048',
        ]);

        $produit->update($request->all());
        return response()->json($produit, 200);
    }

    public function destroy(Produit $produit)
    {
        $produit->delete();
        return response()->json(null, 204);
    }
}
