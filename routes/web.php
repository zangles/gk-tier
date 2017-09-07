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

Route::get('/', 'PilotController@list')->name('pilot');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/best/{id}', 'HomeController@best')->name('best');
Route::get('/pilot/{id}', 'HomeController@pilot')->name('pilot');
Route::get('/test', 'HomeController@test')->name('test');



Route::group(['middleware' => ['web','auth']], function()
{
    Route::resource('pilot', 'PilotController');
});
