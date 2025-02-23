<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use HasFactory;

    protected $fillable = ['cocktail_id', 'score'];

    public function cocktail()
    {
        return $this->belongsTo(Cocktail::class);
    }
}
