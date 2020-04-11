<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function (){
    return view('app.home.index');
})->name('inicio');

Auth::routes();

Route::get('dash/configs/lang/{locale}', 'LocalizationController@index')->name('config.language');

Route::group(['middleware' => ['auth']], function () {
    //
    Route::group(['prefix' => 'dash'], function () {
        Route::get('/', 'HomeController@index')->name('home');
    });
    //
});



