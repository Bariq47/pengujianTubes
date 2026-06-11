<?php

namespace App\Livewire\Member\Pengembalian;

use App\Models\Pesanan;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app-layout')]
#[Title('Daftar Pengembalian Mobil')]

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme  = 'bootstrap';

    public $result;
    public $keyword;

    public $profileId;

    public function mount()
    {
        $this->result       = 10;
        $this->profileId    = Auth::user()->profile->id;
    }

    public function render()
    {

        if ($this->keyword != null) {
            $data   = Pesanan::with(['mobil', 'profile', 'driver', 'pengembalian'])
                ->where('profile_id', $this->profileId)
                ->whereHas('pengembalian', function (Builder $builder) {
                    $builder->where('tanggal_kembali', $this->keyword);
                })
                ->orderBy('id', 'DESC')
                ->paginate($this->result);
        } else {
            $data   = Pesanan::with(['mobil', 'profile', 'driver', 'pengembalian'])
                ->where('profile_id', $this->profileId)
                ->orderBy('id', 'DESC')
                ->paginate($this->result);
        }

        return view('livewire.member.pengembalian.index', [
            'data'  => $data
        ]);
    }
}
