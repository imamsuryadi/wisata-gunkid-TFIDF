<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\WisataController;
use App\Http\Controllers\WisatawanController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SewaMotorController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [HomepageController::class, 'index']);
Route::get('/semua-wisata', [HomepageController::class, 'allWisata']);
Route::get('/detailWisata/{id}', [HomepageController::class, 'detail'])->name('detail');
Route::get('/wisata/filter/{kategori}', [WisataController::class, 'filter'])->name('wisata.filter');
Route::get('/search', [HomepageController::class, 'search'])->name('search');
Route::get('/artikel', [HomepageController::class, 'artikel'])->name('artikel');
Route::get('/artikel/{id}', [HomepageController::class, 'show'])->name('artikel.show');





Auth::routes();

Route::middleware('auth')->group(function () {

    Route::resource('wisata', WisataController::class);
    Route::post('/wisata/{id}/favorite', [WisataController::class, 'toggleFavorite'])->name('wisata.toggleFavorite');
    Route::get('/favorites', [WisataController::class, 'favorites'])->name('favorites');
    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
});

Route::group(['middleware' => 'admin'], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('kategori', KategoriController::class);
    Route::resource('artikels', ArtikelController::class);
    Route::get('/wisatawan', [WisatawanController::class, 'index'])->name('wisatawan');
    Route::get('/wisata/filter-by-category', [WisataController::class, 'filterByCategory'])->name('wisata.filter-by-category');
    Route::get('/sewa-motor', [SewaMotorController::class, 'index'])->name('sewaMotor.index');
    Route::post('/sewa-motor', [SewaMotorController::class, 'store'])->name('sewaMotor.store');
    Route::put('/sewa-motor/{id}', [SewaMotorController::class, 'update'])->name('sewaMotor.update');
    Route::delete('/sewa-motor/{id}', [SewaMotorController::class, 'destroy'])->name('sewaMotor.destroy');

});
