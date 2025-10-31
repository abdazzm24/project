<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SiteController extends Controller
{
    public function home()
    {
        return view('home.home');
    }
    public function struktur()
    {
        return view('home.struktur');
    }

    public function informasi()
    {
        return view('home.informasi');
    }

    public function cekKoneksi()
    {
        try {
            // Coba lakukan koneksi ke database
            DB::connection()->getPdo();
            return 'Koneksi ke database berhasil!';
        } catch (\Exception $e) {
            return 'Koneksi ke database gagal: ' . $e->getMessage();
        }
    }
}
