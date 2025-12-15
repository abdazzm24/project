<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Role;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:3',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::with(['roleUser' => function ($query) {
            $query->where('status', '1');
        }, 'roleUser.role'])
        ->where('email', $request->input('email'))->first();

        if (!$user) {
            return redirect()->back()
                ->withErrors(['email' => 'Email tidak ditemukan.'])
                ->withInput();
        }

        // cek password
        if (!\Hash::check($request->password, $user->password)) {
            return redirect()->back()
                ->withErrors(['password' => 'Password salah.'])
                ->withInput();
        }

        // Ambil role
        $currentRole = $user->roleUser[0] ?? null;
        $roleData = Role::where('idrole', $currentRole->idrole ?? null)->first();

        // login user ke session
        Auth::login($user);

        //simpan session user
        $request->session()->put([
            'user_id' => $user->iduser,
            'user_name' => $user->nama,
            'user_email' => $user->email,
            'user_role' => $currentRole->nama_role ?? 'user',
            'user_role_name' => $roleData->name_role ?? 'User',
            'user_status' => $currentRole->status ?? '1',
        ]);

        //redirect sesuai role
        $roleName = strtolower($roleData->nama_role ?? '');

        switch ($roleName) {
            case 'administrator':
                return redirect()->intended('/admin/dashboard')->with('success', 'Login berhasil!');
            case 'dokter':
                return redirect()->intended('/dokter/dashboard')->with('success', 'Login berhasil!');
            case 'perawat':
                return redirect()->intended('/perawat/dashboard')->with('success', 'Login berhasil!');
            case 'resepsionis':
                return redirect()->intended('/resepsionis/dashboard')->with('success', 'Login berhasil!');
            case 'pemilik':
                return redirect()->intended('/pemilik/dashboard')->with('success', 'Login berhasil!');
            default:
                return redirect('/')->with('error', 'Role tidak dikenali.');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Logout berhasil!');
    }

}
