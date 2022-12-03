<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $table = "products";
    public $timestamps = false;

    protected $fillable = [
        'id', 'name', 'description','autor','editorial','categoria','unidades', 'price', 'img', 'reated_at', 'updated_at',
    ];
}
