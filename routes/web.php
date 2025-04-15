<?php

use App\Http\Controllers\FrontController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PengajuanResepController;
use App\Http\Controllers\ResepController;
use App\Http\Middleware\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
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
// Route::get('/search', [\App\Http\Controllers\ResepController::class, 'search'])->name('resep.search');
Route::get('tentang', [FrontController::class, 'about']);
Route::get('kontak', [FrontController::class, 'kontak']);
Route::get('resep', [FrontController::class, 'resep']);
Route::get('/resep', [\App\Http\Controllers\ResepController::class, 'listResep'])->name('front.resep');
Route::get('detail_resep/{id}', [FrontController::class, 'detail_resep']);
Route::get('/komentar-public/{id}', [\App\Http\Controllers\KomentarController::class, 'getKomentar']);
Route::get('/gambars/resep/{filename}', function ($filename) {
    $path = public_path('gambars/resep/' . $filename);

    if (!file_exists($path)) {
        abort(404);
    }

    return Response::make(file_get_contents($path), 200, [
        'Content-Type' => mime_content_type($path),
        'Access-Control-Allow-Origin' => '*',
    ]);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/likes', [\App\Http\Controllers\LikeController::class, 'index']); // Get all likes (hanya untuk user login)
    Route::post('/like', [\App\Http\Controllers\LikeController::class, 'store']); // Like resep
    Route::delete('/like/resep/{id_resep}', [\App\Http\Controllers\LikeController::class, 'destroy']); // Unlike berdasarkan id_resep
    Route::post('/toggle-like', [\App\Http\Controllers\LikeController::class, 'toggleLike'])->name('toggle-like'); // Toggle like/unlike
    Route::get('/komentar/{id}', [\App\Http\Controllers\KomentarController::class, 'index']);
    Route::post('/komentar/{id}', [\App\Http\Controllers\KomentarController::class, 'store']);
    Route::delete('/komentar/{id}', [\App\Http\Controllers\KomentarController::class, 'destroy'])->name('komentar.destroy');
});

// Jika masih ingin menggunakan route di ResepController
Route::middleware(['auth'])->post('/like/{resep_id}', [\App\Http\Controllers\ResepController::class, 'like'])->name('like.resep');

Route::get('/profile', [\App\Http\Controllers\User::class, 'showProfile'])->middleware('auth')->name('profile');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'admin', 'middleware' => ['auth', Role::class]], function () {
    Route::get('/', function () {
        return view('admin.index');
    });
    Route::resource('kategori', \App\Http\Controllers\KategoriController::class);
    Route::resource('resep', \App\Http\Controllers\ResepController::class);
    Route::post('/pengajuanresep/store', [PengajuanResepController::class, 'store']) ->middleware('auth')   ->name('pengajuanresep.store');

    Route::get('profile', [HomeController::class, 'profile'])->name('profile.index');
    Route::get('profile/edit', [HomeController::class, 'editProfile'])->name('profile.edit');
    Route::put('profile/update/{id}', [HomeController::class, 'updateProfile'])->name('profile.update');
    Route::resource('pengajuanResep', \App\Http\Controllers\PengajuanResepController::class);
    Route::put('PengajuanResep/{id}/approve', [PengajuanResepController::class, 'approve'])->name('pengajuanResep.approve');
    Route::put('PengajuanResep/{id}/reject', [PengajuanResepController::class, 'reject'])->name('pengajuanResep.reject');

});
