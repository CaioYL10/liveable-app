<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rent extends Model
{
    protected $fillable = [
        'property_id',
        'user_id',
        'details',
        'checkin',
        'checkout',
        'guests_count',
        'has_pet',
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
