<?php

namespace App\Http\Livewire\Profile;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ChangeProfile extends Component
{
    use WithFileUploads;

    public $email, $name, $level, $username, $photo, $userId;

    public $old_password, $password, $password_confirmation;

    public function mount()
    {
        $this->userId = Auth()->user()->id;
        $this->email = Auth()->user()->email;
        $this->name = Auth()->user()->name;
        $this->level = Auth()->user()->level;
        $this->username = Auth()->user()->username;
    }

    public function render()
    {
        return view('livewire.profile.change-profile');
    }

    public function changeProfile()
    {
        $this->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users']

        ]);

        User::where('id', $this->userId)->update([
            'email' => $this->email
        ]);

        return redirect()
            ->route('changeProfile')
            ->with('success', 'Data Berhasil di Ubah');
    }

    public function updatePassword()
    {
        $this->validate([
            'password' => 'required|max:100|string|min:8|confirmed',
        ]);

        $old_password = Auth::user()->password;
        $user_id = Auth::user()->id;

        if (Hash::check($this->old_password, $old_password)) {
            $user = User::find($user_id);
            $user->password = Hash::make($this->password);

            if ($user->save()) {
                return redirect()
                    ->route('changeProfile')
                    ->with('success', 'Berhasil mengubah password');
            } else {
                return redirect()
                    ->route('changeProfile')
                    ->with('error', 'Password lama salah');
            }
        } else {
            return redirect()
                ->route('changeProfile')
                ->with('error', 'Password lama salah');
        }
    }

    public function updateImage()
    {
        $this->validate([
            'photo' => 'required|image|mimes:jpg,jpeg,png,svg,gif|max:2048',
        ]);

        Storage::disk('public')->delete('profile/' . Auth()->user()->photo);

        $destination_path = 'public/profile';
        $foto = time() . '_' . rand() . '.' . $this->photo->extension();
        $this->photo->storeAs($destination_path, $foto);

        User::where('id', $this->userId)->update([
            'photo' => $foto,
        ]);

        return redirect()
            ->route('changeProfile')
            ->with('success', 'Images has been change');
    }

    public function deleteImage()
    {
        if (Storage::delete('profile/' . Auth()->user()->photo)) {
            Storage::disk('public')->delete('profile/' . Auth()->user()->photo);
            /*
                Delete Multiple File like this way
                Storage::delete(['upload/example.png', 'upload/example2.png']);
            */

            User::where('id', $this->userId)->update([
                'photo' => null,
            ]);

            return redirect()
                ->route('changeProfile')
                ->with('warning', 'Images has been deleted');
        }
    }
}