<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\RoleUser;

class RoleUserController extends Controller
{
    public function index()
    {
        $roleuser = RoleUser::with(['role', 'user'])->get();
        return view('admin.roleuser.index', compact('roleuser'));
    }
}
