<?php

namespace App\Http\Controllers\Api;

use App\Entity\Tariff;
use App\Http\Controllers\Controller;
use App\Http\Resources\Tariffs\DateDetailResource;
use App\Http\Resources\Tariffs\TariffResource;

class TariffController extends Controller
{
    public function index()
    {
        return TariffResource::collection(Tariff::all());
    }

    public function dates(Tariff $tariff)
    {
        return DateDetailResource::collection(collect($tariff->allowedDates()));
    }
}
