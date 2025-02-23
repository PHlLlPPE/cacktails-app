<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class CocktailIngredient extends Pivot
{
    use HasFactory;

    protected $table = 'cocktail_ingredients';

    protected $fillable = ['cocktail_id', 'ingredient_id'];
}
