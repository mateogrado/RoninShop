<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
       'name' => $faker->sentence(2), 
       'autor' => $faker->sentence(2),    
       'editorial' => $faker->sentence(2),
       'categoria' => 'comic',  
       'description' => $faker->sentence(5),
       'price' => $faker->numberBetween(1, 50),
       'unidades' => $faker->numberBetween(1, 30),
       
    ];
});
