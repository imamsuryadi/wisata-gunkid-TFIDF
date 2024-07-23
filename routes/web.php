<?php

use App\Http\Controllers\HomepageController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\WisataController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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


Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('wisata', WisataController::class);
    Route::resource('kategori', KategoriController::class);
});
