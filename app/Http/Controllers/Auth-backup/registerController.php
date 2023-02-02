<?php

namespace App\Http\Controllers\Auth;

use App\Models\staf;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class registerController extends Controller
{
    public function registerForm()
    {
        return view('auth.register');
    }

    public function registerAction(Request $request)
    {
        request()->validate([
            'nama' => 'required|min:5|max:50',
            'email' => 'required|min:8|max:70|unique:stafs,email',
            'username' => 'required|min:5|max:30',
            'password' => 'required|min:5|max:50',
        ]);

        staf::create([
            'nama_petugas'=> $request->nama,
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'level' => 'admin',
            'active' => 1
        ]);

        return redirect()->route('home');
    }
}
