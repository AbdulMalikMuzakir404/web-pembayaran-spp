<?php

namespace App\Http\Livewire\Transaksi;

use App\Models\spp;
use App\Models\User;
use Livewire\Component;
use App\Models\pembayaran;

class UpdateTransaksi extends Component
{
    public $nisn, $tgl_dibayar, $bln_dibayar, $thn_dibayar, $jumlah_bayar, $jumlah_bayar_update, $spp_id, $transaksiId, $bln;

    protected $listeners = [
        'passing-update-data-transaksi' => 'showDataTransaksi',
    ];

    public function render()
    {
        return view('livewire.transaksi.update-transaksi', [
            'datas' => User::where('level', 'siswa')->get(),
            'dataSpp' => spp::get(),
        ]);
    }

    public function addTransaksi()
    {
        $this->emit('add-data-transaksi');
    }

    public function showDataTransaksi($datas)
    {
        foreach($datas as $transaksi)
        {
            $this->transaksiId = $transaksi['id'];
            $this->nisn = $transaksi['nisn'];
            $this->tgl_dibayar = $transaksi['tgl_dibayar'];
            $this->bln_dibayar = $transaksi['bln_dibayar'];
            $this->thn_dibayar = $transaksi['thn_dibayar'];
            $this->jumlah_bayar = $transaksi['jumlah_bayar'];
            $this->spp_id = $transaksi['spp_id'];
        }
    }

    public function updateDataTransaksi()
    {
        $this->validate([
            'nisn' => 'required|min:5|max:13|string',
            'tgl_dibayar' => 'required|max:3|string',
            'bln_dibayar' => 'required|max:15|string',
            'thn_dibayar' => 'required|max:5|string',
            'jumlah_bayar_update' => 'required|min:3|max:40|string',
            'spp_id' => 'required',
        ]);

        switch ($this->bln_dibayar) {
            case 'January':
                $this->bln = 1;
                break;
            case 'February':
                $this->bln = 2;
                break;
            case 'Maret':
                $this->bln = 3;
                break;
            case 'April':
                $this->bln = 4;
                break;
            case 'Mei':
                $this->bln = 5;
                break;
            case 'Juni':
                $this->bln = 6;
                break;
            case 'Juli':
                $this->bln = 7;
                break;
            case 'Agustus':
                $this->bln = 8;
                break;
            case 'Desember':
                $this->bln = 9;
                break;
            case 'Oktober':
                $this->bln = 10;
                break;
            case 'November':
                $this->bln = 11;
                break;
            case 'Desember':
                $this->bln = 12;
                break;
        }

        $cek = spp::whereMonth('tahun', $this->bln)->whereYear('tahun', $this->thn_dibayar)->get('nominal');
        
        foreach($cek as $data) {
            if(intval($this->jumlah_bayar + $this->jumlah_bayar_update) > intval($data['nominal'])) {
                $this->clearDataUpdateTransaksi();
                return redirect()->route('dataTransaksi')->with('error', 'failed to updated data!');
            }
        }

        $nama_pengelola = Auth()->user()->name;
        
        pembayaran::find($this->transaksiId)->update([
            'nisn' => $this->nisn,
            'spp_id' => $this->spp_id,
            'tgl_dibayar' => $this->tgl_dibayar,
            'bln_dibayar' => $this->bln_dibayar,
            'thn_dibayar' => $this->thn_dibayar,
            'jumlah_bayar' => intval($this->jumlah_bayar) + intval($this->jumlah_bayar_update),
            'nama_pengelola' => $nama_pengelola,
        ]);

        $total_bayar = User::where('nisn', $this->nisn)->get('total_bayar');
        foreach($total_bayar as $bayar) {
                $totalBayarUpdate = intval($bayar['total_bayar']) - intval($this->jumlah_bayar_update);
        }
        
        User::where('nisn', $this->nisn)->update([
            'total_bayar' => $totalBayarUpdate
        ]);

        $this->clearDataUpdateTransaksi();
        $this->emit('success-update-data-transaksi');
    }

    private function clearDataUpdateTransaksi()
    {
        $this->nisn = null;
        $this->tgl_dibayar = null;
        $this->bln_dibayar = null;
        $this->thn_dibayar = null;
        $this->jumlah_bayar = null;
        $this->transaksiId = null;
    }
}