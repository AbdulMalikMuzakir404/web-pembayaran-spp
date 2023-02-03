<?php

namespace App\Http\Livewire\Data;

use App\Models\spp;
use App\Models\ruang;
use Livewire\Component;

class DataCreate extends Component
{
    public $nama_kelas, $kopetensi_keahlian, $tahun, $nominal;

    public function render()
    {
        return view('livewire.data.data-create');
    }

    public function makeDataSpp()
    {
        $this->validate([
            'tahun' => 'required|date',
            'nominal' => 'required|max:30'
        ]);

        spp::create([
            'tahun' => $this->tahun,
            'nominal' => $this->nominal
        ]);

        dd('berhasil');
    }

    public function makeDataKelas()
    {
        $this->validate([
            'nama_kelas' => 'required|string|max:50|unique:ruangs',
            'kopetensi_keahlian' => 'required|in: "rpl", "mm", "tkj"'
        ]);

        ruang::create([
            'nama_kelas' => $this->nama_kelas,
            'kopetensi_keahlian' => $this->kopetensi_keahlian
        ]);

        dd('berhasil');
    }
}