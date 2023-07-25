<?php

use App\Http\Controllers\Admin\KarakteristikController;
use App\Http\Controllers\Admin\PengetahuanController;
use App\Http\Controllers\Admin\TipeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\JurusanController;
use App\Http\Controllers\Admin\SolusiController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KelasController;

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
        Route::resource('/kelas', KelasController::class);
        Route::get('/show-guru', [KelasController::class, 'guruShows'])->name('show-guru');
        Route::get('/show-siswa', [KelasController::class, 'siswaShows'])->name('show-siswa');
        Route::get('/kelas-delete/{id}', [KelasController::class, 'destroy' ]);

        // Route::resource('/tipe', TipeController::class);
        // Route::resource('/karakteristik', KarakteristikController::class);
        // Route::resource('/pengetahuan', PengetahuanController::class);
        // Route::get('/show-tipe', [PengetahuanController::class, 'showTipe'])->name('show-tipe');
        // Route::get('/show-karakteristik', [PengetahuanController::class, 'showKarakteristik'])->name('show-karakteristik');
        // Route::get('/show-tipe', [SolusiController::class, 'showTipe'])->name('show-tipe');
    });
});

Route::middleware(['auth', 'role:Guru'])->group(function () {
    // Route::group(['prefix' => 'Guru', 'namespace' => 'Guru', 'name' => 'guru.'], function () {
        Route::prefix('Guru')->name('guru.')->group(function () {
            Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
            Route::resource('/tipe', TipeController::class);
            Route::resource('/karakteristik', KarakteristikController::class);
            Route::resource('/solusi', SolusiController::class);
            Route::resource('/pengetahuan', PengetahuanController::class);
            Route::resource('/jurusan', JurusanController::class);
            Route::get('/show-tipe', [PengetahuanController::class, 'showTipe'])->name('show-tipe');
            Route::get('/show-karakteristik', [PengetahuanController::class, 'showKarakteristik'])->name('show-karakteristik');
            Route::get('/show-jurusan', [SolusiController::class, 'showJurusan'])->name('show-jurusan');
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

