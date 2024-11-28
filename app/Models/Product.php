<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
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
}
