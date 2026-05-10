<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'cart_id',
        'product_id',
        'variant_id',
        'product_variants',
        'package_id',
        'item_type',
        'quantity',
        'variant_name',
        'unit',
        'variant_quantity',
        'unit_price',
        'subtotal',
        'discount',
        'total',
        'offer_id',
        'is_free',
        'meta',
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'discount' => 'decimal:2',
        'unit_price' => 'decimal:2',
        'total' => 'decimal:2',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Helper Methods (IMPORTANT)
    |--------------------------------------------------------------------------
    */

    // total kg (for offer engine)
    public function getTotalKgAttribute()
    {
        if ($this->unit_type !== 'gram') return 0;

        return $this->unit_value * $this->quantity;
    }

    // total pcs
    public function getTotalPcsAttribute()
    {
        if ($this->unit_type !== 'pcs') return 0;

        return $this->quantity;
    }

    // display for UI
    public function getDisplayQuantityAttribute()
    {
        if ($this->unit_type === 'gram') {
            return ($this->unit_value * $this->quantity) . ' gram';
        }

        return $this->quantity . ' pcs';
    }

}
