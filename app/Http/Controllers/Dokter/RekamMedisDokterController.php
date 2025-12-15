<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\RekamMedis;
use App\Models\DetailRekamMedis;
use App\Models\Pet;
use App\Models\RoleUser;
use App\Models\KodeTindakanTerapi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RekamMedisDokterController extends Controller
{
    public function index()
    {
        $rekamMedis = RekamMedis::with(['pet.pemilik.user', 'dokter.user'])
            ->latest('created_at')
            ->get();

        return view('dokter.rekammedis.index', compact('rekamMedis'));
    }

    public function create()
    {
        $pets      = Pet::orderBy('nama')->get();
        $dokters   = RoleUser::with('user')
            ->where('idrole', 2)           // sesuai native kamu (idrole = 2 = dokter)
            ->where('status', 1)
            ->get();
        $tindakans = KodeTindakanTerapi::orderBy('kode')->get();

        return view('dokter.rekammedis.create', compact('pets', 'dokters', 'tindakans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'idpet'             => 'required|exists:pet,idpet',
            'dokter_pemeriksa'  => 'required|exists:role_user,idrole_user',
            'anamnesa'          => 'required',
            'temuan_klinis'     => 'required',
            'diagnosa'          => 'required',
            'tindakan.*'        => 'nullable|exists:kode_tindakan_terapi,idkode_tindakan_terapi',
            'detail.*'          => 'nullable|string',
        ]);

        DB::beginTransaction();
        try {
            $rekam = RekamMedis::create([
                'created_at'        => now(),
                'idpet'             => $request->idpet,
                'dokter_pemeriksa'  => $request->dokter_pemeriksa,
                'anamnesa'          => $request->anamnesa,
                'temuan_klinis'     => $request->temuan_klinis,
                'diagnosa'          => $request->diagnosa,
            ]);

            if ($request->has('tindakan')) {
                foreach ($request->tindakan as $i => $idtindakan) {
                    if (!empty($idtindakan)) {
                        DetailRekamMedis::create([
                            'idrekam_medis'           => $rekam->idrekam_medis,
                            'idkode_tindakan_terapi'  => $idtindakan,
                            'detail'                  => $request->detail[$i] ?? null,
                        ]);
                    }
                }
            }

            DB::commit();
            return redirect()->route('dokter.rekammedis.index')
                ->with('success', 'Rekam medis berhasil disimpan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal menyimpan: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $rekam = RekamMedis::with([
            'pet.pemilik.user',
            'dokter.user',
            'details.tindakan.kategori',
            'details.tindakan.kategoriKlinis'
        ])->findOrFail($id);

        return view('dokter.rekammedis.show', compact('rekam'));
    }
}