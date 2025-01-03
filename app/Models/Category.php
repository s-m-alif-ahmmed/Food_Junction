<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'meta_title',
        'meta_description',
        'meta_keywords',
        'name',
        'category_slug',
        'status',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

}
