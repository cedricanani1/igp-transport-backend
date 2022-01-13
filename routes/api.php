<?php

use App\Http\Controllers\CarController;
use App\Http\Controllers\CarMarqueController;
use App\Http\Controllers\CarModelController;
use App\Http\Controllers\CarRateController;
use App\Http\Controllers\CarTypeController;
use App\Http\Controllers\OrderController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/orders-client', [OrderController::class,'ordersclient']);
Route::resource('orders', OrderController::class);
Route::resource('car-marques', CarMarqueController::class);
Route::resource('car-models', CarModelController::class);
Route::resource('car-types', CarTypeController::class);
Route::resource('cars', CarController::class);
Route::post('/deleteFile', [CarController::class,'deleteFile']);
Route::post('/addFile', [CarController::class,'addFile']);
Route::post('/searchCar', [CarController::class,'searchCar']);
Route::post('/rating', [CarRateController::class,'store']);
