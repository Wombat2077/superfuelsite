<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'passport_id',
        'address',
        'summary_cost',
        'status'
    ];
    function status(){
        return Status_table::find($this->status);
    }
    function user(){
        return User::find($this->user_id);
    }
    function products(){
        return Products::find(Products_orders::where('order_id', $this->id)->value("product_id"));
    }
}
