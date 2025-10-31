<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Site\SiteController;
use App\Http\Controllers\Site\LoginController;
use App\Http\Controllers\DashboardController;


Route::get('/cek-koneksi', [SiteController::class, 'cekKoneksi'])->name('cek.koneksi');

Route::get('/', [SiteController::class, 'home'])->name('home');
Route::get('/struktur', [SiteController::class, 'struktur'])->name('struktur');
Route::get('/informasi', [SiteController::class, 'informasi'])->name('informasi');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout'); 

Auth::routes();

Route::middleware('auth')->group(function () {
    // dashboard utama (otomatis cek role)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // administrator
    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');

        Route::get('/admin/jenishewan', [App\Http\Controllers\Admin\JenisHewanController::class, 'index'])->name('admin.jenishewan.index');
        Route::get('/admin/pemilik', [App\Http\Controllers\Admin\PemilikController::class, 'index'])->name('admin.pemilik.index');
        Route::get('/admin/kategori', [App\Http\Controllers\Admin\KategoriController::class, 'index'])->name('admin.kategori.index');
        Route::get('/admin/kategoriklinis', [App\Http\Controllers\Admin\KategoriKlinisController::class, 'index'])->name('admin.kategoriklinis.index');
        Route::get('/admin/kodetindakan', [App\Http\Controllers\Admin\KodeTindakanController::class, 'index'])->name('admin.kodetindakan.index');
        Route::get('/admin/rashewan', [App\Http\Controllers\Admin\RasHewanController::class, 'index'])->name('admin.rashewan.index');
        Route::get('/admin/pet', [App\Http\Controllers\Admin\PetController::class, 'index'])->name('admin.pet.index');
        Route::get('/admin/role', [App\Http\Controllers\Admin\RoleController::class, 'index'])->name('admin.role.index');
        Route::get('/admin/roleuser', [App\Http\Controllers\Admin\RoleUserController::class, 'index'])->name('admin.roleuser.index');
    });

    // perawat
    Route::prefix('perawat')->middleware('auth')->group(function () {
        Route::get('/dashboard', function () {
            return view('perawat.dashboard');
        })->name('perawat.dashboard');
    });
    
});