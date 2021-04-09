<?php

use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PenerbitController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\UploadController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    if (Auth::user()) {
        return redirect()->route('transaksi');
    }
    return redirect()->route('login');
});

// FILE POND ROUTE TO TEMPORARY UPLOAD
Route::post('/upload', [UploadController::class, 'store']);


Route::middleware(['auth'])->group(function () {
    Route::get('/home', fn () => view('transaksi.index'))->name('home');
    Route::resource('kategori', KategoriController::class)->except(['create', 'show', 'edit',]);
    Route::resource('penerbit', PenerbitController::class)->except(['create', 'show', 'edit',]);
    Route::resource('buku', BukuController::class)->except(['create', 'show', 'edit',]);
});
