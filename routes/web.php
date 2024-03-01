<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\loginController;
use App\Http\Controllers\TransaksiController;


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

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::controller(loginController::class)->group(function () {
    Route::post('/login', 'login')->name('login');
    Route::get('/logout', 'logout')->name('logout');
});

Route::group([
    'prefix' => 'transaksi',
    'as' => 'transaksi.',
    'controller' => TransaksiController::class,
],function () {
    Route::get('/index', 'index')->name('index');
    Route::get('/show/{id}', 'show')->name('show');
    Route::post('/store', 'store')->name('store');
    Route::post('/getTotal', 'getTotal')->name('getTotal');
    Route::post('/update/{id}', 'update')->name('update');
    Route::get('/bayar/{id}', 'bayar')->name('bayar');
    Route::get('/laporan', 'laporan')->name('laporan');
    Route::get('/destroy/{id}', 'destroy')->name('destroy');
    Route::get('/edit/{id}', 'edit')->name('edit');
});