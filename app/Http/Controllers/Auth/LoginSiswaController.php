<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Foundation\Auth\AuthenticatesSiswas;

class LoginSiswaController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesSiswas;

    // public function showLoginForm()
    // {
    //     return view('auth.login-siswa');
    // }

    // public function loginSiswa(Request $request)
    // {
    //     $nisn = $request->input('nisn');
    //     $password = $request->input('password');

    //     //dd($password);
        
    //     if (Auth::guard('login_siswa')->attempt(['nisn' => $nisn, 'password' => $password])) {
    //         // Autentikasi berhasil
    //         return response()->json(['status' => 'success', 'message' => 'Login successful.']);
    //     } else {
    //         // Autentikasi gagal
    //         return response()->json(['status' => 'error', 'message' => 'Invalid login credentials.']);
    //     }
    // }





    // public function loginSiswa(Request $request)
    // {

    //     $request->validate([
    //         'nisn' => 'required|string',
    //         'nis' => 'required|string',
    //     ]);

    //     $request->session()->regenerate();

    //     $this->clearLoginAttempts($request);
        
    //     $cek = $request->only('nisn', 'nis');

    //     if (Auth::attempt($cek)) {
    //         // Jika autentikasi berhasil, arahkan ke halaman dashboard
    //         return redirect()->intended()->route('home');
    //     } else {
    //         // Jika autentikasi gagal, arahkan kembali ke halaman login dengan pesan error
    //         return redirect()->route('loginSiswa')->with('error', 'NISN atau NIS salah.');
    //     }
    // }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}