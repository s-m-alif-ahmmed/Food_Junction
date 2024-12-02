<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coupon extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'code',
        'name',
        'max_uses',
        'max_uses_user',
        'type',
        'discount_amount',
        'min_amount',
        'starts_at',
        'expires_at',
        'discount_price',
        'status',
    ];

}
