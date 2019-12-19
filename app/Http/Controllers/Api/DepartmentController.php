<?php

namespace App\Http\Controllers\Api;

use App\Entity\Country;
use App\Entity\Department;
use App\Http\Controllers\Controller;
use App\Http\Resources\Countries\CountryResource;
use App\Http\Resources\Departments\DepartmentResource;

class DepartmentController extends Controller
{
    public function index()
    {
        return DepartmentResource::collection(Department::all());
    }

    public function countries(Department $department)
    {
        return CountryResource::collection(Country::all()->whereNotIn('id', $department->exclude_country_id));
    }
}
