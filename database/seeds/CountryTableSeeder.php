<?php

use App\Entity\Country;
use Illuminate\Database\Seeder;

class CountryTableSeeder extends Seeder
{
    public function run(): void
    {
        factory(Country::class, 15)->create();
    }
}
