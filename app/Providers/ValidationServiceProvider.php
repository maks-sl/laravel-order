<?php

namespace App\Providers;

use App\Entity\Tariff;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class ValidationServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Validator::extend('checkDateForTariff', function($attribute, $value, $parameters, $validator) {
            $tariffId = array_get($validator->getData(), $parameters[0], null);
            if (!empty($tariffId)) {
                try {
                    $tariff = Tariff::findOrFail($tariffId);
                    return $validator->validateIn($attribute, $value, array_map(function (Carbon $c) {
                        return $c->toDateString();
                    }, $tariff->allowedDates()));
                } catch (ModelNotFoundException $e) {
                    return false;
                }
            }
            return false;
        }, 'Date incorrect for this tariff');
    }

    public function register()
    {
        //
    }
}
