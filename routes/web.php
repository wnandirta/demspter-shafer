<?php

use App\Http\Controllers\Admin\KarakteristikController;
use App\Http\Controllers\Admin\PengetahuanController;
use App\Http\Controllers\Admin\TipeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\HomeController;
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
    return view('landing');
});

Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::prefix('Admin')->name('admin.')->group(function () {
        Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
        Route::resource('/user', UserController::class);
        Route::resource('/tipe', TipeController::class);
        Route::resource('/karakteristik', KarakteristikController::class);
        Route::resource('/pengetahuan', PengetahuanController::class);
        Route::get('/show-tipe', [PengetahuanController::class, 'showTipe'])->name('show-tipe');
        Route::get('/show-karakteristik', [PengetahuanController::class, 'showKarakteristik'])->name('show-karakteristik');
    });
});

Route::middleware(['auth', 'role:Guru'])->group(function () {
    Route::group(['prefix' => 'Guru', 'namespace' => 'Guru', 'name' => 'guru.'], function () {
        Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
        Route::resource('/user', UserController::class);
        Route::resource('/tipe', TipeController::class);
        Route::resource('/karakteristik', KarakteristikController::class);
        Route::resource('/pengetahuan', PengetahuanController::class);
        Route::get('/show-tipe', [PengetahuanController::class, 'showTipe'])->name('show-tipe');
        Route::get('/show-karakteristik', [PengetahuanController::class, 'showKarakteristik'])->name('show-karakteristik');
    });
});

Route::middleware(['auth', 'role:Siswa'])->group(function () {
    Route::name('siswa.')->group(function () {
        Route::get('/home', [HomeController::class, 'index'])->name('home');
        Route::get('/tes-minat', [HomeController::class, 'tesMinat'])->name('tes-minat');
        Route::get('/tes-bakat', [HomeController::class, 'tesBakat'])->name('tes-bakat');
        Route::get('/hasil-tes', [HomeController::class, 'hasilTes'])->name('hasil-tes');
        Route::get('/hasil-tes/{id}', [HomeController::class, 'hasilTesUser'])->name('hasil-tes-user');
    });
});

Auth::routes();

