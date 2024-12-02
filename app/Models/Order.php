<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'delivery_fee',
        'coupon_id',
        'discount_amount',
        'login_discount',
        'estimate_total',
        'order_total',
        'name',
        'email',
        'number',
        'whatsapp_number',
        'address',
        'status',
        'note',
        'all_terms',
        'tracking_id',
    ];
}
