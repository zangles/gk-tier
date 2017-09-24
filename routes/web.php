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

Route::get('/home', 'PilotController@index')->name('home');
Route::get('/best/{id}', 'HomeController@best')->name('best');
Route::get('/pilot/show/{id}', 'HomeController@pilot')->name('pilot');


Route::group(['middleware' => ['web']], function() {
    Route::get('guides', 'GuidesController@index')->name('guide.test');
});


Route::group(['middleware' => ['web','auth']], function()
{
    Route::resource('pilot', 'PilotController');
    Route::resource('locale', 'LocaleController');
    Route::resource('trans', 'TranslationController');
    Route::get('transAjax/{locale}', 'TranslationController@getTrans')->name('trans.locale');
    Route::get('/locale/restore/{locale}', 'LocaleController@restore')->name('locale.restore');
    Route::get('/app/status', 'HomeController@changeStatus')->name('change.status');
    Route::get('/app/updatedb', 'HomeController@updateDb')->name('update.db');
});
