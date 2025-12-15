<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RasHewan;
use App\Models\JenisHewan; // PENTING: Import Model JenisHewan
use Exception; 

class RasHewanController extends Controller
{
    public function index()
    {
        // PERBAIKAN UTAMA: Menggunakan with('jenisHewan') untuk eager loading
        $rashewan = RasHewan::with('jenisHewan')->get();
        return view('admin.rashewan.index', compact('rashewan'));
    }

    public function create()
    {
        // PERBAIKAN PENTING: Mengambil semua JenisHewan untuk dropdown di View
        $jenisHewan = JenisHewan::all(); 
        return view('admin.rashewan.create', compact('jenisHewan'));
    }

    public function store(Request $request)
    {
        try {
            // Validasi sekarang mencakup idjenis_hewan
            $validatedData = $this->validateRasHewan($request); 
            
            // Helper sekarang menyimpan idjenis_hewan
            $this->createRasHewan($validatedData); 

            return redirect()->route('admin.rashewan.index')
                ->with('success', 'Ras hewan berhasil ditambahkan.');

        } catch (Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }
    
    // ----------- FUNGSI CRUD (EDIT, UPDATE, DESTROY) -----------
    
    // Fungsi untuk menampilkan form edit
    public function edit($idras_hewan)
    {
        $rashewan = RasHewan::findOrFail($idras_hewan);
        // PERBAIKAN PENTING: Mengirim semua JenisHewan untuk dropdown
        $jenisHewan = JenisHewan::all();
        return view('admin.rashewan.edit', compact('rashewan', 'jenisHewan'));
    }

    // Fungsi untuk memproses data yang diubah
    public function update(Request $request, $idras_hewan)
    {
        try {
            // Validasi sekarang mencakup idjenis_hewan
            $validatedData = $this->validateRasHewan($request, $idras_hewan); 
            
            // Helper sekarang menyimpan idjenis_hewan
            $this->updateRasHewan($idras_hewan, $validatedData);

            return redirect()->route('admin.rashewan.index')
                ->with('success', 'Ras hewan berhasil diperbarui.');

        } catch (Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }
    
    // Fungsi untuk menghapus data
    public function destroy($idras_hewan)
    {
        try {
            $rashewan = RasHewan::findOrFail($idras_hewan);
            $rashewan->delete();
            
            return redirect()->route('admin.rashewan.index')
                ->with('success', 'Ras hewan berhasil dihapus.');
        } catch (Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
    
    // ----------- VALIDATION (DIUBAH) -----------
    protected function validateRasHewan(Request $request, $id = null)
    {
        $uniqueRule = $id 
            ? 'unique:ras_hewan,nama_ras,' . $id . ',idras_hewan' 
            : 'unique:ras_hewan,nama_ras'; 

        return $request->validate([
            'nama_ras' => [
                'required', 
                'string', 
                'max:255', 
                'min:3', 
                $uniqueRule 
            ],
            // PENTING: Validasi untuk Foreign Key
            'idjenis_hewan' => [
                'required',
                'integer',
                'exists:jenis_hewan,idjenis_hewan' 
            ]
        ], [
            'nama_ras.required' => 'Nama ras hewan wajib diisi.', 
            'nama_ras.string' => 'Nama ras hewan harus berupa teks.', 
            'nama_ras.max' => 'Nama ras hewan maksimal 255 karakter.', 
            'nama_ras.min' => 'Nama ras hewan minimal 3 karakter.', 
            'nama_ras.unique' => 'Nama ras hewan sudah ada.', 
            'idjenis_hewan.required' => 'Jenis hewan wajib dipilih.',
            'idjenis_hewan.integer' => 'Jenis hewan harus berupa angka.',
            'idjenis_hewan.exists' => 'Jenis hewan yang dipilih tidak valid.'
        ]);
    }
    
    // ----------- HELPER (DIUBAH) -----------
    
    // Helper untuk membuat data baru (CREATE)
    protected function createRasHewan(array $data) 
    {
        try {
            return RasHewan::create([ 
                'nama_ras' => $this->formatNamaRas($data['nama_ras']),
                'idjenis_hewan' => $data['idjenis_hewan'], // PENTING: Menyimpan Foreign Key
            ]);
        } catch (Exception $e) { 
            throw new Exception('Gagal menyimpan data ras hewan: ' . $e->getMessage()); 
        }
    }

    // Helper untuk memperbarui data (UPDATE)
    protected function updateRasHewan($idras_hewan, array $data) 
    {
        try {
            $rashewan = RasHewan::findOrFail($idras_hewan);
            return $rashewan->update([
                'nama_ras' => $this->formatNamaRas($data['nama_ras']),
                'idjenis_hewan' => $data['idjenis_hewan'], // PENTING: Menyimpan Foreign Key
            ]);
        } catch (Exception $e) { 
            throw new Exception('Gagal memperbarui data ras hewan: ' . $e->getMessage()); 
        }
    }

    // Helper untuk format nama menjadi Title Case
    protected function formatNamaRas($nama) 
    {
        return trim(ucwords(strtolower($nama))); 
    }
}