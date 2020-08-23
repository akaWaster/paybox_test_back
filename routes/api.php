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

    Route::prefix('user')->group(function () {
        Route::middleware('api.admin')->get('all', 'API\AdminController@users');
        Route::get('info', function (Request $request) {
            return $request->user();
        });
        Route::get('payments/all', 'API\UserController@payments');
    });

    Route::prefix('payment')->group(function () {
        Route::middleware('api.admin')->group(function () {
            Route::put('add', 'API\PaymentController@add');
        });
        Route::post('pay', 'API\PaymentController@pay');
    });
});

Route::post('register', 'API\AuthController@register');
Route::get('login', 'API\AuthController@login');
