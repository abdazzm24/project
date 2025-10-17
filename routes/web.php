<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Site\SiteController;
use App\Http\Controllers\Site\LoginController;


Route::get('/', [SiteController::class, 'home'])->name('home');
Route::get('/struktur', [SiteController::class, 'struktur'])->name('struktur');
Route::get('/informasi', [SiteController::class, 'informasi'])->name('informasi');
Route::get('/login', [LoginController::class, 'login'])->name('login');
