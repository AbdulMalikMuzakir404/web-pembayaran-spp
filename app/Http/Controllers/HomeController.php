<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\pembayaran;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // January
        $january = pembayaran::where('bln_dibayar', 'january')->where('thn_dibayar', date('Y'))->sum('jumlah_bayar');

        // february
        $february = pembayaran::where('bln_dibayar', 'february')->where('thn_dibayar', date('Y'))->sum('jumlah_bayar');

        // maret
        $maret = pembayaran::where('bln_dibayar', 'maret')->where('thn_dibayar', date('Y'))->sum('jumlah_bayar');

        // april
        $april = pembayaran::where('bln_dibayar', 'april')->where('thn_dibayar', date('Y'))->sum('jumlah_bayar');

        // mei
        $mei = pembayaran::where('bln_dibayar', 'mei')->where('thn_dibayar', date('Y'))->sum('jumlah_bayar');

        // juni
        $juni = pembayaran::where('bln_dibayar', 'juni')->where('thn_dibayar', date('Y'))->sum('jumlah_bayar');

        // juli
        $juli = pembayaran::where('bln_dibayar', 'juli')->where('thn_dibayar', date('Y'))->sum('jumlah_bayar');

        // agustus
        $agustus = pembayaran::where('bln_dibayar', 'agustus')->where('thn_dibayar', date('Y'))->sum('jumlah_bayar');

        // september
        $september = pembayaran::where('bln_dibayar', 'september')->where('thn_dibayar', date('Y'))->sum('jumlah_bayar');

        // oktober
        $oktober = pembayaran::where('bln_dibayar', 'oktober')->where('thn_dibayar', date('Y'))->sum('jumlah_bayar');

        // november
        $november = pembayaran::where('bln_dibayar', 'november')->where('thn_dibayar', date('Y'))->sum('jumlah_bayar');

        // desember
        $desember = pembayaran::where('bln_dibayar', 'desember')->where('thn_dibayar', date('Y'))->sum('jumlah_bayar');

        $income = pembayaran::sum('jumlah_bayar');

        $siswa = User::where('level', 'siswa')->get();
        $jumlah_siswa = count($siswa);

        $lunas = pembayaran::where('status_pembayaran', 1)->get();
        $hitung_lunas = count($lunas);

        $belumLunas = pembayaran::where('status_pembayaran', 0)->get();
        $hitung_belum_lunas = count($belumLunas);

        return view('home', compact(
            'january',
            'february',
            'maret',
            'april',
            'mei',
            'juni',
            'juli',
            'agustus',
            'september',
            'oktober',
            'november',
            'desember',

            'income',
            'jumlah_siswa',
            'hitung_lunas',
            'hitung_belum_lunas',
        ));
    }
}