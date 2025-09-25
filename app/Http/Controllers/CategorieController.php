<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    public function index()
    {
        return Categorie::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:categories,name',
        ]);

        $categorie = Categorie::create($request->all());
        return response()->json($categorie, 201);
    }

    public function show(Categorie $categorie)
    {
        return $categorie;
    }

    public function update(Request $request, Categorie $categorie)
    {
        $request->validate([
            'name' => 'required|string|unique:categories,name,' . $categorie->id,
        ]);

        $categorie->update($request->all());
        return response()->json($categorie, 200);
    }

    public function destroy(Categorie $categorie)
    {
        $categorie->delete();
        return response()->json(null, 204);
    }
}
