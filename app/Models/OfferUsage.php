<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferUsage extends Model
{
    use HasFactory;

    protected $table = 'offer_usages';

    protected $fillable = [
        'offer_id',
        'user_id',
        'order_id',
        'usage_count',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

}
