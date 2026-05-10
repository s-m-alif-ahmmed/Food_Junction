<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferUsage extends Model
{
    use HasFactory;

    protected $table = 'offer_usages';

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
        'status',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

}
