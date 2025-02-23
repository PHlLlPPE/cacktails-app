<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CocktailController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\VoteController;

// Routes API RESTful pour Cocktails et Ingrédients 

Route::apiResource('cocktails', CocktailController::class);
Route::apiResource('ingredients', IngredientController::class);

// Routes pour les Votes

Route::post('votes', [VoteController::class, 'store']);
Route::get('votes', [VoteController::class, 'index']);
