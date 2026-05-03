<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'is_active',
        'priority',
        'offer_type',
        'discount_type',
        'discount_value',
        'applies_to',
        'location_scope',
        'coupon_enabled',
        'start_date',
        'end_date',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'coupon_enabled' => 'boolean',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    // 🔹 Relations

    public function conditions()
    {
        return $this->hasMany(OfferCondition::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'offer_product_maps');
    }

    // 🔹 Scopes

    public function scopeActive($query)
    {
        return $query->where('is_active', true)
            ->where(function ($q) {
                $q->whereNull('start_date')
                    ->orWhere('start_date', '<=', now());
            })
            ->where(function ($q) {
                $q->whereNull('end_date')
                    ->orWhere('end_date', '>=', now());
            });
    }

    public function homeBanners()
    {
        return $this->belongsToMany(HomeBanner::class, 'home_banner_offer');
    }
}
