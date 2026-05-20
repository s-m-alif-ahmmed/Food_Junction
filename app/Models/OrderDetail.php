<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'order_id',
        'product_id',
        'variant_id',

        // snapshot
        'product_name',

        // pricing
        'original_price',
        'unit_price',
        'discount_amount',

        // quantity system
        'unit_type',
        'unit_value',
        'quantity',

        // totals
        'total_price',

        // extra
        'meta',
    ];

    protected $casts = [
        'original_price' => 'decimal:2',
        'unit_price' => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'unit_value' => 'decimal:2',
        'total_price' => 'decimal:2',
        'meta' => 'array',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Helper Methods (VERY IMPORTANT)
    |--------------------------------------------------------------------------
    */

    // total quantity in KG
    public function getTotalKgAttribute()
    {
        if ($this->unit_type === 'kg') {
            return $this->unit_value * $this->quantity;
        }
        if ($this->unit_type === 'gram') {
            return ($this->unit_value * $this->quantity) / 1000;
        }

        return 0;
    }

    // total pieces
    public function getTotalPcsAttribute()
    {
        if ($this->unit_type !== 'pcs') return 0;

        return $this->quantity;
    }

    // formatted label (UI ready)
    public function getDisplayQuantityAttribute()
    {
        if ($this->unit_type === 'kg') {
            return ($this->unit_value * $this->quantity) . ' kg';
        }
        if ($this->unit_type === 'gram') {
            $totalGrams = $this->unit_value * $this->quantity;
            if ($totalGrams < 1000) {
                return $totalGrams . ' gm';
            }
            return ($totalGrams / 1000) . ' kg';
        }

        return $this->quantity . ' pcs';
    }


}
