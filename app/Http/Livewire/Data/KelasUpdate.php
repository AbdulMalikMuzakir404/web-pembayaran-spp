<?php

namespace App\Http\Livewire\Data;

use App\Models\ruang;
use Livewire\Component;

class KelasUpdate extends Component
{
    public $nama_kelas, $kopetensi_keahlian, $kelasId;

    // lintening
    protected $listeners = [
        'passing-update-data-kelas' => 'showDataKelas'
    ];

    public function render()
    {
        return view('livewire.data.kelas-update');
    }

    public function showDataKelas($data_kelas)
    {
        $this->kelasId = $data_kelas['id'];
        $this->nama_kelas = $data_kelas['nama_kelas'];
        $this->kopetensi_keahlian = $data_kelas['kopetensi_keahlian'];
    }

    public function updateDataKelas()
    {
        $this->validate([
            'nama_kelas' => 'required|string|max:50|unique:ruangs',
            'kopetensi_keahlian' => 'required|max:10'
        ]);

        ruang::where('id', $this->kelasId)->update([
            'nama_kelas' => $this->nama_kelas,
            'kopetensi_keahlian' => $this->kopetensi_keahlian
        ]);

        $this->clearDataUpdateKelas();
        $this->emit('success-update-data-kelas');
    }

    private function clearDataUpdateKelas()
    {
        $this->kelasId = null;
        $this->nama_kelas = null;
        $this->kopetensi_keahlian = null;
    }

    public function addKelas()
    {
        $this->emit('add-data-kelas');
    }
}