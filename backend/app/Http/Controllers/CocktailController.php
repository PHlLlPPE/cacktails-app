<?php

namespace App\Http\Controllers;

use App\Models\Cocktail;
use Illuminate\Http\Request;

class CocktailController extends Controller
{
    public function index()
    {
        return response()->json(Cocktail::with('ingredients')->get());
    }

    public function show($id)
    {
        return response()->json(Cocktail::with('ingredients')->findOrFail($id));
    }

    public function store(Request $request)
    {
        $cocktail = Cocktail::create($request->all());
        return response()->json($cocktail, 201);
    }

    public function update(Request $request, $id)
    {
        $cocktail = Cocktail::findOrFail($id);
        $cocktail->update($request->all());
        return response()->json($cocktail);
    }

    public function destroy($id)
    {
        Cocktail::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
