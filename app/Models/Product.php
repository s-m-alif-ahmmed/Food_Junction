<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'meta_title',
        'meta_description',
        'meta_keywords',
        'name',
        'short_description',
        'description',
        'image',
        'price',
        'discount_price',
        'product_slug',
        'status',
    ];

    public function productReviews()
    {
        return $this->hasMany(ProductReview::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
}
