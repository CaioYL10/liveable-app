<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'last_name',
        'email',
        'password',
        'profile_picture',
        'is_admin',
    ];

    protected function casts()
    {
        return [
            'is_admin' => 'boolean',
        ];
    }
}
