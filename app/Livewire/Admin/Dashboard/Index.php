<?php

namespace App\Livewire\Admin\Dashboard;

use App\Models\JenisMobil;
use App\Models\MerekMobil;
use App\Models\Mobil;
use App\Models\Pengembalian;
use App\Models\Pesanan;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.app-layout')]
#[Title('Dashboard Admin')]
class Index extends Component
{

    public $month;
    public $year;

    public $bulan;
    public $tahun;

    public function mount()
    {
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
        $mobil          = Mobil::all()->count();
        $jenisMobil     = JenisMobil::all()->count();
        $merekMobil     = MerekMobil::all()->count();

        $pesanan        = Pesanan::with('transaksipembayaran')
            ->whereMonth('created_at', $this->month)
            ->whereYear('created_at', $this->year)
            ->get();
        $pengembalian   = Pengembalian::whereMonth('created_at', $this->month)
            ->whereYear('created_at', $this->year)
            ->count();
        $booking        = Pesanan::with('transaksipembayaran')->whereHas('transaksipembayaran', function (Builder $builder) {
            $builder->whereMonth('created_at', $this->month)->whereYear('created_at', $this->year);
        })->get();
        $bookingReturn  = Pesanan::with('pengembalian')->whereHas('pengembalian', function (Builder $builder) {
            $builder->whereMonth('created_at', $this->month)->whereYear('created_at', $this->year);
        })->get();

        $bookingConfirmCount    = 0;
        $bookingCount           = 0;
        $pembayaranPending      = 0;
        $pendapatanPesanan      = 0;
        $pendapatanDenda        = 0;

        foreach ($pesanan as $value) {
            if ($value->transaksipembayaran == null && $value->status_bayar == 'pending') {
                $bookingConfirmCount += 1;
                $pembayaranPending += $value->total_bayar;
            }
        }

        foreach ($booking as $value) {
            if ($value->status_bayar == 'paid') {
                $pendapatanPesanan += $value->total_bayar;
                $bookingCount += 1;
            }
        }

        foreach ($bookingReturn as $value) {
            $pendapatanDenda += $value->pengembalian->denda;
        }

        return view('livewire.admin.dashboard.index', [
            'mobil'             => $mobil,
            'jenisMobil'        => $jenisMobil,
            'merekMobil'        => $merekMobil,
            'pesanan'           => $bookingConfirmCount,
            'pengembalian'      => $pengembalian,
            'booking'           => $bookingCount,
            'pembayaranPending' => $pembayaranPending,
            'pendapatanPesanan' => $pendapatanPesanan,
            'pendapatanDenda'   => $pendapatanDenda,
        ]);
    }
}
