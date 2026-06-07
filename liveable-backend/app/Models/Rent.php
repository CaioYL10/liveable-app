<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rent extends Model
{
    protected $fillable = [
        'user_id',
        'property_id',
        'checkin',
        'checkout',
        'guests_count',
        'details',
        'has_pet',
        'confirmed'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    protected $casts = [
        'checkin' => 'date',
        'checkout' => 'date',
        'has_pet' => 'boolean',
    ];
}
