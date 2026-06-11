<?php

namespace App\Livewire\Auth\Signin;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.guest-layout')]
#[Title('Sign In')]
class Index extends Component
{
    public $email;
    public $password;

    public function mount()
    {
        $this->dispatch('close-toast');
    }

    public function render()
    {
        return view('livewire.auth.signin.index');
    }

    public function login()
    {
        // validasi input
        $this->validate([
            'email'     => 'required|email',
            'password'  => 'required'
        ]);

        // login section
        if (Auth::attempt([
            'email'     => $this->email,
            'password'  => $this->password
        ])) {

            // generate session login
            session()->regenerate();

            // check user profile (true or false)
            if (Auth::user()->profile !== null) {

                // check role id
                if (Auth::user()->role_id == 1) {
                    $this->redirectRoute('admin-dashboard');
                } else {
                    $this->redirectRoute('member-dashboard');
                }
            } else {
                $this->redirectRoute('profile-create');
            }
        } else {
            // login invalid
            session()->flash('error', 'Username atau Password tidak valid !');
            $this->dispatch('close-toast');
            $this->reset();
        }
    }
}
