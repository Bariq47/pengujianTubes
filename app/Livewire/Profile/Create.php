<?php

namespace App\Livewire\Profile;

use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.guest-layout')]
#[Title('Data Diri')]
class Create extends Component
{
    public $nama;
    public $noKtp;
    public $jenisKelamin;
    public $noTelp;
    public $alamat;
    public function render()
    {
        return view('livewire.profile.create');
    }

    public function save()
    {
        $this->validate([
            'nama'          => 'required|string',
            'noKtp'         => 'required|numeric',
            'jenisKelamin'  => 'required',
            'noTelp'        => 'required|numeric',
            'alamat'        => 'required|string'
        ]);

        $data = [
            'nama'          => $this->nama,
            'no_ktp'        => $this->noKtp,
            'jenis_kelamin' => $this->jenisKelamin,
            'no_telp'       => $this->noTelp,
            'alamat'        => $this->alamat,
            'user_id'       => Auth::user()->id,
        ];

        Profile::create($data);

        $this->redirectRoute('member-dashboard');
    }

    public function logout()
    {
        Auth::logout();

        session()->invalidate();

        session()->regenerateToken();

        session()->flash('success', 'Terima kasih !');
        $this->redirectRoute('auth-signin');
    }
}
