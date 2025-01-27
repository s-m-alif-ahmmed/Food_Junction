<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'order_id',
        'product_id',
        'weight',
        'quantity'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    // Define the relationship with the Order model
    public function order()
    {
        return $this->belongsTo(Order::class);
    }


}
