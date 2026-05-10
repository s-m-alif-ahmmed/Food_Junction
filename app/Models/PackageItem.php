<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageItem extends Model
{
    use HasFactory;

    protected $table = 'package_items';

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
