<?php

use App\Http\Controllers\BlogController;
use App\Models\Blog;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\DetailPembelianController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsersController;



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
    });

    Route::get('/contoh-1', function () {
        return view('contoh1');
    });

    Route::get('/contoh-2', function () {
        return view('contoh2');
    });

    Route::resource('barang', BarangController::class);

    Route::resource('pembelian', PembelianController::class);


    Route::resource('penjualan', PenjualanController::class);
    Route::resource('users', UsersController::class);
});


Route::get('/login', [
    AuthController::class,
    'login'
])->middleware('guest')->name('login');


Route::post('/do-login', [AuthController::class, 'doLogin'])
    ->name('do-login')->middleware('guest');


Route::post('/do-logout', [AuthController::class, 'doLogout'])
    ->name('do-logout')->middleware('auth');
