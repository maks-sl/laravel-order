<?php

use App\Entity\Tariff;
use Illuminate\Database\Seeder;

class TariffsTableSeeder extends Seeder
{
    public function run(): void
    {
        factory(Tariff::class, random_int(3, 10))->create();
    }
}
