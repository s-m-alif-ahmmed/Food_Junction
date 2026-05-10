<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferReward extends Model
{
    use HasFactory;

    protected $table = 'offer_rewards';

    protected $fillable = [
        'offer_id',
        'reward_type',
        'product_id',
        'variant_id',
        'quantity',
        'discount_value',
    ];

    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function variant()
    {
        return $this->belongsTo(ProductVariant::class);
    }
}
