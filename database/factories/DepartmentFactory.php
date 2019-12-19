<?php

use App\Entity\Department;
use Faker\Generator as Faker;

/** @var \Illuminate\Database\Eloquent\Factory $factory */

$factory->define(Department::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->domainWord,
        'color' => $faker->unique()->hexColor,
    ];
});
