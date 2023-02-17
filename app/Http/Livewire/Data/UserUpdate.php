<?php

namespace App\Http\Livewire\Data;

use App\Models\spp;
use App\Models\ruang;
use App\Models\User;
use Livewire\Component;

class UserUpdate extends Component
{
    public $email, $nisn, $nis, $name, $no_telp, $alamat, $spp_id, $ruang_id, $tahun, $nominal, $nama_kelas, $kopetensi_keahlian, $siswaId;

     // lintening
     protected $listeners = [
        'passing-update-data-siswa' => 'showDataSiswa'
    ];

    public function render()
    {
        return view('livewire.data.user-update', [
            'spp' => spp::get(),
            'ruang' => ruang::get()
        ]);
    }

    public function showDataSiswa($id)
    {
        $this->siswaId = $id;

        $find = User::join('spps', 'users.spp_id', 'spps.id')->leftJoin('ruangs', 'users.ruang_id', 'ruangs.id')->where('users.id', $id)->get();

        foreach($find as $data){
            $this->spp_id = $data['spp_id'];
            $this->ruang_id = $data['ruang_id'];
            $this->nisn = $data['nisn'];
            $this->nis = $data['nis'];
            $this->name = $data['name'];
            $this->no_telp = $data['no_telp'];
            $this->alamat = $data['alamat'];
            $this->tahun = $data['tahun'];
            $this->nominal = $data['nominal'];
            $this->nama_kelas = $data['nama_kelas'];
            $this->kopetensi_keahlian = $data['kopetensi_keahlian'];
        }
    }

    public function addSiswa()
    {
        $this->emit('add-data-siswa');
    }

    public function updateDataSiswa()
    {
        $this->validate([
            'nisn' => 'required|min:5|max:13|string',
            'nis' => 'required|min:5|max:13|string',
            'name' => 'required|min:5|max:50|string',
            'no_telp' => 'required|min:5|max:20|string',
            'alamat' => 'required|min:5|max:70|string',
            'spp_id' => 'required',
            'ruang_id' => 'required',
            'tahun' => 'required|date',
            'nominal' => 'required|max:30',
            'nama_kelas' => 'required|max:10',
            'kopetensi_keahlian' => 'required|max:20',
        ]);

        User::join('spps', 'users.spp_id', 'spps.id')->leftJoin('ruangs', 'users.ruang_id', 'ruangs.id')->where('users.id', $this->siswaId)->update([
            'nisn' => $this->nisn,
            'nis' => $this->nis,
            'name' => $this->name,
            'no_telp' => $this->no_telp,
            'alamat' => $this->alamat,
            'spp_id' => $this->spp_id,
            'ruang_id' => $this->ruang_id,
            'tahun' => $this->tahun,
            'nominal' => $this->nominal,
            'nama_kelas' => $this->nama_kelas,
            'kopetensi_keahlian' => $this->kopetensi_keahlian,
        ]);

        $this->clearDataUpdateSiswa();
        $this->emit('success-update-data-siswa');
    }

    private function clearDataUpdateSiswa()
    {
        $this->siswaId = null;
        $this->nisn = null;
        $this->nis = null;
        $this->name = null;
        $this->no_telp = null;
        $this->alamat = null;
        $this->spp_id = null;
        $this->ruang_id = null;
        $this->tahun = null;
        $this->nominal = null;
        $this->nama_kelas = null;
        $this->kopetensi_keahlian = null;
    }
}