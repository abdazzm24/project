<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Kategori;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = Kategori::all();
        return view('admin.kategori.index', compact('kategori'));
    }

    public function create()
    {
        return view('admin.kategori.create');
    }

    public function store(Request $request)
    {
        $data = $this->validateKategori($request);

        $this->createKategori($data);

        return redirect()->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('admin.kategori.edit', compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        $data = $this->validateKategori($request, $id);

        $kategori = Kategori::findOrFail($id);
        $kategori->update([
            'nama_kategori' => $this->formatNama($data['nama_kategori'])
        ]);

        return redirect()->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();

        return redirect()->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }

    // VALIDATION
    private function validateKategori(Request $request, $id = null)
    {
        $unique = $id
            ? 'unique:kategori,nama_kategori,' . $id . ',idkategori'
            : 'unique:kategori,nama_kategori';

        return $request->validate([
            'nama_kategori' => ['required', 'string', 'max:100', $unique],
        ]);
    }

    // HELPER CREATE
    private function createKategori(array $data)
    {
        try {
            return Kategori::create([
                'idkategori'    => $this->getNextId(),
                'nama_kategori' => $this->formatNama($data['nama_kategori']),
            ]);
        } catch (\Exception $e) {
            throw new \Exception('Gagal menyimpan data Kategori: ' . $e->getMessage());
        }
    }

    private function getNextId()
    {
        $last = Kategori::orderBy('idkategori', 'desc')->first();
        return $last ? $last->idkategori + 1 : 1;
    }

    // HELPER FORMAT NAMA
    private function formatNama($value)
    {
        return trim(ucwords(strtolower($value)));
    }

}
