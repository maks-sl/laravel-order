<?php

use App\Entity\Tariff;
use Faker\Generator as Faker;

/** @var \Illuminate\Database\Eloquent\Factory $factory */

$factory->define(Tariff::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->domainWord,
        'price' => $faker->numberBetween(100, 1000),
        'allowed_days' => $faker->randomElements(array_keys(\Carbon\Carbon::getDays()), random_int(2, 4)),
    ];
});
