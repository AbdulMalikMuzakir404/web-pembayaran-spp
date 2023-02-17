<?php

namespace App\Http\Livewire\Transaksi;

use App\Models\spp;
use App\Models\User;
use Livewire\Component;
use App\Models\pembayaran;

class UpdateTransaksi extends Component
{
    public $nisn, $tgl_dibayar, $bln_dibayar, $thn_dibayar, $jumlah_bayar, $spp_id, $transaksiId;

    protected $listeners = [
        'passing-update-data-transaksi' => 'showDataTransaksi'
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
            'jumlah_bayar' => 'required|min:3|max:40|string',
            'spp_id' => 'required',
        ]);

        pembayaran::find($this->transaksiId)->update([
            'nisn' => $this->nisn,
            'spp_id' => $this->spp_id,
            'tgl_dibayar' => $this->tgl_dibayar,
            'bln_dibayar' => $this->bln_dibayar,
            'thn_dibayar' => $this->thn_dibayar,
            'jumlah_bayar' => $this->jumlah_bayar
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