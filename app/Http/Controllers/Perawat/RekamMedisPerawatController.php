<?php

namespace App\Http\Controllers\Perawat;

use App\Http\Controllers\Controller;
use App\Models\RekamMedis;
use App\Models\DetailRekamMedis;
use App\Models\Pet;
use App\Models\RoleUser;
use App\Models\KodeTindakanTerapi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RekamMedisPerawatController extends Controller
{
    public function index()
    {
        $rekamMedis = RekamMedis::with(['pet.pemilik.user', 'dokter.user'])
            ->latest('created_at')
            ->get();

        return view('perawat.rekammedis.index', compact('rekamMedis'));
    }

    public function create()
    {
        $pets      = Pet::orderBy('nama')->get();
        $dokters   = RoleUser::with('user')
            ->where('idrole', 2)           // sesuai native kamu (idrole = 2 = dokter)
            ->where('status', 1)
            ->get();
        $tindakans = KodeTindakanTerapi::orderBy('kode')->get();

        return view('perawat.rekammedis.create', compact('pets', 'dokters', 'tindakans'));
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
            return redirect()->route('perawat.rekammedis.index')
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

        return view('perawat.rekammedis.show', compact('rekam'));
    }

    public function edit($id)
    {
        $rekam = RekamMedis::with(['pet', 'dokter.user', 'details.tindakan'])->findOrFail($id);

        $pets      = Pet::orderBy('nama')->get();
        $dokters   = RoleUser::with('user')
            ->where('idrole', 2)
            ->where('status', 1)
            ->get();
        $tindakans = KodeTindakanTerapi::orderBy('kode')->get();

        return view('perawat.rekammedis.edit', compact('rekam', 'pets', 'dokters', 'tindakans'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'idpet'            => 'required|exists:pet,idpet',
            'dokter_pemeriksa' => 'required|exists:role_user,idrole_user',
            'anamnesa'         => 'required',
            'temuan_klinis'    => 'required',
            'diagnosa'         => 'required',
        ]);

        DB::beginTransaction();
        try {
            $rekam = RekamMedis::findOrFail($id);
            $rekam->update($request->only([
                'idpet', 'dokter_pemeriksa', 'anamnesa', 'temuan_klinis', 'diagnosa'
            ]));

            // Hapus detail lama, buat baru (lebih simpel & aman)
            DetailRekamMedis::where('idrekam_medis', $id)->delete();

            if ($request->has('tindakan')) {
                foreach ($request->tindakan as $i => $idtindakan) {
                    if (!empty($idtindakan)) {
                        DetailRekamMedis::create([
                            'idrekam_medis'           => $id,
                            'idkode_tindakan_terapi'  => $idtindakan,
                            'detail'                  => $request->detail[$i] ?? null,
                        ]);
                    }
                }
            }

            DB::commit();
            return redirect()->route('perawat.rekammedis.index')
                ->with('success', 'Rekam medis berhasil diperbarui!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal update: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            DetailRekamMedis::where('idrekam_medis', $id)->delete();
            RekamMedis::findOrFail($id)->delete();

            DB::commit();
            return redirect()->route('perawat.rekammedis.index')
                ->with('success', 'Rekam medis berhasil dihapus!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal menghapus!');
        }
    }
}