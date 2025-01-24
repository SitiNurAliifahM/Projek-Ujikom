<?php

use App\Http\Controllers\FrontController;
use App\Http\Controllers\User;
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'admin', 'middleware' => ['auth', Role::class]], function () {
    Route::get('/', function () {
        return view('admin.index');
    });
    Route::resource('kategori', \App\Http\Controllers\KategoriController::class);

});
