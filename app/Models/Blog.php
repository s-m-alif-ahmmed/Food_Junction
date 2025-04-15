<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'meta_title',
        'meta_description',
        'meta_keywords',
        'title',
        'description',
        'image',
        'status',
        'slug'
    ];

    public function blogComments()
    {
        return $this->hasMany(BlogComment::class);
    }

}
