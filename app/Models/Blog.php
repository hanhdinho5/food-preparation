<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Blog extends Model
{
    protected $fillable = [
        'from_user',
        'title',
        'slug',
        'excerpt',
        'content',
        'thumbnail_path',
        'status',
        'published_at',
    ];

    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
        ];
    }

    protected static function booted(): void
    {
        static::saving(function (Blog $blog) {
            if (blank($blog->slug) && filled($blog->title)) {
                $blog->slug = Str::slug($blog->title);
            }

            if ($blog->status === 'published' && blank($blog->published_at)) {
                $blog->published_at = now();
            }

            if ($blog->status !== 'published') {
                $blog->published_at = null;
            }
        });
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'from_user');
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now());
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}