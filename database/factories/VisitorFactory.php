<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Visitor;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Visitor::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'cpf' => Str::random(14),
        'email' => Str::random(10).'@visitor.com',
        'birth' => $faker->date(),
    ];
});
