<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CostumeController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\StoreController;
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

Route::group([
    'middleware' => 'api',
    // 'namespace' => 'App\Http\Controllers',
    'prefix' => 'auth',
], function($router){
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('user', [AuthController::class, 'me']);
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'store',
], function($router) {
   Route::post('create', [StoreController::class, 'create']);
   Route::get('all', [StoreController::class, 'getAll']);
   Route::get('single', [StoreController::class, 'getById']);
   Route::put('edit', [StoreController::class, 'update']);
   Route::delete('delete', [StoreController::class, 'delete']);
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'costume',
], function($router) {
    Route::post('create', [CostumeController::class, 'create']);
    Route::get('all', [CostumeController::class, 'getCostume']);
    Route::get('single', [CostumeController::class, 'getCostumeById']);
    Route::put('edit', [CostumeController::class, 'update']);
    Route::delete('delete', [CostumeController::class, 'delete']);
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'payment',
], function($router) {
    Route::post('create', [PaymentMethodController::class, 'create']);
    Route::get('all', [PaymentMethodController::class, 'getAll']);
    Route::get('single', [PaymentMethodController::class, 'getById']);
    Route::put('edit', [PaymentMethodController::class, 'update']);
    Route::delete('delete', [PaymentMethodController::class, 'delete']);
});


