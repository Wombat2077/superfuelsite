<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products_orders extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'order_id',
        'product_id',
        'product_count'
    ];
}
