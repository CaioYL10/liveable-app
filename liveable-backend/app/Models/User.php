<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory;
    use HasApiTokens;

    protected $fillable = [
        'name',
        'last_name',
        'email',
        'password',
        'profile_picture',
        'banner',
        'role',
        'phone',
        'bio',
        'twitter',
        'instagram',
        'facebook',
        'share_socials',
    ];

    protected function casts(): array
    {
        return [
            'is_admin'      => 'boolean',
            'share_socials' => 'boolean',
        ];
    }

    public function property()
    {
        return $this->hasMany(Property::class);
    }
}
