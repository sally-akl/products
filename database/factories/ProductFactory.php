<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    $rand_pic = ["1.jpg","2.jpg","3.jpg"];
    return [
        'name' => $faker->name,
        'description' => $faker->name,
        'picture' => $rand_pic[rand(0, count($rand_pic) - 1)],
    ];
});
