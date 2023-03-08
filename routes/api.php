<?php

use App\Http\Controllers\Api\CategoryApiController;
use App\Http\Controllers\Api\ProductApiController;
use App\Http\Controllers\Api\TableApiController;
use App\Http\Controllers\Api\TenantApiController;
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

Route::group(['prefix' => 'v1'], function(){
    
    Route::get('/tenants/{uuid}', [TenantApiController::class, 'show']);
    Route::get('/tenants', [TenantApiController::class, 'index']);

    Route::get('/categories/{identify}}', [CategoryApiController::class, 'show']);
    Route::get('/categories', [CategoryApiController::class, 'categoriesByTenant']);

    Route::get('/tables/{identify}', [TableApiController::class, 'show']);
    Route::get('/tables', [TableApiController::class, 'tablesByTenant']);

    Route::get('/products/{flag}', [ProductApiController::class, 'show']);
    Route::get('/products', [ProductApiController::class, 'productsByTenant']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
