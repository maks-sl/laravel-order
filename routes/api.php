<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['as' => 'api.', 'namespace' => 'Api'],
    function () {
        Route::get('/tariffs', 'TariffController@index');
        Route::get('/tariffs/{tariff}/dates', 'TariffController@dates');
        Route::get('/departments', 'DepartmentController@index');
        Route::get('/results', 'VoteController@index');
    });
