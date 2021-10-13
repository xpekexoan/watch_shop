<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::namespace('Api')->group(function () {
    Route::name('api.')->group(function () {
        Route::get('province', 'ProvinceController@index')->name('province');
        Route::get('province/district', 'ProvinceController@listDistrict')->name('district');
    });
});
