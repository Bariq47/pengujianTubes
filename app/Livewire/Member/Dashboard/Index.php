<?php

namespace App\Livewire\Member\Dashboard;

use App\Models\Pesanan;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app-layout')]
#[Title('Dashboard Member')]
class Index extends Component
{
    public $profileId;

    public $month;
    public $year;

    public $bulan;
    public $tahun;

    public function mount()
    {
        $this->profileId    = Auth::user()->profile->id;
        $this->month    = Carbon::now()->month;
        $this->year     = Carbon::now()->year;
        $this->bulan    = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desembar'
        ];
        $this->tahun    = [
            2024, 2025
        ];
    }

    public function render()
    {
        $data           = Pesanan::with(['mobil', 'profile', 'driver', 'pengembalian', 'transaksipembayaran'])
            ->where('profile_id', $this->profileId)
            ->whereMonth('created_at', $this->month)
            ->whereYear('created_at', $this->year)
            ->get();

        $pembayaranPaid         = 0;
        $pengembalian       = 0;
        $pesanan            = 0;
        $pembayaranPending  = 0;
        $pesananTranaksi    = 0;
        $totalDenda         = 0;

        foreach ($data as $value) {

            if ($value->transaksipembayaran != null) {
                if ($value->status_bayar == 'paid') {
                    $pembayaranPaid += $value->total_bayar;
                    $pesananTranaksi +=  1;
                }
            } else {
                if ($value->status_bayar == 'pending') {
                    $pesanan += 1;
                    $pembayaranPending  += $value->total_bayar;
                }
            }

            if ($value->pengembalian != null) {
                $pengembalian += 1;
                $totalDenda += $value->pengembalian->denda;
            }
        }

        return view('livewire.member.dashboard.index', [
            'pembayaranPaid'            => $pembayaranPaid,
            'totalDenda'                => $totalDenda,
            'totalPinjamanMobil'        => $pesanan,
            'pembayaranPending'         => $pembayaranPending,
            'sedangDipinjam'            => $pesananTranaksi,
            'totalPengembalianMobil'    => $pengembalian,
        ]);
    }
}
