<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('/v1')->namespace('Api\V1')->group(function () {
    Route::post('send_sms', [\App\Http\Controllers\Api\V1\AuthApiController::class, 'sendSms']);
    Route::post('verify_sms_code', [\App\Http\Controllers\Api\V1\AuthApiController::class, 'verifySms']);
    Route::get('/home', [\App\Http\Controllers\Api\v1\HomeApiController::class, 'home']);
    Route::get('/most_sold_products', [\App\Http\Controllers\Api\v1\ProductsApiController::class, 'most_sold_products']);
    Route::get('/most_viewed_products', [\App\Http\Controllers\Api\v1\ProductsApiController::class, 'most_viewed_products']);
    Route::get('/newest_products', [\App\Http\Controllers\Api\v1\ProductsApiController::class, 'newest_products']);
    Route::get('/cheapest_products', [\App\Http\Controllers\Api\v1\ProductsApiController::class, 'cheapest_products']);
    Route::get('/most_expensive_products', [\App\Http\Controllers\Api\v1\ProductsApiController::class, 'most_expensive_products']);
});

Route::prefix('/v1')->namespace('Api\V1')->middleware('auth:sanctum')->group(function () {
    Route::post('register', [\App\Http\Controllers\Api\V1\UserApiController::class, 'register']);
});


