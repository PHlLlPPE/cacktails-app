<?php

namespace App\Http\Controllers;

use App\Models\Vote;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'cocktail_id' => 'required|exists:cocktails,id',
            'score' => 'required|integer|min:1|max:5'
        ]);

        $vote = Vote::create($request->all());
        return response()->json($vote, 201);
    }

    public function index()
    {
        return response()->json(Vote::with('cocktail')->get());
    }
}
