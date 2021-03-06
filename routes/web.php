<?php

use App\Http\Controllers\KopsisController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('auth.login');
});

Route::group(["middleware" => ['auth:sanctum', 'verified']], function () {
    Route::view('/dashboard', "dashboard")->name('dashboard');

    // Route::get('/user', [UserController::class, "index_view"])->name('user');
    // Route::view('/user/new', "pages.user.user-new")->name('user.new');
    // Route::view('/user/edit/{userId}', "pages.user.user-edit")->name('user.edit');

    Route::get('/barang', [KopsisController::class, "barang"])->name('barang');
    Route::get('/stok', [KopsisController::class, "stok"])->name('stok');
    Route::get('/pembelian', [KopsisController::class, "pembelian"])->name('pembelian');
    Route::get('/penjualan', [KopsisController::class, "penjualan"])->name('penjualan');
    Route::get('/laporan', [KopsisController::class, "laporan"])->name('laporan');
});
