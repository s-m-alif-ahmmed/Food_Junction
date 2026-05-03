<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferCondition extends Model
{
    use HasFactory;

    protected $fillable = [
        'offer_id',
        'condition_type',
        'operator',
        'value',
        'extra_data',
    ];

    protected $casts = [
        'extra_data' => 'array',
    ];

    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }

}
