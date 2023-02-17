<?php

namespace App\Http\Controllers\transaksi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class transaksiController extends Controller
{
    public function showDataTransaksi()
    {
        return view('transaksi.transaksi');
    }
}