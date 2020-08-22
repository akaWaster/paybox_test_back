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

Route::middleware('auth:api')->group(function () {
    Route::get('user', function (Request $request) {
        return $request->user();
    })->name('user.info');

    Route::prefix('payment')->group(function () {
        Route::middleware('api.admin')->group(function () {

            Route::post('add', function () {
                return 'aaa';
            });
        });

    });

});

Route::post('register', 'API\AuthController@register');
Route::post('login', 'API\AuthController@login');
