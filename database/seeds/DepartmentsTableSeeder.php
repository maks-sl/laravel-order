<?php

use App\Entity\Department;
use Illuminate\Database\Seeder;

class DepartmentsTableSeeder extends Seeder
{
    public function run(): void
    {
        factory(Department::class, 15)->create();
    }
}
