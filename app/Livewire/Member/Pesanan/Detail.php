<?php
namespace App\Livewire\Member\Pesanan;

use App\Models\Kantor;
use App\Models\Pesanan;
use App\Models\TransaksiPembayaran;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.app-layout')]
#[Title('Detail Pesanan')]

class Detail extends Component
{
    public $pesananId;
    public $namaPemesan;
    public $emailPemesan;
    public $noTelpPemesan;
    public $mobilId;
    public $namaMobil;
    public $jenisMobil;
    public $merekMobil;
    public $supir;
    public $totalHarga;
    public $jumlahHari;
    public $totalBayar;
    public $kantor;

    public function mount(int $id)
    {
        $kantor = Kantor::first();
        $this->pesananId    = $id;
        $this->kantor       = $kantor->nama;
        $this->close();
    }

    public function render()
    {
        $data   = Pesanan::with(['mobil', 'profile', 'driver', 'transaksipembayaran'])->findOrFail($this->pesananId);
        return view('livewire.member.pesanan.detail', [
            'data'          => $data,
        ]);
    }

    public function setCheckout()
    {
        $data   = Pesanan::with(['mobil', 'profile', 'driver', 'transaksipembayaran'])->findOrFail($this->pesananId);

        $this->namaPemesan      = $data->profile->nama;
        $this->emailPemesan     = $data->profile->user->email;
        $this->noTelpPemesan    = $data->profile->no_telp;
        $this->mobilId          = $data->mobil->id;
        $this->namaMobil        = $data->mobil->nama_mobil;
        $this->jenisMobil       = $data->mobil->jenismobil->jenis_mobil;
        $this->merekMobil       = $data->mobil->merekmobil->merek_mobil;
        $this->supir            = $data->supir;
        $this->totalHarga       = $data->total_harga;
        $this->jumlahHari       = $data->jumlah_hari;
        $this->totalBayar       = $data->total_bayar;
    }

    public function checkout()
    {
        $data = Pesanan::with(['mobil', 'profile', 'driver', 'transaksipembayaran'])->findOrFail($this->pesananId);

        $transaksi = new TransaksiPembayaran();
        $transaksi->pesanan_id = $this->pesananId;
        $transaksi->token = '12'; // Ganti dengan nilai token yang sesuai
        $transaksi->save();

        session()->flash('success', 'Lanjutkan Pembayaran anda !.');

        $this->close();

        // Redirect ke route redirect-to-payment dengan parameter order_id dan amount
        return redirect()->route('redirect-to-payment', ['order_id' => $this->pesananId, 'amount' => $this->totalBayar]);
    }

    public function close()
    {
        $this->resetExcept(['pesananId']);
        $this->resetErrorBag();
        $this->dispatch('close-modal');
        $this->dispatch('close-toast');
    }
}
