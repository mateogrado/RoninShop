<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItems extends Model
{

    public $table = "order_items";
    
    protected $fillable = [
       'order_id','product_id','price','quantity'
    ];
}
