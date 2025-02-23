<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'type', 'image'];

    public function cocktails()
    {
        return $this->belongsToMany(Cocktail::class, 'cocktail_ingredients');
    }
}
