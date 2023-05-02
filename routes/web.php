<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\PembeliController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\PenjualanController;

Route::resource('barang', BarangController::class);
Route::resource('pembeli', PembeliController::class);
Route::resource('staff', StaffController::class);

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
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::resource('data-barang', BarangController::class);
    Route::resource('data-pembeli', PembeliController::class);
    Route::resource('data-penjualan', PenjualanController::class);
    Route::resource('data-staff', StaffController::class);
});

require __DIR__.'/auth.php';
