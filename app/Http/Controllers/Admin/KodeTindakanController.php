<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\KodeTindakanTerapi;

class KodeTindakanController extends Controller
{
    public function index()
    {
        $kodeTindakan = KodeTindakanTerapi::with(['kategori', 'kategoriKlinis'])->get();
        return view('admin.kodetindakan.index', compact('kodeTindakan'));
    }
}
