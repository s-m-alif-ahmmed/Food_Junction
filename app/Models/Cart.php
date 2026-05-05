<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'session_id',
        'coupon_code',
        'delivery_zone',
        'subtotal',
        'discount',
        'offer_discount',
        'coupon_discount',
        'delivery_fee',
        'total',
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'discount' => 'decimal:2',
        'offer_discount' => 'decimal:2',
        'coupon_discount' => 'decimal:2',
        'delivery_fee' => 'decimal:2',
        'total' => 'decimal:2',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function items()
    {
        return $this->hasMany(CartItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Helper Methods
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

}
