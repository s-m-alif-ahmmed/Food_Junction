<?php

namespace App\Models;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes, HasApiTokens;

    protected $guarded = [];

    protected $hidden = [
        'password',
        'remember_token',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at'     => 'datetime',
            'password'              => 'hashed',
            'terms_and_policy'      => 'boolean',
            'name'                  => 'string',
            'email'                 => 'string',
            'avatar'                => 'string',
            'gender'                => 'string',
            'google_id'             => 'string',
            'apple_id'              => 'string',
            'reset_code'            => 'string',
            'reset_code_expires_at' => 'datetime',
        ];
    }

    public function wishlist()
    {
        return $this->hasMany(Wishlist::class);
    }

}
