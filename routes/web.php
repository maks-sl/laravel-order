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

Auth::routes();
Route::get('/verify/{token}', 'Auth\RegisterController@verify')->name('register.verify');
Route::get('/', 'HomeController@index')->name('home');

// ORDER SAMPLE
//Route::name('welcome')->get('/', function () {
//    return view('order.welcome');
//});
//Route::resource('order', 'OrderController')->only('create', 'store');
//
//Route::group([
//    'prefix' => 'api-order',
//    'as' => 'api-order.',
//], function () {
//    Route::get('/create', 'OrderController@apiCreate')->name('create');
//    Route::post('/store', 'OrderController@apiStore')->name('store');
//});

// VOTE SAMPLE
//Route::get('/', 'VoteController@create')->name('vote.create');
//Route::post('/vote/store', 'VoteController@store')->name('vote.store');
//Route::get('/chart', 'VoteController@chart')->name('vote.chart');
//Route::get('/unique', 'VoteController@unique')->name('vote.unique');
//Route::get('/manage-secret-panel', 'PollController@index')->name('poll.index');
//Route::post('/poll/manage', 'PollController@manage')->name('poll.manage');
//Route::get('/time', 'TimeController@index')->name('time.index');

//Route::resource('vote', 'VoteController')->only('create', 'store');
