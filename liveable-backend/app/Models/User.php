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
        'role',
    ];

    protected function casts()
    {
        return [
            'is_admin' => 'boolean',
        ];
    }
    public function property()
    {
        return $this->hasMany(Property::class);
    }
}
