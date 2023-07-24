<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MainController;
use App\Http\Controllers\Api\PostController;

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

Route::apiResource('/posts', App\Http\Controllers\Api\PostController::class);
Route::prefix('/province')->group(function(){
    Route::get('/', [MainController::class, 'indexProvince']);
    Route::get('/{id}', [MainController::class, 'getDetailProvince']);
});
Route::prefix('/regency')->group(function(){
    Route::get('/', [MainController::class, 'indexRegency']);
    Route::get('/{id}', [MainController::class, 'getDetailRegency']);
});
Route::prefix('/district')->group(function(){
    Route::get('/', [MainController::class, 'indexDistrict']);
    Route::get('/{id}', [MainController::class, 'getDetailDistrict']);
});

Route::get('/detail/{id}', [MainController::class, 'getParentChild']);
