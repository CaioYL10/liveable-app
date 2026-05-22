<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'local',
        'type',
        'beds_qtd',
        'toilette',
        'area',
        'owner_contact',
        'property_title',
        'wifi',
        'tv',
        'cooler',
        'air_conditioning',
        'washer',
        'microwave',
        'contract',
    ];

    protected function casts()
    {
        return [
            'wifi' => 'boolean',
            'tv' => 'boolean',
            'cooler' => 'boolean',
            'air_conditioning' => 'boolean',
            'washer' => 'boolean',
            'microwave' => 'boolean',
        ];
    }
}
