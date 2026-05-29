<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PropertyLike;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        'pricePerDay',
        'status',
        'contract',
        'property_image_id',
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

    public function likes(): HasMany
    {
        return $this->hasMany(PropertyLike::class);
    }
    public function isLikedBy($user): bool
    {
        if (!$user) return false;

        $userId = $user instanceof User ? $user->id : $user;
        return $this->likes()->where('user_id', $userId)->exists();
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function isRent(Property $property): bool
    {
        return (bool) $property->status == 'rent';
    }
    public function isEnabled(Property $property): bool
    {
        return (bool) $property->status == 'enabled';
    }
    public function images() {
        return $this->hasMany(PropertyImage::class);
    }

}
