<?php

use App\Http\Controllers\Api\KategoriController;
use App\Http\Controllers\Api\ResepController;
use App\Http\Controllers\Api\UserController;
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

Route::prefix('kategori')->group(function () {
    Route::get('/', [KategoriController::class, 'index']);
    Route::post('/', [KategoriController::class, 'store']);
    Route::get('/{id}', [KategoriController::class, 'show']);
    Route::put('/{id}', [KategoriController::class, 'update']);
    Route::delete('/{id}', [KategoriController::class, 'destroy']);
});

Route::prefix('resep')->group(function () {
    Route::get('/', [ResepController::class, 'index']);
    Route::post('/', [ResepController::class, 'store']);
    Route::get('/{id}', [ResepController::class, 'show']);
    Route::put('/{id}', [ResepController::class, 'update']);
    Route::delete('/{id}', [ResepController::class, 'destroy']);
});

Route::post('/register', [\App\Http\Controllers\Api\AuthController::class, 'register']);
Route::post('login', [\App\Http\Controllers\Api\AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [\App\Http\Controllers\Api\AuthController::class, 'logout']);

    // // route kategori
    // Route::get('/kategori', [KategoriController::class, 'index']);
    // Route::get('/kategori/{id}', [KategoriController::class, 'show']);
    // Route::post('/kategori', [KategoriController::class, 'store']);
    // Route::put('/kategori/{id}', [KategoriController::class, 'update']);
    // Route::delete('/kategori/{id}', [KategoriController::class, 'destroy']);

    // // route resep
    // Route::get('/resep', [ResepController::class, 'index']);
    // Route::get('/resep/{id}', [ResepController::class, 'show']);
    // Route::post('/resep', [ResepController::class, 'store']);
    // Route::put('/resep/{id}', [ResepController::class, 'update']);
    // Route::delete('/resep/{id}', [ResepController::class, 'destroy']);

});

Route::middleware('auth:sanctum')->get('/profile', [UserController::class, 'profile']);
