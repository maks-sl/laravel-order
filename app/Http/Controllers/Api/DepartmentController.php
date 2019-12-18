<?php

namespace App\Http\Controllers\Api;

use App\Entity\Department;
use App\Http\Controllers\Controller;
use App\Http\Resources\Departments\DepartmentResource;

class DepartmentController extends Controller
{
    public function index()
    {
        return DepartmentResource::collection(Department::all());
    }
}
