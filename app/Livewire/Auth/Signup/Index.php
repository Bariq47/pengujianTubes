<?php

namespace App\Livewire\Auth\Signup;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.guest-layout')]
#[Title('Sign Up')]
class Index extends Component
{
    public $email;
    public $password;
    public $konfirmasiPassword;
    public function render()
    {
        return view('livewire.auth.signup.index');
    }

    public function save()
    {
        $this->validate([
            'email'                 => 'required|email|unique:users,email',
            'password'              => 'required|same:konfirmasiPassword|min:6|regex:/^(?=.*[a-z])/|regex:/^(?=.*[A-Z])/|regex:/^(?=.*[0-9])/',
            'konfirmasiPassword'    => 'required'
        ]);

        $data = [
            'email'     => $this->email,
            'password'  => Hash::make($this->password),
            'role_id'   => 2,
        ];

        User::create($data);

        if (Auth::attempt([
            'email'     => $this->email,
            'password'  => $this->password
        ])) {
            session()->flash('success', 'berhasil mendaftar !');
            $this->reset();
            $this->redirectRoute('profile-create');
        }
    }
}
