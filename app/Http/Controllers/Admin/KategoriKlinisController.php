<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\KategoriKlinis;

class KategoriKlinisController extends Controller
{
    public function index()
    {
        $kategoriKlinis = KategoriKlinis::all();
        return view('admin.kategoriklinis.index', compact('kategoriKlinis'));
    }

    public function create()
    {
        return view('admin.kategoriklinis.create');
    }

    public function store(Request $request)
    {
        $data = $this->validateKlinis($request);
        $this->createKlinis($data);

        return redirect()->route('admin.kategoriklinis.index')
            ->with('success', 'Kategori Klinis berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $kategoriKlinis = KategoriKlinis::findOrFail($id);
        return view('admin.kategoriklinis.edit', compact('kategoriKlinis'));
    }

    public function update(Request $request, $id)
    {
        $data = $this->validateKlinis($request, $id);

        $kategoriKlinis = KategoriKlinis::findOrFail($id);
        $kategoriKlinis->update([
            'nama_kategori_klinis' => $this->formatNama($data['nama_kategori_klinis']),
        ]);

        return redirect()->route('admin.kategoriklinis.index')
            ->with('success', 'Kategori Klinis berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kategoriKlinis = KategoriKlinis::findOrFail($id);
        $kategoriKlinis->delete();

        return redirect()->route('admin.kategoriklinis.index')
            ->with('success', 'Kategori Klinis berhasil dihapus.');
    }

    /* ==================================
       VALIDATION
    ================================== */
    private function validateKlinis(Request $request, $id = null)
    {
        $unique = $id
            ? 'unique:kategori_klinis,nama_kategori_klinis,' . $id . ',idkategori_klinis'
            : 'unique:kategori_klinis,nama_kategori_klinis';

        return $request->validate([
            'nama_kategori_klinis' => ['required', 'string', 'max:100', $unique],
        ]);
    }

    /* ==================================
       HELPER GENERATE ID MANUAL
    ================================== */
    private function getNextId()
    {
        $last = KategoriKlinis::orderBy('idkategori_klinis', 'desc')->first();
        return $last ? $last->idkategori_klinis + 1 : 1;
    }

    private function createKlinis(array $data)
    {
        try {
            return KategoriKlinis::create([
                'idkategori_klinis'    => $this->getNextId(),
                'nama_kategori_klinis' => $this->formatNama($data['nama_kategori_klinis']),
            ]);
        } catch (\Exception $e) {
            throw new \Exception('Gagal menyimpan data Kategori Klinis: ' . $e->getMessage());
        }
    }

    /* ==================================
       FORMAT NAMA
    ================================== */
    private function formatNama($v)
    {
        return trim(ucwords(strtolower($v)));
    }

}
