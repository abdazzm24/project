<?php

namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Pet;
use App\Models\Pemilik;
use App\Models\RasHewan;
use Exception;

class RegisPetController extends Controller
{
    public function index()
    {
        $pet = Pet::with(['pemilik.user', 'rasHewan.jenisHewan'])
        ->orderBy('idpet', 'desc')->get();
        return view('resepsionis.regispet.index', compact('pet'));
    }

    public function create()
    {
        $pemilik = Pemilik::with('user')->get();
        $rasHewan = RasHewan::with('jenisHewan')->get();
        return view('resepsionis.regispet.create', compact('pemilik', 'rasHewan'));
    }

    public function store(Request $request)
    {
        \Log::info('STORE PET: Data masuk', $request->all());

        DB::beginTransaction();

        try {
            $validatedData = $this->validatePet($request);

            // DEBUG: Cek apakah idras ada di tabel ras_hewan
            $rasExists = \DB::table('ras_hewan')->where('idras_hewan', $request->idras)->orWhere('idras_hewan', $request->idras)->exists();
            \Log::info('Ras exists?', ['exists' => $rasExists, 'idras_hewan' => $request->idras]);

            $this->createPet($validatedData);

            DB::commit();

            return redirect()->route('resepsionis.regispet.index')->with('success', 'Pet berhasil ditambahkan!');

        } catch (\Exception $e) {
            DB::rollBack();
            
            \Log::error('GAGAL SIMPAN PET: ' . $e->getMessage());
            \Log::error('File: ' . $e->getFile() . ' Line: ' . $e->getLine());

            // TAMBAHKAN INI BIAR KELIHATAN ERRORNYA DI BROWSER
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal menyimpan: ' . $e->getMessage());
        }
    }

    public function edit($idpet)
    {
        $pet = Pet::with(['pemilik.user', 'rasHewan'])->findOrFail($idpet);
        $pemilik = Pemilik::with('user')->get();
        $rasHewan = RasHewan::with('jenisHewan')->get();

        return view('resepsionis.regispet.edit', compact('pet', 'pemilik', 'rasHewan'));
    }

    public function update(Request $request, $idpet)
    {
        Log::info('UPDATE PET: Request masuk', $request->all());

        try {
            $validatedData = $this->validatePet($request, $idpet);

            $pet = Pet::findOrFail($idpet);
            $pet->update($validatedData);

            return redirect()->route('resepsionis.regispet.index')
                ->with('success', 'Data Pet berhasil diperbarui.');

        } catch (Exception $e) {
            Log::error('UPDATE PET: Gagal', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal memperbarui data pet: ' . $e->getMessage());
        }
    }

    public function destroy($idpet)
    {
        try {
            $pet = Pet::findOrFail($idpet);
            $pet->delete();

            return redirect()->route('resepsionis.regispet.index')
                ->with('success', 'Data Pet berhasil dihapus.');
        } catch (Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menghapus data pet: ' . $e->getMessage());
        }
    }

    protected function validatePet(Request $request, $idpet = null)
    {
        $rules = [
            'idpemilik' => 'required|exists:pemilik,idpemilik',
            'idras_hewan'     => 'required|exists:ras_hewan,idras_hewan',
            'nama'      => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'warna_tanda'   => 'nullable|string|max:255',
            'jenis_kelamin' => 'required|in:Jantan,Betina',
        ];

        $messages = [
            'idpemilik.required' => 'Pemilik wajib dipilih.',
            'idras_hewan.required'     => 'Ras hewan wajib dipilih.',
            'nama.required'      => 'Nama pet wajib diisi.',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
        ];

        return $request->validate($rules, $messages);
    }

    protected function createPet(array $data)
    {
        $nextId = $this->getNextIdPet();

        return Pet::create([
            'idpet'         => $nextId,
            'idpemilik'     => $data['idpemilik'],
            'idras_hewan'         => $data['idras_hewan'],
            'nama'          => trim(ucwords(strtolower($data['nama']))),
            'tanggal_lahir' => $data['tanggal_lahir'],
            'warna_tanda'   => $data['warna_tanda'] ?? null,
            'jenis_kelamin' => $data['jenis_kelamin'],
        ]);
    }

    protected function getNextIdPet()
    {
        $maxId = Pet::max('idpet');
        return $maxId ? $maxId + 1 : 1;
    }
}