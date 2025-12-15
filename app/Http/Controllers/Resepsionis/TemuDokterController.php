<?php

namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use App\Models\TemuDokter;
use App\Models\Pet;
use App\Models\RoleUser;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TemuDokterController extends Controller
{
    public function index(Request $request)
    {
        $date = $request->query('date', Carbon::today()->toDateString());

        $antrian = TemuDokter::with(['pet.pemilik.user', 'roleuser.user'])
            ->byDate($date)
            ->orderBy('waktu_daftar')
            ->orderBy('no_urut')
            ->get();
        $pets = Pet::with('pemilik.user')->orderBy('nama')->get();
        $dokters = RoleUser::with('user')
            ->where('idrole', 2)
            ->get();

        return view('resepsionis.temudokter.index', compact('antrian', 'pets', 'dokters', 'date'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'idpet' => 'required|exists:pet,idpet',
            'idrole_user' => 'required|exists:role_user,idrole_user'
        ]);

        TemuDokter::create([
            'idpet'         => $request->idpet,
            'idrole_user'   => $request->idrole_user,
            'no_urut'       => TemuDokter::getNextNoUrut(),
            'status'        => 'M',
            'waktu_daftar'  => now(),
        ]);

        return redirect()->route('resepsionis.temudokter.index', ['date' => Carbon::today()->toDateString()])
            ->with('success', 'Antrian berhasil ditambahkan!');
    }

    public function selesai($id)
    {
        $antrian = TemuDokter::findOrFail($id);
        $antrian->update(['status' => 'S']);

        return back()->with('success', 'Status antrian diubah menjadi Selesai');
    }
}