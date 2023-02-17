<?php

namespace App\Http\Livewire\Transaksi;

use App\Models\spp;
use App\Models\User;
use Livewire\Component;
use App\Models\pembayaran;
use Livewire\WithPagination;

class DataTransaksi extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $paginate = 5;
    public $search;
    protected $queryString = ['search'];

    public $status_transaksi = false;

    public $status_pembayaran = null;

    public $nisn, $tgl_dibayar, $bln_dibayar, $thn_dibayar, $jumlah_bayar, $spp_id;

    protected $listeners = [
        'success-create-data-transaksi' => 'handleCreateDataTransaksi',
        'success-update-data-transaksi' => 'handleUpdateDataTransaksi',
        'success-delete-data-transaksi'=> 'handleDeleteDataTransaksi',
        'success-update-status-pembayaran' => 'handleUpdateStatusPembayaran',
        'success-delete-transaksi' => 'handleDeleteTransaksi',
        'add-data-transaksi' => 'handleAddTransaksi'
    ];

    public function render()
    {
        return view('livewire.transaksi.data-transaksi', [
            'datas' => User::where('level', 'siswa')->get(),
            'dataSpp' => spp::get(),
            'transaksi' => $this->search == null ? pembayaran::join('spps', 'pembayarans.spp_id', 'spps.id')
            ->join('users', 'pembayarans.nisn', 'users.nisn')
            ->paginate($this->paginate) :
            pembayaran::join('spps', 'pembayarans.spp_id', 'spps.id')
            ->join('users', 'pembayarans.nisn', 'users.nisn')
            ->where('name', 'like', '%' . $this->search . '%')
            ->where('status_pembayaran', $this->status_pembayaran)
            ->paginate($this->paginate),
        ]);
    }

    public function handleAddTransaksi()
    {
        $this->status_transaksi = false;
    }

    public function handleCreateDataTransaksi()
    {
        //
    }
    public function handleUpdateDataTransaksi()
    {
        //
    }

    public function handleDeleteDataTransaksi()
    {
        //
    }

    public function handleUpdateStatusPembayaran()
    {
        //
    }

    public function handleDeleteTransaksi()
    {
        //
    }

    public function makeDataTransaksi()
    {
        $this->validate([
            'nisn' => 'required|min:5|max:13',
            'tgl_dibayar' => 'required|max:15',
            'bln_dibayar' => 'required|max:15',
            'thn_dibayar' => 'required|max:5',
            'jumlah_bayar' => 'required|min:5|max:40|string',
            'spp_id' => 'required'
        ]);

        $id = Auth()->user()->id;

        pembayaran::create([
            'nisn' => $this->nisn,
            'tgl_dibayar' => $this->tgl_dibayar,
            'bln_dibayar' => $this->bln_dibayar,
            'thn_dibayar' => $this->thn_dibayar,
            'jumlah_bayar' => $this->jumlah_bayar,
            'spp_id' => $this->spp_id,
            'user_id' => $id,
            'status_pembayaran' => 0
        ]);

        $this->clearDataCreateTransaksi();
        $this->emit('success-create-data-transaksi');
    }

    private function clearDataCreateTransaksi()
    {
        $this->nisn = null;
        $this->spp_id = null;
        $this->tgl_dibayar = null;
        $this->bln_dibayar = null;
        $this->thn_dibayar = null;
        $this->jumlah_bayar = null;
    }

    public function updateStatus($data)
    {
        $exp = explode("-",$data);
        $nisn = $exp[0];
        $tgl = $exp[1];
        $bln = $exp[2];
        $thn = $exp[3];
        $data = User::where('level', 'siswa')->join('pembayarans', 'pembayarans.nisn', 'users.nisn')->where('users.nisn', $nisn)->where('tgl_dibayar', $tgl)->where('bln_dibayar', $bln)->where('thn_dibayar', $thn);
        $data->update([
            'status_pembayaran' => 1
        ]);

        $this->emit('success-update-status-pembayaran');
    }

    public function getIdTransaksi($data)
    {
        $this->status_transaksi = true;

        $exp = explode("-",$data);
        $nisn = $exp[0];
        $tgl = $exp[1];
        $bln = $exp[2];
        $thn = $exp[3];
        $datas = User::where('level', 'siswa')->join('pembayarans', 'pembayarans.nisn', 'users.nisn')->where('users.nisn', $nisn)->where('tgl_dibayar', $tgl)->where('bln_dibayar', $bln)->where('thn_dibayar', $thn)->get();

        $this->emit('passing-update-data-transaksi', $datas);
    }

    public function deleteTransaksi($data)
    {
        $exp = explode("-",$data);
        $tgl = $exp[0];
        $bln = $exp[1];
        $thn = $exp[2];
        $data = pembayaran::where('tgl_dibayar', $tgl)->where('bln_dibayar', $bln)->where('thn_dibayar', $thn);
        $data->delete();

        $this->emit('success-delete-transaksi');
    }
}