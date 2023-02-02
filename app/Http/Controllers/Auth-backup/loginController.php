<?php

namespace App\Http\Controllers\Auth;

use App\Models\staf;
use App\Models\siswa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class loginController extends Controller
{
    public function loginForm()
    {
        return view('auth.login');
    }

    public function loginAction(Request $request)
    {
        request()->validate([
            'username' => 'required|min:5|max:30',
            'password' => 'required|min:5|max:50',
        ]);

        $data = staf::where("username", "=", $request->username)->first();

        if(!$data) {
            return back()->with('error', 'data yang anda masukan salah');
        } else {
            if(Hash::check($request->password, $data->password)) {
                $data = $request->input();
                $request->session()->put('user', $data['username']);
                return redirect()->route('home');
            } else {
                return back()->with('error', 'Password yang anda masukan salah');
            }
        }
        return redirect()->route('login')->with('error', 'Email atau Password salah!');
    }

}
