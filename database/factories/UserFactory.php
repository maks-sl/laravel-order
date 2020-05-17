<?php

use App\Entity\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/** @var \Illuminate\Database\Eloquent\Factory $factory */

$factory->define(User::class, function (Faker $faker) {
    $active = $faker->boolean;
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
        'verify_token' => $active ? null : Str::uuid(),
        'status' => $active ? User::STATUS_ACTIVE : User::STATUS_WAIT,
    ];
});
