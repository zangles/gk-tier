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


Route::get('/test', function()
{

});

Route::get('/', 'HomeController@list')->name('pilot');

Auth::routes();


Route::get('/best/{id}', 'HomeController@best')->name('best');
Route::get('/pilot/show/{id}', 'HomeController@pilot')->name('pilot');


Route::group(['middleware' => ['web','auth']], function() {
    Route::get('guides/create', 'GuidesController@create')->name('guides.create');
    Route::post('guides/create', 'GuidesController@store')->name('guides.store');
    Route::get('guides/edit/{guide}', 'GuidesController@edit')->name('guides.edit');
    Route::post('guides/update/{guide}', 'GuidesController@update')->name('guides.update');
});


Route::group(['middleware' => ['web']], function() {
    Route::get('guides/list', 'GuidesController@index')->name('guides.index');
    Route::get('guides/show/{guide}', 'GuidesController@show')->name('guides.show');
});



Route::group(['middleware' => ['web','admin']], function()
{
    Route::get('/home', 'PilotController@index')->name('home');
    Route::resource('pilot', 'PilotController');
    Route::resource('locale', 'LocaleController');
    Route::resource('trans', 'TranslationController');
    Route::get('transAjax/{locale}', 'TranslationController@getTrans')->name('trans.locale');
    Route::get('/locale/restore/{locale}', 'LocaleController@restore')->name('locale.restore');
    Route::get('/app/status', 'HomeController@changeStatus')->name('change.status');
    Route::get('/app/updatedb', 'HomeController@updateDb')->name('update.db');
});
