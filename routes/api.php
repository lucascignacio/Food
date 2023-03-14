<?php

use App\Http\Controllers\Api\Auth\AuthClientController;
use App\Http\Controllers\Api\CategoryApiController;
use App\Http\Controllers\Api\ProductApiController;
use App\Http\Controllers\Api\TableApiController;
use App\Http\Controllers\Api\TenantApiController;
use App\Http\Controllers\Api\Auth\RegisterController;
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
Route::post('/sanctum/token', [AuthClientController::class, 'auth']);

Route::group([
    'middleware' => ['auth:sanctum']
], function(){
    Route::get('/auth/me', [AuthClientController::class, 'me']);
    Route::post('/auth/logout', [AuthClientController::class, 'logout']);
});

Route::group(['prefix' => 'v1'], function(){
    
    Route::get('/tenants/{identify}', [TenantApiController::class, 'show']);
    Route::get('/tenants', [TenantApiController::class, 'index']);

    Route::get('/categories/{identify}}', [CategoryApiController::class, 'show']);
    Route::get('/categories', [CategoryApiController::class, 'categoriesByTenant']);

    Route::get('/tables/{identify}', [TableApiController::class, 'show']);
    Route::get('/tables', [TableApiController::class, 'tablesByTenant']);

    Route::get('/products/{identify}', [ProductApiController::class, 'show']);
    Route::get('/products', [ProductApiController::class, 'productsByTenant']);

    Route::post('/client', [RegisterController::class, 'store']);

    Route::post('/orders', [OrderApiController::class, 'store']);
    Route::get('/oders/{identify}', [OrderApiController::class, 'show']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
