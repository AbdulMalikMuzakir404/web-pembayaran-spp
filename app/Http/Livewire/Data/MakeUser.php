<?php

namespace App\Http\Livewire\Data;

use App\Models\spp;
use App\Models\User;
use App\Models\ruang;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class MakeUser extends Component
{
    public $email, $nisn, $nis, $nama, $no_telp, $alamat, $spp_id, $ruang_id;

    public function render()
    {
        return view('livewire.data.make-user', [
            'spp' => spp::get(),
            'ruang' => ruang::get()
        ]);
    }

    public function makeDataSiswa()
    {
        $this->validate([
            'email' => 'required|email|min:5|max:50|unique:users|string',
            'nisn' => 'required|min:5|max:13|unique:users|string',
            'nis' => 'required|min:5|max:13|unique:users|string',
            'nama' => 'required|min:5|max:50|string|unique:users',
            'no_telp' => 'required|min:5|max:20|string',
            'alamat' => 'required|min:5|max:70|string',
            'spp_id' => 'required',
            'ruang_id' => 'required',
        ]);

        User::create([
            'email' => $this->email,
            'nisn' => $this->nisn,
            'nis' => Hash::make($this->nis),
            'nama' => $this->nama,
            'no_telp' => $this->no_telp,
            'alamat' => $this->alamat,
            'spp_id' => $this->spp_id,
            'ruang_id' => $this->ruang_id,
            'level' => 'siswa',
        ]);

        dd('berhasil');

   }
}