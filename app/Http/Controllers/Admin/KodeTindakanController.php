<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\KategoriKlinis;
use Illuminate\Http\Request;

use App\Models\KodeTindakanTerapi;

class KodeTindakanController extends Controller
{
    public function index()
    {
        $kodeTindakan = KodeTindakanTerapi::with(['kategori', 'kategoriKlinis'])->get();
        return view('admin.kodetindakan.index', compact('kodeTindakan'));
    }

    public function create()
    {
        return view('admin.kodetindakan.create', [
            'kategori' => Kategori::all(),
            'kategoriKlinis' => KategoriKlinis::all()
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);

        KodeTindakanTerapi::create([
            'kode'                     => strtoupper($data['kode']),
            'deskripsi_tindakan_terapi'=> $data['deskripsi_tindakan_terapi'],
            'idkategori'               => $data['idkategori'],
            'idkategori_klinis'        => $data['idkategori_klinis'],
        ]);

        return redirect()->route('admin.kodetindakan.index')
            ->with('success', 'Kode tindakan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        return view('admin.kodetindakan.edit', [
            'kode' => KodeTindakanTerapi::findOrFail($id),
            'kategori' => Kategori::all(),
            'kategoriKlinis' => KategoriKlinis::all()
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = $this->validateData($request, $id);

        $kode = KodeTindakanTerapi::findOrFail($id);
        $kode->update([
            'kode'                     => strtoupper($data['kode']),
            'deskripsi_tindakan_terapi'=> $data['deskripsi_tindakan_terapi'],
            'idkategori'               => $data['idkategori'],
            'idkategori_klinis'        => $data['idkategori_klinis'],
        ]);

        return redirect()->route('admin.kodetindakan.index')
            ->with('success', 'Kode tindakan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        KodeTindakanTerapi::findOrFail($id)->delete();

        return redirect()->route('admin.kodetindakan.index')
            ->with('success', 'Kode tindakan berhasil dihapus.');
    }

    private function validateData(Request $request, $id = null)
    {
        $unique = $id
            ? 'unique:kode_tindakan_terapi,kode,' . $id . ',idkode_tindakan_terapi'
            : 'unique:kode_tindakan_terapi,kode';

        return $request->validate([
            'kode' => ['required', 'string', 'max:5', 'regex:/^[A-Za-z][0-9]{2}$/', $unique],
            'deskripsi_tindakan_terapi' => ['required', 'string', 'max:255'],
            'idkategori' => ['required', 'exists:kategori,idkategori'],
            'idkategori_klinis' => ['required', 'exists:kategori_klinis,idkategori_klinis'],
        ], [
            'kode.regex' => 'Format kode harus seperti T01 atau A15.',
            'kode.unique' => 'Kode tindakan sudah digunakan, gunakan kode lain.',
        ]);
    }

}
