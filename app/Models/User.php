<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'avatar',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected static function booted(): void
    {
        static::updating(function (User $user) {
            if ($user->isDirty('avatar')) {
                $oldAvatar = $user->getOriginal('avatar');

                if ($oldAvatar) {
                    Storage::disk('public')->delete($oldAvatar);
                }
            }
        });

        static::deleting(function (User $user) {
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }
        });
    }

    public function recipes()
    {
        return $this->hasMany(Recipe::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class, 'from_user');
    }

    public function blogs()
    {
        return $this->hasMany(Blog::class, 'from_user');
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->role == 'admin';
    }
}