<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'coupon_id',

        // Customer snapshot
        'name',
        'email',
        'number',
        'whatsapp_number',
        'address',
        'note',

        // Delivery
        'delivery_zone',
        'delivery_fee',
        'is_free_delivery',

        // Coupon snapshot
        'coupon_code',
        'coupon_type',
        'coupon_value',

        // Financials
        'subtotal',
        'product_discount',
        'offer_discount',
        'coupon_discount',
        'total_discount',
        'final_total',

        // Offer snapshot
        'applied_offers',

        // System
        'tracking_id',
        'status',
        'all_terms',
    ];

    protected $casts = [
        'is_free_delivery' => 'boolean',
        'applied_offers' => 'array',

        // money fields
        'delivery_fee' => 'decimal:2',
        'coupon_value' => 'decimal:2',

        'subtotal' => 'decimal:2',
        'product_discount' => 'decimal:2',
        'offer_discount' => 'decimal:2',
        'coupon_discount' => 'decimal:2',
        'total_discount' => 'decimal:2',
        'final_total' => 'decimal:2',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }

    public function items()
    {
        return $this->hasMany(OrderDetail::class);
    }

    // optional alias (developer-friendly)
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Helper Methods (VERY USEFUL)
    |--------------------------------------------------------------------------
    */

    public function isDhaka()
    {
        return $this->delivery_zone === 'dhaka';
    }

    public function isOutside()
    {
        return $this->delivery_zone === 'outside';
    }

    public function hasCoupon()
    {
        return !empty($this->coupon_code);
    }

    public function hasFreeDelivery()
    {
        return $this->is_free_delivery === true;
    }

}
