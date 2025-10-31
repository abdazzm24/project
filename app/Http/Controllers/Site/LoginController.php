<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
            'password' => 'required|min:6',
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

        $namarole = Role::where('idrole', $user->roleUser[0]->idrole ?? null)->first();

        // login user ke session
        Auth::login($user);

        //simpan session user
        $request->session()->put([
            'user_id' => $user->iduser,
            'user_name' => $user->nama,
            'user_email' => $user->email,
            'user_role' => $user->roleUser[0]->nama_role ?? 'user',
            'user_role_name' => $namarole->name_role ?? 'User',
            'user_status' => $user->roleUser[0]->status ?? '1',
        ]);

        return redirect()->intended('/home')->with('success', 'Login berhasil!');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Logout berhasil!');
    }

}
