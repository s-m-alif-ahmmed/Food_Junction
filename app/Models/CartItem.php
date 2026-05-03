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
        'unit_type',
        'unit_value',
        'quantity',
        'unit_price',
        'total_price',
    ];

    protected $casts = [
        'unit_value' => 'decimal:2',
        'unit_price' => 'decimal:2',
        'total_price' => 'decimal:2',
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
        if ($this->unit_type !== 'kg') return 0;

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
        if ($this->unit_type === 'kg') {
            return ($this->unit_value * $this->quantity) . ' kg';
        }

        return $this->quantity . ' pcs';
    }

}
