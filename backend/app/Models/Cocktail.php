<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cocktail extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'image'];

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class, 'cocktail_ingredients');
    }

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }
}


