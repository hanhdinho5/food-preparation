<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'group_name',
    ];

    public function recipes()
    {
        return $this->belongsToMany(Recipe::class)
            ->withPivot('note')
            ->withTimestamps();
    }
}