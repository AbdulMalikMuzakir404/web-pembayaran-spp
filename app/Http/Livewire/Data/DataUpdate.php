<?php

namespace App\Http\Livewire\Data;

use App\Models\spp;
use Livewire\Component;

class DataUpdate extends Component
{
    public $tahun, $nominal, $sppId;

    // lintening
    protected $listeners = [
        'passing-update-data-spp' => 'showDataSpp'
    ];

    public function render()
    {
        return view('livewire.data.data-update');
    }

    public function showDataSpp($data_spp)
    {
        $this->sppId = $data_spp['id'];
        $this->tahun = $data_spp['tahun'];
        $this->nominal = $data_spp['nominal'];
    }

    public function updateDataSpp()
    {
        $this->validate([
            'tahun' => 'required|date',
            'nominal' => 'required|max:30'
        ]);

        spp::where('id', $this->sppId)->update([
            'tahun' => $this->tahun,
            'nominal' => $this->nominal
        ]);

        $this->clearDataUpdateSpp();
        $this->emit('success-update-data-spp');
    }

    private function clearDataUpdateSpp()
    {
        $this->sppId = null;
        $this->tahun = null;
        $this->nominal = null;
    }

    public function addSpp()
    {
        $this->emit('add-data-spp');
    }
}