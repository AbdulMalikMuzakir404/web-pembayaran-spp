<?php

namespace App\Http\Livewire\Data;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class PetugasUpdate extends Component
{
    public $email, $nama, $username, $password, $petugasId;

    // lintening
    protected $listeners = [
        'passing-update-data-petugas' => 'showDataPetugas',
    ];

    public function render()
    {
        return view('livewire.data.petugas-update');
    }

    public function addPetugas()
    {
        $this->emit('add-data-petugas');
    }

    public function showDataPetugas($data)
    {
        $this->petugasId = $data['id'];
        $this->email = $data['email'];
        $this->nama = $data['nama'];
        $this->username = $data['username'];
        $this->password = 'Data Encrypt';
    }

    public function updateDataPetugas()
    {
        $this->validate([
            'email' => 'required|email|string|min:5|max:50',
            'username' => 'required|min:5|string|max:50',
            'nama' => 'required|min:5|max:50|string'
        ]);

        User::find($this->petugasId)->update([
            'email' => $this->email,
            'nama' => $this->nama,
            'username' => $this->username
        ]);

        $this->clearDataUpdatePetugas();
        $this->emit('success-update-data-petugas');
    }

    private function clearDataUpdatePetugas()
    {
        $this->petugasId = null;
        $this->email = null;
        $this->nama = null;
        $this->username = null;
        $this->password = null;
    }
}