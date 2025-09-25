<?php

namespace App\Http\Controllers;

use App\Models\Region;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    public function index()
    {
        return Region::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:regions,name',
        ]);

        $region = Region::create($request->all());
        return response()->json($region, 201);
    }

    public function show(Region $region)
    {
        return $region;
    }

    public function update(Request $request, Region $region)
    {
        $request->validate([
            'name' => 'required|string|unique:regions,name,' . $region->id,
        ]);

        $region->update($request->all());
        return response()->json($region, 200);
    }

    public function destroy(Region $region)
    {
        $region->delete();
        return response()->json(null, 204);
    }
}
