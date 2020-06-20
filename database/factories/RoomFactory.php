<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Room;
use Faker\Generator as Faker;

$factory->define(Room::class, function (Faker $faker) {
    return [
        'nrRoom' => $faker->unique()->numberBetween($min = 1000, $max = 9999),
    ];
});
