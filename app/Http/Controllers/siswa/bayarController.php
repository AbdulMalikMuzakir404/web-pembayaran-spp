<?php

namespace App\Http\Controllers\siswa;

use App\Models\spp;
use App\Models\User;
use App\Models\pembayaran;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class bayarController extends Controller
{
    public function showBayar()
    {
        $spp = spp::whereYear('tahun', date('Y'))->get();
        return view('siswa.siswa-bayar', compact(
            'spp',
        ));
    }

    public function bayarDetail($id)
    {
        $data = spp::where('id', $id)->get();

        $gross_amount = spp::where('id', $id)->get()->toArray();
        foreach($gross_amount as $amount){
            $data_amount = $amount;
        }

        $date_exp = explode("-", $data_amount['tahun']);

        switch ($date_exp[1]) {
            case 1:
                $bln = 'January';
                break;
            case 2:
                $bln = 'February';
                break;
            case 3:
                $bln = 'Maret';
                break;
            case 4:
                $bln = 'April';
                break;
            case 5:
                $bln = 'Mei';
                break;
            case 6:
                $bln = 'Juni';
                break;
            case 7:
                $bln = 'Juli';
                break;
            case 8:
                $bln = 'Agustus';
                break;
            case 9:
                $bln = 'Desember';
                break;
            case 10:
                $bln = 'Oktober';
                break;
            case 11:
                $bln = 'November';
                break;
            case 12:
                $bln = 'Desember';
                break;
        }

        $cekDatePembayaran = pembayaran::where('nisn', auth()->user()->nisn)->where('bln_dibayar', $bln)->where('thn_dibayar', $date_exp[0])->get();
        if(count($cekDatePembayaran) >= 1) {
            return redirect()->back()->with('error', 'there was an error in the month of payment and the year of payment!');
        }

        $cek = spp::whereMonth('tahun', date('F'))->whereYear('tahun', date('Y'))->get('nominal');

        foreach($cek as $data) {
            if(intval($data_amount['nominal']) > intval($data['nominal'])) {
                return redirect()->back()->with('error', 'failed to updated data!');
            }
        }

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => intval($data_amount['nominal']),
            ),
            'customer_details' => array(
                'phone' => auth()->user()->nisn,
                'first_name' => auth()->user()->name,
                'tgl_dibayar' => date('d'),
                'bln_dibayar' => date('F'),
                'thn_dibayar' => date('Y'),
                'jumlah_bayar' => intval($data_amount['nominal']),
                'spp_id' => $id,
                'nama_pengelola' => auth()->user()->name,
                'status_pembayaran' => 0
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        pembayaran::create([
            'nisn' => auth()->user()->nisn,
            'nama_siswa' => auth()->user()->name,
            'tgl_dibayar' => date('d'),
            'bln_dibayar' => date('F'),
            'thn_dibayar' => date('Y'),
            'jumlah_bayar' => intval($data_amount['nominal']),
            'spp_id' => $id,
            'nama_pengelola' => auth()->user()->name,
            'status_pembayaran' => 0
        ]);

        $total_bayar = User::where('nisn', auth()->user()->nisn)->get('total_bayar');
        foreach($total_bayar as $bayar) {
                $totalBayarUpdate = intval($bayar['total_bayar']) - intval($data_amount['nominal']);
        }

        User::where('nisn', auth()->user()->nisn)->update([
            'total_bayar' => $totalBayarUpdate
        ]);

        return view('siswa.detail-bayar', compact(
            'data',
            'snapToken'
        ));
    }
}