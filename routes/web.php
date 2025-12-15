<?php

use App\Http\Controllers\Admin\JenisHewanController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\KategoriKlinisController;
use App\Http\Controllers\Admin\KodeTindakanController;
use App\Http\Controllers\Admin\PemilikController;
use App\Http\Controllers\Admin\RasHewanController;
use App\Http\Controllers\Admin\RoleUserController;
use App\Http\Controllers\Dokter\RekamMedisDokterController;
use App\Http\Controllers\Dokter\RekamMedisPerawatController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Site\SiteController;
use App\Http\Controllers\Site\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Site\RegisterController;


Route::get('/cek-koneksi', [SiteController::class, 'cekKoneksi'])->name('cek.koneksi');

Route::get('/', [SiteController::class, 'home'])->name('home');
Route::get('/struktur', [SiteController::class, 'struktur'])->name('struktur');
Route::get('/informasi', [SiteController::class, 'informasi'])->name('informasi');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


// administrator routes
Route::prefix('admin')->middleware('auth', 'isAdmin')->group(function () {
    // dashboard
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // JENIS HEWAN CRUD
    Route::get('/jenishewan', [JenisHewanController::class, 'index'])
        ->name('admin.jenishewan.index');
    Route::get('/jenishewan/create', [JenisHewanController::class, 'create'])
        ->name('admin.jenishewan.create');
    Route::post('/jenishewan', [JenisHewanController::class, 'store'])
        ->name('admin.jenishewan.store');
    Route::get('/jenishewan/{id}/edit', [JenisHewanController::class, 'edit'])
        ->name('admin.jenishewan.edit');
    Route::put('/jenishewan/{id}', [JenisHewanController::class, 'update'])
        ->name('admin.jenishewan.update');
    Route::delete('/jenishewan/{id}', [JenisHewanController::class, 'destroy'])
        ->name('admin.jenishewan.destroy');

    // RAS HEWAN CRUD
    Route::get('/rashewan', [RasHewanController::class, 'index'])
        ->name('admin.rashewan.index');
    Route::get('/rashewan/create', [RasHewanController::class, 'create'])
        ->name('admin.rashewan.create');
    Route::post('/rashewan', [RasHewanController::class, 'store'])
        ->name('admin.rashewan.store');
    Route::get('/rashewan/{id}/edit', [RasHewanController::class, 'edit'])
        ->name('admin.rashewan.edit');
    Route::put('/rashewan/{id}', [RasHewanController::class, 'update'])
        ->name('admin.rashewan.update');
    Route::delete('/rashewan/{id}', [RasHewanController::class, 'destroy'])
        ->name('admin.rashewan.destroy');

    // KATEGORI CRUD
    Route::get('/kategori', [KategoriController::class, 'index'])
        ->name('admin.kategori.index');
    Route::get('/kategori/create', [KategoriController::class, 'create'])
        ->name('admin.kategori.create');
    Route::post('/kategori', [KategoriController::class, 'store'])
        ->name('admin.kategori.store');
    Route::get('/kategori/{id}/edit', [KategoriController::class, 'edit'])
        ->name('admin.kategori.edit');
    Route::put('/kategori/{id}', [KategoriController::class, 'update'])
        ->name('admin.kategori.update');
    Route::delete('/kategori/{id}', [KategoriController::class, 'destroy'])
        ->name('admin.kategori.destroy');

    // KATEGORI KLINIS CRUD
    Route::get('/kategoriklinis', [KategoriKlinisController::class, 'index'])
        ->name('admin.kategoriklinis.index');
    Route::get('/kategoriklinis/create', [KategoriKlinisController::class, 'create'])
        ->name('admin.kategoriklinis.create');
    Route::post('/kategoriklinis', [KategoriKlinisController::class, 'store'])
        ->name('admin.kategoriklinis.store');
    Route::get('/kategoriklinis/{id}/edit', [KategoriKlinisController::class, 'edit'])
        ->name('admin.kategoriklinis.edit');
    Route::put('/kategoriklinis/{id}', [KategoriKlinisController::class, 'update'])
        ->name('admin.kategoriklinis.update');
    Route::delete('/kategoriklinis/{id}', [KategoriKlinisController::class, 'destroy'])
        ->name('admin.kategoriklinis.destroy');

    // KODE TINDAKAN TERAPI CRUD
    Route::get('/kodetindakan', [KodeTindakanController::class, 'index'])
        ->name('admin.kodetindakan.index');
    Route::get('/kodetindakan/create', [KodeTindakanController::class, 'create'])
        ->name('admin.kodetindakan.create');
    Route::post('/kodetindakan', [KodeTindakanController::class, 'store'])
        ->name('admin.kodetindakan.store');
    Route::get('/kodetindakan/{id}/edit', [KodeTindakanController::class, 'edit'])
        ->name('admin.kodetindakan.edit');
    Route::put('/kodetindakan/{id}', [KodeTindakanController::class, 'update'])
        ->name('admin.kodetindakan.update');
    Route::delete('/kodetindakan/{id}', [KodeTindakanController::class, 'destroy'])
        ->name('admin.kodetindakan.destroy');

    // PEMILIK CRUD
    Route::get('/pemilik', [PemilikController::class, 'index'])
        ->name('admin.pemilik.index');
    Route::get('/pemilik/create', [PemilikController::class, 'create'])
        ->name('admin.pemilik.create');
    Route::post('/pemilik', [PemilikController::class, 'store'])
        ->name('admin.pemilik.store');
    Route::get('/pemilik/{id}/edit', [PemilikController::class, 'edit'])
        ->name('admin.pemilik.edit');
    Route::put('/pemilik/{id}', [PemilikController::class, 'update'])
        ->name('admin.pemilik.update');
    Route::delete('/pemilik/{id}', [PemilikController::class, 'destroy'])
        ->name('admin.pemilik.destroy');

    // PET CRUD (TAMBAHKAN DI BAWAH ROUTE PEMILIK, MASIH DI DALAM group admin)
    Route::get('/pet', [App\Http\Controllers\Admin\PetController::class, 'index'])
        ->name('admin.pet.index');
    Route::get('/pet/create', [App\Http\Controllers\Admin\PetController::class, 'create'])
        ->name('admin.pet.create');
    Route::post('/pet', [App\Http\Controllers\Admin\PetController::class, 'store'])
        ->name('admin.pet.store');
    Route::get('/pet/{idpet}/edit', [App\Http\Controllers\Admin\PetController::class, 'edit'])
        ->name('admin.pet.edit');
    Route::put('/pet/{idpet}', [App\Http\Controllers\Admin\PetController::class, 'update'])
        ->name('admin.pet.update');
    Route::delete('/pet/{idpet}', [App\Http\Controllers\Admin\PetController::class, 'destroy'])
        ->name('admin.pet.destroy');    Route::get('/role', [App\Http\Controllers\Admin\RoleController::class, 'index'])->name('admin.role.index');

    // ROLE USER CRUD
    Route::get('/roleuser', [RoleUserController::class, 'index'])
        ->name('admin.roleuser.index');
    Route::get('/roleuser/create', [RoleUserController::class, 'create'])
        ->name('admin.roleuser.create');
    Route::post('/roleuser', [RoleUserController::class, 'store'])
        ->name('admin.roleuser.store');
    Route::get('/roleuser/{id}/edit', [RoleUserController::class, 'edit'])
        ->name('admin.roleuser.edit');
    Route::put('/roleuser/{id}', [RoleUserController::class, 'update'])
        ->name('admin.roleuser.update');
    Route::delete('/roleuser/{id}', [RoleUserController::class, 'destroy'])
        ->name('admin.roleuser.destroy');
});

// dokter routes
Route::prefix('dokter')->name('dokter.')->middleware('auth', 'isDokter')->group(function () {
    // dashboard
    Route::get('/dashboard', function () {
        return view('dokter.dashboard');
    })->name('dashboard');
    Route::get('/rekammedis', [RekamMedisDokterController::class, 'index'])
        ->name('rekammedis.index');
    Route::get('/rekammedis/create', [RekamMedisDokterController::class, 'create'])
        ->name('rekammedis.create');
    Route::post('/rekammedis', [RekamMedisDokterController::class, 'store'])
        ->name('rekammedis.store');
    Route::get('/rekammedis/{id}', [RekamMedisDokterController::class, 'show'])
        ->name('rekammedis.show');
});

// perawat routes
Route::prefix('perawat')->name('perawat.')->middleware('auth', 'isPerawat')->group(function () {
    // dashboard
    Route::get('/dashboard', function () {
        return view('perawat.dashboard');
    })->name('dashboard');

    Route::get('/rekammedis', [\App\Http\Controllers\Perawat\RekamMedisPerawatController::class, 'index'])
     ->name('rekammedis.index');
    Route::get('/rekammedis/create', [\App\Http\Controllers\Perawat\RekamMedisPerawatController::class, 'create'])
        ->name('rekammedis.create');
    Route::post('/rekammedis', [\App\Http\Controllers\Perawat\RekamMedisPerawatController::class, 'store'])
        ->name('rekammedis.store');
    Route::get('/rekammedis/{rekamMedis}', [\App\Http\Controllers\Perawat\RekamMedisPerawatController::class, 'show'])
        ->name('rekammedis.show');
    Route::get('/rekammedis/{id}/edit', [\App\Http\Controllers\Perawat\RekamMedisPerawatController::class, 'edit'])
        ->name('rekammedis.edit');
    Route::put('/rekammedis/{id}', [\App\Http\Controllers\Perawat\RekamMedisPerawatController::class, 'update'])
        ->name('rekammedis.update');
    Route::delete('/rekammedis/{id}', [\App\Http\Controllers\Perawat\RekamMedisPerawatController::class, 'destroy'])
        ->name('rekammedis.destroy');
});

// resepsionis routes
Route::prefix('resepsionis')->name('resepsionis.')->middleware('auth', 'isResepsionis')->group(function () {
    // dashboard
    Route::get('/dashboard', function () {
        return view('resepsionis.dashboard');
    })->name('dashboard');

    // REGIS PEMILIK
    Route::get('/regispemilik', [\App\Http\Controllers\Resepsionis\RegisPemilikController::class, 'index'])
        ->name('regispemilik.index');
    Route::get('/regispemilik/create', [\App\Http\Controllers\Resepsionis\RegisPemilikController::class, 'create'])
        ->name('regispemilik.create');
    Route::post('/regispemilik', [\App\Http\Controllers\Resepsionis\RegisPemilikController::class, 'store'])
        ->name('regispemilik.store');
    
    // REGIS PET
    Route::get('/regispet', [\App\Http\Controllers\Resepsionis\RegisPetController::class, 'index'])
        ->name('regispet.index');
    Route::get('/regispet/create', [\App\Http\Controllers\Resepsionis\RegisPetController::class, 'create'])
        ->name('regispet.create');
    Route::post('/regispet', [\App\Http\Controllers\Resepsionis\RegisPetController::class, 'store'])
        ->name('regispet.store');
    
    // TEMU DOKTER
    Route::get('/temudokter', [\App\Http\Controllers\Resepsionis\TemuDokterController::class, 'index'])
        ->name('temudokter.index');
    Route::post('/temudokter', [\App\Http\Controllers\Resepsionis\TemuDokterController::class, 'store'])
        ->name('temudokter.store');
    Route::post('/temudokter/{id}/selesai', [\App\Http\Controllers\Resepsionis\TemuDokterController::class, 'selesai'])
        ->name('temudokter.selesai');

});

// pemilik routes
Route::prefix('pemilik')->name('pemilik.')->middleware('auth', 'isPemilik')->group(function () {
    // dashboard
    Route::get('/dashboard', function () {
        return view('pemilik.dashboard');
    })->name('dashboard');

});
