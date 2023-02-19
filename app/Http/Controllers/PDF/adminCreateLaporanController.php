<?php

namespace App\Http\Controllers\PDF;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class adminCreateLaporanController extends Controller
{
    public function createTransaksiLaporan()
    {
        return view('PDF.admin-create-laporan');
    }
}