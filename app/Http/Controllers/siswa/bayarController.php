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

        $countBayar = pembayaran::where('nisn', auth()->user()->nisn)->where('bln_dibayar', $bln)->where('thn_dibayar', $date_exp[0])->where('midtrans_status', 'pending')->get();
        $countB = count($countBayar);
        if($countB >= 1) {
            pembayaran::where('nisn', auth()->user()->nisn)->where('bln_dibayar', $bln)->where('thn_dibayar', $date_exp[0])->where('midtrans_status', 'pending')->delete();
        }

        $cekDatePembayaran = pembayaran::where('nisn', auth()->user()->nisn)->where('bln_dibayar', $bln)->where('thn_dibayar', $date_exp[0])->where('midtrans_status', 'success')->get();

        if(count($cekDatePembayaran) >= 1) {
            return redirect()->back()->with('error', 'there was an error in the month of payment and the year of payment!');
        }

        $cek = spp::whereMonth('tahun', date('F'))->whereYear('tahun', date('Y'))->get('nominal');

        foreach($cek as $data) {
            if(intval($data_amount['nominal']) > intval($data['nominal'])) {
                return redirect()->back()->with('error', 'failed to updated data!');
            }
        }

        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $random_string = '';
        $length = 20;

        for ($i = 0; $i < $length; $i++) {
            $random_string .= $characters[rand(0, strlen($characters) - 1)];
        }

        $pembayaran = pembayaran::create([
            'kode_transaction' => $random_string,
            'nisn' => auth()->user()->nisn,
            'nama_siswa' => auth()->user()->name,
            'tgl_dibayar' => date('d'),
            'bln_dibayar' => date('F'),
            'thn_dibayar' => date('Y'),
            'jumlah_bayar' => '0',
            'spp_id' => $id,
            'nama_pengelola' => 'NULL',
            'status_pembayaran' => 0,
            'midtrans_status' => 'pending'
        ]);

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
                'order_id' => $pembayaran->kode_transaction,
                'gross_amount' => intval($data_amount['nominal'])
            ),
            'customer_details' => array(
                'phone' => auth()->user()->phone,
                'first_name' => auth()->user()->name,
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        return view('siswa.detail-bayar', compact(
            'data',
            'snapToken'
        ));
    }

    public function callback(Request $request)
    {
        $serverKey = config('midtrans.server_key');
        $hashed = hash("sha512", $request->order_id.$request->status_code.$request->gross_amount.$serverKey);
        if($hashed == $request->signature_key) {
            if($request->transaction_status == 'settlement' || $request->transaction_status == 'capture') {
                $exp_amount = explode(".", $request->gross_amount);
                $trans = pembayaran::where('kode_transaction', $request->order_id);
                $trans->update([
                    'midtrans_status' => 'success',
                    'jumlah_bayar' => $exp_amount[0]
                ]);

                $total_bayar = pembayaran::join('users', 'pembayarans.nisn', 'users.nisn')->where('kode_transaction', $request->order_id)->get('total_bayar');
                foreach($total_bayar as $bayar) {
                    $totalBayarUpdate = intval($bayar['total_bayar']) - intval($exp_amount[0]);
                }

                pembayaran::join('users', 'pembayarans.nisn', 'users.nisn')->where('kode_transaction', $request->order_id)->update([
                    'total_bayar' => $totalBayarUpdate
                ]);
            } elseif($request->transaction_status == 'pending') {
                $trans = pembayaran::where('kode_transaction', $request->order_id);
                $trans->update([
                    'midtrans_status' => 'pending'
                ]);
            }

       }
    }
}