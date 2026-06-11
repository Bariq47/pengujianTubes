<?php

namespace App\Livewire\Member\Pesanan;

use App\Models\Pesanan;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app-layout')]
#[Title('Daftar Pesanan')]

class Index extends Component
{

    use WithPagination;
    protected $paginationTheme  = 'bootstrap';

    public $keyword;
    public $result;
    public $historyResult;
    public $profileId;
    public $year;
    public $month;
    public $bulan;
    public $today;

    public function mount()
    {
        $this->result           = 10;
        $this->historyResult    = 10;
        $this->profileId        = Auth::user()->profile->id;

        $this->dispatch('close-toast');

        $this->month    = Carbon::now()->month;
        $this->year     = Carbon::now()->year;
        $this->bulan    = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desembar'
        ];
        $this->today    = $this->bulan[$this->month - 1] . '/ ' . $this->year;
    }

    public function render()
    {

        if ($this->keyword != null) {
            $data   = Pesanan::with(['mobil', 'profile', 'driver', 'pengembalian'])
                ->where('profile_id', $this->profileId)
                ->where('tanggal_pemesanan', $this->keyword)
                ->orderBy('id', 'DESC')
                ->paginate($this->result);
        } else {
            $data   = Pesanan::with(['mobil', 'profile', 'driver', 'pengembalian'])
                ->where('profile_id', $this->profileId)
                ->orderBy('id', 'DESC')
                ->paginate($this->result);
        }

        $history    = Pesanan::with(['profile', 'mobil', 'driver', 'pengembalian'])
            ->where('profile_id', $this->profileId)
            ->whereMonth('created_at', $this->month)
            ->whereYear('created_at', $this->year)
            ->orderBy('id', 'DESC')
            ->paginate($this->historyResult);

        return view('livewire.member.pesanan.index', [
            'data'      => $data,
            'history'   => $history
        ]);
    }
}
