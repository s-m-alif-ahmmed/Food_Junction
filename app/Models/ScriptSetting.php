<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScriptSetting extends Model
{
    use HasFactory;

    protected $table = 'script_settings';

    protected $fillable = [
        'name',
        'slug',
        'script',
        'place',
        'status',
    ];

    protected $casts = [
        'place' => 'string',
        'status' => 'string',
        'script' => 'string',
        'name' => 'string',
        'slug' => 'string',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

}
