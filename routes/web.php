<?php

use App\Http\Controllers\FrontController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ResepController;
use App\Http\Controllers\Resep2Controller;

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

// Route user yang bisa diakses tanpa login
Route::get('/', [FrontController::class, 'index']); // halaman utama user
// Route::get('/search', [\App\Http\Controllers\ResepController::class, 'search'])->name('resep.search');
Route::get('tentang', [FrontController::class, 'about']);
Route::get('kontak', [FrontController::class, 'kontak']);
Route::get('resep', [FrontController::class, 'resep']);
Route::get('/resep', [\App\Http\Controllers\ResepController::class, 'listResep'])->name('front.resep');
Route::get('detail_resep/{id}', [FrontController::class, 'detail_resep']);
Route::get('/komentar-public/{id}', [\App\Http\Controllers\KomentarController::class, 'getKomentar']);

// Route user yang bisa diakses jika sudah login
Route::middleware(['auth'])->group(function () {
    Route::get('/likes', [\App\Http\Controllers\LikeController::class, 'index']); // Get all likes (hanya untuk user login)
    Route::post('/like', [\App\Http\Controllers\LikeController::class, 'store']); // Like resep
    Route::post('/like/{resep_id}', [\App\Http\Controllers\ResepController::class, 'like'])->name('like.resep');
    Route::delete('/like/resep/{id_resep}', [\App\Http\Controllers\LikeController::class, 'destroy']); // Unlike berdasarkan id_resep
    Route::post('/toggle-like', [\App\Http\Controllers\LikeController::class, 'toggleLike'])->name('toggle-like'); // Toggle like/unlike
    Route::get('/komentar/{id}', [\App\Http\Controllers\KomentarController::class, 'index']);
    Route::post('/komentar/{id}', [\App\Http\Controllers\KomentarController::class, 'store']);
    Route::delete('/komentar/{id}', [\App\Http\Controllers\KomentarController::class, 'destroy'])->name('komentar.destroy');
    Route::get('/profile', [\App\Http\Controllers\User::class, 'showProfile'])->middleware('auth')->name('profile');

    // pengajuan resep oleh USER
    Route::resource('resep2', \App\Http\Controllers\Resep2Controller::class);

    // Route::get('/resep', [\App\Http\Controllers\ResepController::class, 'listResep'])->name('front.resep');
    // Route::put('resep/{id}/approve', [ResepController::class, 'approve'])->name('resep.approve');
    // Route::put('resep/{id}/reject', [ResepController::class, 'reject'])->name('resep.reject');

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route khusus admin
Route::group(['prefix' => 'admin', 'middleware' => ['auth', Role::class]], function () {
    Route::get('/', function () {
        return view('admin.index');
    });
    Route::resource('kategori', \App\Http\Controllers\KategoriController::class);
    Route::resource('resep', \App\Http\Controllers\ResepController::class);
    Route::put('resep/{id}/approve', [ResepController::class, 'approve'])->name('resep.approve');
    Route::put('resep/{id}/reject', [ResepController::class, 'reject'])->name('resep.reject');
    Route::get('profile', [HomeController::class, 'profile'])->name('profile.index');
    Route::put('profile/update/{id}', [HomeController::class, 'updateProfile'])->name('profile.update');

});
