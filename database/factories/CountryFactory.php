<?php

use \App\Entity\Country;
use Faker\Generator as Faker;

/** @var \Illuminate\Database\Eloquent\Factory $factory */

$factory->define(Country::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->country,
        'color' => $faker->unique()->hexColor,
    ];
});
