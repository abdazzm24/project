<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $role = $user->roleUser[0]->idrole ?? null;

        switch ($role) {
            case 1: // administrator
                return view('admin.dashboard');
            case 2: // dokter
                return view('dokter.dashboard');
            case 3: // perawat
                return view('perawat.dashboard');
            case 4: // resepsionis
                return view('resepsionis.dashboard');
            case 5: // pemilik
                return view('pemilik.dashboard');
            default:
                return redirect('/')->with('error', 'Role tidak dikenali.');
        }
    }
}
