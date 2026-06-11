<?php

namespace App\Livewire\Admin\Pesanan;

use App\Models\Pesanan;
use Carbon\Carbon;
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
    public $status;
    public $result;
    public $historyResult;
    public $year;
    public $month;
    public $bulan;
    public $today;

    public function mount()
    {
        $this->result           = 10;
        $this->historyResult    = 10;
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
        if ($this->keyword != null && $this->status != null) {
            $data = Pesanan::with(['profile', 'mobil', 'driver'])
                ->where('tanggal_pemesanan', $this->keyword)
                ->where('status_bayar', $this->status)
                ->orderBy('id', 'DESC')
                ->paginate($this->result);
        } elseif ($this->status != null) {
            $data = Pesanan::with(['profile', 'mobil', 'driver'])
                ->where('status_bayar', $this->status)
                ->orderBy('id', 'DESC')
                ->paginate($this->result);
        } elseif ($this->keyword != null) {
            $data = Pesanan::with(['profile', 'mobil', 'driver'])
                ->where('tanggal_pemesanan', $this->keyword)
                ->orderBy('id', 'DESC')
                ->paginate($this->result);
        } else {
            $data       = Pesanan::with(['profile', 'mobil', 'driver', 'pengembalian'])
                ->orderBy('id', 'DESC')
                ->paginate($this->result);
        }

        $history    = Pesanan::with(['profile', 'mobil', 'driver', 'pengembalian'])
            ->whereMonth('created_at', $this->month)
            ->whereYear('created_at', $this->year)
            ->orderBy('id', 'DESC')
            ->paginate($this->historyResult);

        return view('livewire.admin.pesanan.index', [
            'data'      => $data,
            'history'   => $history
        ]);
    }


}
