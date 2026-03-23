<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $fillable = [
        'title',
        'summary',
        'ingredients',
        'instructions',
        'cooking_time',
        'prep_time',
        'servings',
        'difficulty',
        'category',
        'image_path',
        'video_url',
        'status',
        'user_id',
        'region_id',
        'dish_type_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function dishType()
    {
        return $this->belongsTo(DishType::class);
    }

    public function ingredientsList()
    {
        return $this->belongsToMany(Ingredient::class)
            ->withPivot('note')
            ->withTimestamps();
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published');
    }
}