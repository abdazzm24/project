<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\JenisHewan;

class JenisHewanController extends Controller
{
    public function index()
    {
        // $jenisHewan = JenisHewan::select('idjenis_hewan', 'nama_jenis_hewan')->get();
        $jenisHewan = JenisHewan::all();
        return view('admin.jenishewan.index', compact('jenisHewan'));
    }

    public function create()
    {
        return view('admin.jenishewan.create');
    }

    public function store(Request $request)
    {
        $data = $this->validateJenisHewan($request);

        $this->createJenisHewan($data);

        return redirect()->route('admin.jenishewan.index')
            ->with('success', 'Jenis Hewan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $jenisHewan = JenisHewan::findOrFail($id);
        return view('admin.jenishewan.edit', compact('jenisHewan'));
    }

    public function update(Request $request, $id)
    {
        $data = $this->validateJenisHewan($request, $id);

        $jenisHewan = JenisHewan::findOrFail($id);

        $jenisHewan->update([
            'nama_jenis_hewan' => $this->formatNamaJenisHewan($data['nama_jenis_hewan']),
        ]);

        return redirect()->route('admin.jenishewan.index')
            ->with('success', 'Jenis Hewan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $jenisHewan = JenisHewan::findOrFail($id);
        $jenisHewan->delete();

        return redirect()->route('admin.jenishewan.index')
            ->with('success', 'Jenis Hewan berhasil dihapus.');
    }

    protected function validateJenisHewan(Request $request, $id = null)
    {
        // data yang bersifat uniq
        $uniqueRule = $id 
            ? 'unique:jenis_hewan,nama_jenis_hewan,' . $id . ',idjenis_hewan' 
            : 'unique:jenis_hewan,nama_jenis_hewan';
    
        // validasi data input
        return $request->validate([
            'nama_jenis_hewan' => [
                'required', 'string', 'max:50', $uniqueRule],
        ], [
            'nama_jenis_hewan.required' => 'Nama Jenis Hewan wajib diisi.',
            'nama_jenis_hewan.string' => 'Nama Jenis Hewan harus berupa teks.',
            'nama_jenis_hewan.unique' => 'Nama Jenis Hewan sudah ada dalam database.',
            'nama_jenis_hewan.max' => 'Nama Jenis Hewan maksimal 50 karakter.',
        ]);
    }

    protected function createJenisHewan(array $data)
    {
        try {
            return JenisHewan::create([
                'nama_jenis_hewan' => $this->formatNamaJenisHewan($data['nama_jenis_hewan']),
            ]);
        } catch (\Exception $e) {
            // Log the error or handle it as needed
            throw new \Exception('Gagal menyimpan data Jenis Hewan: ' . $e->getMessage());
        }
    }

    protected function formatNamaJenisHewan($nama)
    {
        return trim(ucwords(strtolower($nama)));
    }
}