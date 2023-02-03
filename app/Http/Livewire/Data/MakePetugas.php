<?php

namespace App\Http\Livewire\Data;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class MakePetugas extends Component
{
    public $email, $nama, $username, $password;

    public function render()
    {
        return view('livewire.data.make-petugas');
    }

    public function makeDataPetugas()
    {
        $this->validate([
            'email' => 'required|email|string|min:5|max:50|unique:users',
            'username' => 'required|min:5|string|max:50|unique:users',
            'nama' => 'required|min:5|max:50|string|unique:users',
            'password' => 'required|min:8|max:70|string'
        ]);

        User::create([
            'email' => $this->email,
            'nama' => $this->nama,
            'username' => $this->username,
            'password' => Hash::make($this->password),
            'level' => 'petugas',
        ]);

        dd('berhasil');
    }
}