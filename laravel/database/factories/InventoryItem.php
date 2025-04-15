<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\InventoryItem;
use Faker\Generator as Faker;

$factory->define(InventoryItem::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->sentence,
        'quantity' => $faker->numberBetween(1, 100),
        'price' => $faker->randomFloat(2, 1, 1000),
    ];
});
