<?php

use App\Http\Controllers\FrontController;
use App\Http\Controllers\ResepController;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/', [FrontController::class, 'index']); // halaman utama user
Route::get('tentang', [FrontController::class, 'about']);
Route::get('kontak', [FrontController::class, 'kontak']);
Route::get('resep', [FrontController::class, 'resep']);
Route::get('detail_resep/{id}', [FrontController::class, 'detail_resep']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'admin', 'middleware' => ['auth', Role::class]], function () {
    Route::get('/', function () {
        return view('admin.index');
    });
    Route::resource('kategori', \App\Http\Controllers\KategoriController::class);
    Route::resource('resep', \App\Http\Controllers\ResepController::class);
    Route::get('profile', [HomeController::class, 'profile'])->name('profile.index');
    Route::get('profile/edit', [HomeController::class, 'editProfile'])->name('profile.edit');
    Route::put('profile/update/{id}', [HomeController::class, 'updateProfile'])->name('profile.update');

});
