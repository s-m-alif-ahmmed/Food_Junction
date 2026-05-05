<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeBanner extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'status',
    ];

    public function offers()
    {
        return $this->belongsToMany(Offer::class, 'home_banner_offer')->withTimestamps();
    }
}
