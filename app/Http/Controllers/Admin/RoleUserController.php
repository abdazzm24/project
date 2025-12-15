<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RoleUser;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class RoleUserController extends Controller
{
    public function index()
    {
        $roleuser = RoleUser::with(['user','role'])->get();
        return view('admin.roleuser.index', compact('roleuser'));
    }

    public function create()
    {
        return view('admin.roleuser.create', [
            'users' => User::all(),
            'roles' => Role::all()
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validateCreate($request);

        // 1. create user
        $user = User::create([
            'nama'     => $data['nama'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password'])
        ]);

        // 2. insert ke role_user
        RoleUser::create([
            'iduser' => $user->iduser,
            'idrole' => $data['idrole']
        ]);

        return redirect()->route('admin.roleuser.index')
            ->with('success', 'User baru & role berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $roleuser = RoleUser::findOrFail($id);
        $roles = Role::all();

        return view('admin.roleuser.edit', [
            'roleuser' => $roleuser,
            'roles'    => $roles
        ]);
    }

    public function update(Request $request, $id)
    {
        $ru = RoleUser::findOrFail($id);
        $user = $ru->user;

        $data = $this->validateUpdate($request, $user->iduser);

        // UPDATE user
        $user->nama  = $data['nama'];
        $user->email = $data['email'];

        if (!empty($data['password'])) {
            $user->password = Hash::make($data['password']);
        }

        $user->save();

        // UPDATE role_user
        $ru->update([
            'idrole' => $data['idrole']
        ]);

        return redirect()->route('admin.roleuser.index')
            ->with('success', 'User & role berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $ru = RoleUser::findOrFail($id);
        $ru->delete();

        return redirect()->route('admin.roleuser.index')
            ->with('success', 'Role User berhasil dihapus.');
    }

    /* ============================
       VALIDATION
    ============================= */
    private function validateCreate(Request $request)
    {
        return $request->validate([
            'nama'     => 'required|string|max:100',
            'email'    => 'required|email|unique:user,email',
            'idrole'   => 'required|exists:role,idrole',
            'password' => 'required|min:1|confirmed'
        ]);
    }

    private function validateUpdate(Request $request, $id)
    {
        return $request->validate([
            'nama'   => 'required|string|max:100',
            'email'  => [
                'required',
                'email',
                Rule::unique('user', 'email')->ignore($id, 'iduser')
            ],
            'idrole' => 'required|exists:role,idrole',
            'password' => 'nullable|min:1|confirmed'
        ]);
    }

}
