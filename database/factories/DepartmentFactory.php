<?php

use App\Entity\Department;
use \App\Entity\Country;
use Faker\Generator as Faker;

/** @var \Illuminate\Database\Eloquent\Factory $factory */

$factory->define(Department::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->domainWord,
        'exclude_country_id' => function() {
            return Country::all()->random()->id;
        },
    ];
});
