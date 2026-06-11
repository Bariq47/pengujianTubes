<?php

namespace App\Livewire\Profile;

use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('layouts.app-layout')]
#[Title('Profile')]

class Index extends Component
{
    use WithFileUploads;

    public $profileId;
    public $profileRole;
    public $nama;
    public $noKtp;
    public $jenisKelamin;
    public $noTelp;
    public $alamat;
    public $foto;
    public $oldFoto;

    public function mount()
    {
        $this->profileId    = Auth::user()->profile->id;
        $this->profileRole  = Auth::user()->role_id;
        $this->nama         = Auth::user()->profile->nama;
        $this->noKtp        = Auth::user()->profile->no_ktp;
        $this->jenisKelamin = Auth::user()->profile->jenis_kelamin;
        $this->noTelp       = Auth::user()->profile->no_telp;
        $this->alamat       = Auth::user()->profile->alamat;
        $this->oldFoto      = Auth::user()->profile->foto;
    }

    public function render()
    {
        return view('livewire.profile.index');
    }

    public function update()
    {
        $this->validate([
            'nama'          => 'required|string',
            'noKtp'         => 'required|numeric',
            'jenisKelamin'  => 'required',
            'noTelp'        => 'required|numeric',
            'alamat'        => 'required|string',
        ]);

        if ($this->foto != null) {

            $imageName      = time() . '.' . $this->foto->extension();
            $this->foto->storeAs('profile', $imageName, ['disk' => 'upload']);

            if ($this->oldFoto != 'profile.jpg') {
                Storage::disk('upload')->delete('profile/' . $this->oldFoto);
            }

            $data = [
                'nama'          => $this->nama,
                'no_ktp'        => $this->noKtp,
                'jenis_kelamin' => $this->jenisKelamin,
                'no_telp'       => $this->noTelp,
                'alamat'        => $this->alamat,
                'user_id'       => $this->profileId,
                'foto'          => $imageName
            ];
        } else {
            $data = [
                'nama'          => $this->nama,
                'no_ktp'        => $this->noKtp,
                'jenis_kelamin' => $this->jenisKelamin,
                'no_telp'       => $this->noTelp,
                'alamat'        => $this->alamat,
                'user_id'       => $this->profileId,
                'foto'          => $this->oldFoto
            ];
        }

        Profile::where('id', $this->profileId)->update($data);

        if ($this->profileRole == 1) {
            $this->redirectRoute('admin-dashboard');
        } else {
            $this->redirectRoute('member-dashboard');
        }
    }
}