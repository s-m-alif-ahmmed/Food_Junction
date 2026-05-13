<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryZone extends Model
{
    use HasFactory;

    protected $table = 'delivery_zones';

    protected $fillable = [
        'name',
        'slug',
        'delivery_charge',
        'status',
    ];

    protected $casts = [
        'delivery_charge' => 'decimal:2',
    ];

    /**
     * Products that belong to this delivery zone (many-to-many).
     */
    public function products()
    {
        return $this->belongsToMany(Product::class, 'delivery_zone_product', 'delivery_zone_id', 'product_id')
                    ->withTimestamps();
    }
}
