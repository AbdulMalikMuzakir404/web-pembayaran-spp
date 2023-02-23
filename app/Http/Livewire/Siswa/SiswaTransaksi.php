<?php

namespace App\Http\Livewire\Siswa;

use App\Models\spp;
use App\Models\User;
use Livewire\Component;
use App\Models\pembayaran;

class SiswaTransaksi extends Component
{
    public $snapToken, $nisn, $name, $tgl_dibayar, $bln_dibayar, $thn_dibayar, $jumlah_bayar, $spp_id, $bln;
    public $isLoading = false;

    public function render()
    {
        return view('livewire.siswa.siswa-transaksi', [
            'as' => $this->snapToken,
            'dataSpp' => spp::get(),
        ]);
    }

    public function submit()
    {
        $this->isLoading = true;

        // Proses loading dilakukan disini
        sleep(2); // sleep 2 detik untuk simulasi loading

        $this->isLoading = false;
    }

    public function makeDataTransaksiSiswa()
    {
        //dd($this->snapToken);
        // $this->validate([
        //     'jumlah_bayar' => 'required|min:5|max:40|string',
        //     'spp_id' => 'required'
        // ]);

        // $cekDatePembayaran = pembayaran::where('nama_siswa', auth()->user()->name)->where('bln_dibayar', date('M'))->where('thn_dibayar', date('Y'))->get();
        // if(count($cekDatePembayaran) >= 1) {
        //     return redirect()->route('dataTransaksi')->with('error', 'there was an error in the month of payment and the year of payment!');
        // }

        // switch ($this->bln_dibayar) {
        //     case 'January':
        //         $this->bln = 1;
        //         break;
        //     case 'February':
        //         $this->bln = 2;
        //         break;
        //     case 'Maret':
        //         $this->bln = 3;
        //         break;
        //     case 'April':
        //         $this->bln = 4;
        //         break;
        //     case 'Mei':
        //         $this->bln = 5;
        //         break;
        //     case 'Juni':
        //         $this->bln = 6;
        //         break;
        //     case 'Juli':
        //         $this->bln = 7;
        //         break;
        //     case 'Agustus':
        //         $this->bln = 8;
        //         break;
        //     case 'Desember':
        //         $this->bln = 9;
        //         break;
        //     case 'Oktober':
        //         $this->bln = 10;
        //         break;
        //     case 'November':
        //         $this->bln = 11;
        //         break;
        //     case 'Desember':
        //         $this->bln = 12;
        //         break;
        // }

        // $cek = spp::whereMonth('tahun', $this->bln)->whereYear('tahun', date('Y'))->get('nominal');

        // foreach($cek as $data) {
        //     if(intval($this->jumlah_bayar) > intval($data['nominal'])) {
        //         $this->clearDataCreateTransaksi();
        //         return redirect()->route('dataTransaksi')->with('error', 'failed to updated data!');
        //     }
        // }

        // $transaksi = pembayaran::create([
        //     'nisn' => auth()->user()->nisn,
        //     'nama_siswa' => auth()->user()->name,
        //     'tgl_dibayar' => date('d'),
        //     'bln_dibayar' => date('F'),
        //     'thn_dibayar' => date('Y'),
        //     'jumlah_bayar' => $this->jumlah_bayar,
        //     'spp_id' => $this->spp_id,
        //     'nama_pengelola' => auth()->user()->name,
        //     'status_pembayaran' => 0
        // ]);

        // $total_bayar = User::where('nisn', $this->nisn)->get('total_bayar');
        // foreach($total_bayar as $bayar) {
        //         $totalBayarUpdate = intval($bayar['total_bayar']) - intval($this->jumlah_bayar);
        // }

        // User::where('nisn', $this->nisn)->update([
        //     'total_bayar' => $totalBayarUpdate
        // ]);

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
                'gross_amount' => 100000,
            ),
            'customer_details' => array(
                'nisn' => $this->nisn,
                'nama_siswa' => $this->name,
                'tgl_dibayar' => $this->tgl_dibayar,
                'bln_dibayar' => $this->bln_dibayar,
                'thn_dibayar' => $this->thn_dibayar,
                'jumlah_bayar' => $this->jumlah_bayar,
                'spp_id' => $this->spp_id,
                'nama_pengelola' => auth()->user()->name,
                'status_pembayaran' => 0
            ),
        );

        $this->snapToken = \Midtrans\Snap::getSnapToken($params);

        // return redirect()->route('dataTransaksi')->with('success', 'transaction data successfully added');
        // $this->clearDataCreateTransaksi();
        // $this->emit('success-create-data-transaksi');
    }
}