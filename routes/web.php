<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::name('welcome')->get('/', function () {
    return view('welcome');
});

Route::resource('order', 'OrderController')->only('create', 'store');

Route::group([
    'prefix' => 'api-order',
    'as' => 'api-order.',
], function () {
    Route::get('/create', 'OrderController@apiCreate')->name('create');
    Route::post('/store', 'OrderController@apiStore')->name('store');
});
