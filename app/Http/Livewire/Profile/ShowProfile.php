<?php

namespace App\Http\Livewire\Profile;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class ShowProfile extends Component
{
    public $data;

    public function mount()
    {
        $this->data = User::find(Auth::user()->id);
    }

    public function render()
    {
        return view('livewire.profile.show-profile');
    }
}