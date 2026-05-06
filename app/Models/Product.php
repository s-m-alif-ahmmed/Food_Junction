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
        'category_id',
        'name',
        'description',
        'image',
        'price',
        'discount_price',
        'product_type',
        'product_slug',
        'status',
        'pricing_type',
        'pricing_variants',
        'location_conditions',
    ];

    protected $casts = [
        'pricing_variants' => 'array',
        'location_conditions' => 'array',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function productReviews()
    {
        return $this->hasMany(ProductReview::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function wishlist()
    {
        return $this->hasMany(Wishlist::class);
    }

    // add to wishlist In product model
    public function wishlistByUsers()
    {
        return $this->belongsToMany(User::class, 'wishlists', 'product_id', 'user_id');
    }
    public function offers()
    {
        return $this->belongsToMany(Offer::class, 'offer_product_maps');
    }

}
