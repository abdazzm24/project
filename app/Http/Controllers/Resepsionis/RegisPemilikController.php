<?php

namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


use App\Models\Pemilik;
use App\Models\User;
use App\Models\RoleUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Exception;
use Illuminate\Validation\ValidationException;

class RegisPemilikController extends Controller
{
    public function index()
    {
        $pemilik = Pemilik::with('user')->get();
        return view('resepsionis.regispemilik.index', compact('pemilik'));
    }

    public function create()
    {
        return view('resepsionis.regispemilik.create');
    }

    public function store(Request $request)
    {
        Log::info('STORE PEMILIK: Request masuk', $request->all());

        DB::beginTransaction();

        try {
            // Validasi akan throw ValidationException jika gagal
            $validatedData = $this->validatePemilik($request);
            Log::info('STORE PEMILIK: Validasi berhasil', $validatedData);

            $this->createPemilikAndUser($validatedData);

            DB::commit();
            Log::info('STORE PEMILIK: Semua proses berhasil');

            return redirect()->route('resepsionis.regispemilik.index')
                ->with('success', 'Data Pemilik dan Akun User berhasil ditambahkan.');

        } catch (ValidationException $e) {
            // Biarkan Laravel tangani redirect + errors bag
            DB::rollBack();
            throw $e; // Penting! Jangan tangkap, lempar lagi

        } catch (Exception $e) {
            DB::rollBack();

            Log::error('STORE PEMILIK: GAGAL TOTAL', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan sistem: Gagal menyimpan data.');
        }
    }


    public function edit($idpemilik)
    {
        $pemilik = Pemilik::with('user')->findOrFail($idpemilik);
        return view('resepsionis.regispemilik.edit', compact('pemilik'));
    }
    
    public function update(Request $request, $idpemilik)
    {
        try {
            $validatedData = $this->validatePemilik($request, $idpemilik); 
            
            $this->updatePemilikAndUser($idpemilik, $validatedData);

            return redirect()->route('resepsionis.regispemilik.index')
                ->with('success', 'Data Pemilik dan Akun User berhasil diperbarui.');

        } catch (Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }

    public function destroy($idpemilik)
    {
        try {
            $pemilik = Pemilik::findOrFail($idpemilik);
            $user_id = $pemilik->iduser;
            
            // Hapus record Pemilik
            $pemilik->delete();
            
            // Hapus User yang terkait
            if ($user_id) {
                // Hapus User dan otomatis detach Role
                User::findOrFail($user_id)->roles()->detach(); 
                User::destroy($user_id); 
            }
            
            return redirect()->route('resepsionis.regispemilik.index')
                ->with('success', 'Data Pemilik dan User terkait berhasil dihapus.');
        } catch (Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }

    // ========== VALIDATION ==========
    protected function validatePemilik(Request $request, $id = null)
    {
        $pemilik = $id ? Pemilik::find($id) : null;
        $userId = $pemilik ? $pemilik->iduser : null;
        
        $rules = [
            'nama' => ['required', 'string', 'max:255'],
            
            'no_wa' => [
                'required', 
                'string',
                'max:15',
                Rule::unique('pemilik', 'no_wa')->ignore($id, 'idpemilik')
            ],
            
            'alamat' => ['required', 'string'],
            
            'email' => [
                'required', 
                'string', 
                'email', 
                'max:255',
                // PENTING: Gunakan tabel 'user' dan PK 'iduser'
                Rule::unique('user', 'email')->ignore($userId, 'iduser') 
            ],

            'password' => [
                $id ? 'nullable' : 'required', 
                'string', 
                'min:1', 
            ],
        ];

        return $request->validate($rules, [
            'nama.required' => 'Nama pemilik wajib diisi.', 
            'email.required' => 'Email wajib diisi.',
            'email.unique' => 'Email ini sudah terdaftar.',
            'password.required' => 'Password wajib diisi untuk User baru.',
            'no_wa.required' => 'Nomor WhatsApp wajib diisi.', 
            'no_wa.unique' => 'Nomor WhatsApp ini sudah terdaftar.',
            'alamat.required' => 'Alamat wajib diisi.',
        ]);
    }
    
    // ----------- HELPER MANUAL AUTO-INCREMENT -----------
    
    /**
     * Menghitung ID Pemilik berikutnya secara manual dari database.
     */
    protected function getNextIdPemilik()
    {
        $maxId = Pemilik::max('idpemilik');
        return $maxId ? $maxId + 1 : 1;
    }
    
    // ----------- HELPER CREATE USER & PEMILIK -----------
    
    protected function createPemilikAndUser(array $data) 
{
    Log::info('PROSES CREATE PEMILIK DIMULAI', $data);

    try {
        // 1. BUAT USER
        $user = User::create([
            'nama'     => $this->formatNama($data['nama']),
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        Log::info('USER BERHASIL DIBUAT', ['iduser' => $user->iduser]);

        // 2. ATTACH ROLE PEMILIK (ID 5)
        // $user->roles()->attach(5, ['status' => 1]);
        RoleUser::create([
            'iduser' => $user->iduser,
            'idrole' => 5,
            'status' => 1,
        ]);
        Log::info('ROLE PEMILIK BERHASIL DI-ATTACH');

        // 3. GENERATE ID PEMILIK MANUAL
        $nextIdPemilik = $this->getNextIdPemilik();
        Log::info('NEXT ID PEMILIK', ['idpemilik' => $nextIdPemilik]);

        // 4. SIMPAN PEMILIK
        $pemilik = Pemilik::create([
            'idpemilik' => $nextIdPemilik,
            'no_wa'     => trim($data['no_wa']),
            'alamat'    => trim($data['alamat']),
            'iduser'    => $user->iduser,
        ]);

        Log::info('PEMILIK BERHASIL DIBUAT', ['idpemilik' => $pemilik->idpemilik]);

        return $pemilik;

    } catch (Exception $e) {
        Log::error('GAGAL CREATE PEMILIK', [
            'error' => $e->getMessage(),
        ]);

        throw new Exception('Gagal menyimpan data Pemilik: ' . $e->getMessage());
    }
}


    // ----------- HELPER UPDATE USER & PEMILIK -----------
    
    protected function updatePemilikAndUser($idpemilik, array $data) 
    {
        try {
            $pemilik = Pemilik::with('user')->findOrFail($idpemilik);
            
            // 1. UPDATE USER TERKAIT
            if ($pemilik->user) {
                $updateUserData = [
                    'nama' => trim(ucwords(strtolower($data['nama']))), 
                    'email' => $data['email'],
                ];
                
                // Hanya update password jika diisi
                if (!empty($data['password'])) {
                    $updateUserData['password'] = Hash::make($data['password']);
                }
                
                $pemilik->user->update($updateUserData);
            }

            // 2. UPDATE RECORD PEMILIK
            return $pemilik->update([
                'no_wa' => trim($data['no_wa']), 
                'alamat' => trim($data['alamat']),
            ]);

        } catch (Exception $e) { 
            throw new Exception('Gagal memperbarui data Pemilik: ' . $e->getMessage()); 
        }
    }

    protected function formatNama($nama) 
    {
        return trim(ucwords(strtolower($nama))); 
    }
}