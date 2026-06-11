<?php

namespace App\Livewire\Admin\Pesanan;

use App\Models\Mobil;
use App\Models\Pengembalian;
use App\Models\Pesanan;
use App\Models\Supir;
use App\Models\TransaksiPembayaran;
use DateTime;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.app-layout')]
#[Title('Detail Pesanan')]

class Detail extends Component
{
    public $pesananId;
    public $mobilId;
    public $profileId;
    public $profileName;
    public $tanggalPemesanan;
    public $tanggalPengembalian;
    public $supir;
    public $supirId;
    public $tanpaSupir;
    public $denganSupir;
    public $totalHarga;

    public $namaPemesan;
    public $namaMobil;
    public $jenisMobil;
    public $merekMobil;
    public $tanggalKembali;

    public function mount(int $id)
    {
        $this->pesananId    = $id;
    }

    public function render()
    {
        $data       = Pesanan::with(['mobil', 'profile', 'driver'])->findOrFail($this->pesananId);

        $daftarSupir    = Supir::all();

        return view('livewire.admin.pesanan.detail', [
            'data'          => $data,
            'daftarSupir'   => $daftarSupir
        ]);
    }

    public function setCancle(int $mobilId, ?int $supirId = null)
    {
        $this->mobilId  = $mobilId;
        $this->supirId  = $supirId;
    }

    public function cancle()
    {
        Pesanan::where('id', $this->pesananId)->update([
            'status_bayar'  => 'unpaid'
        ]);

        TransaksiPembayaran::where('pesanan_id', $this->pesananId)->delete();

        Mobil::where('id', $this->mobilId)->update([
            'status_mobil'  => 0
        ]);

        if ($this->supirId != null) {
            Supir::where('id', $this->supirId)->update([
                'status_supir'  => 0
            ]);
        }

        session()->flash('success', 'Data pesanan berhasil dibatalkan !.');

        $this->close();

        $this->redirectRoute('admin-pesanan');
    }

    public function edit()
    {
        $data   = Pesanan::with(['mobil', 'profile', 'driver'])->findOrFail($this->pesananId);

        $this->mobilId              = $data->mobil->id;
        $this->profileId            = $data->profile->id;
        $this->profileName          = $data->profile->nama;
        $this->tanggalPemesanan     = $data->tanggal_pemesanan;
        $this->tanggalPengembalian  = $data->tanggal_pengembalian;
        $this->supir                = $data->supir;
        $this->supirId              = $data->supir_id;
        $this->tanpaSupir           = $data->mobil->harga_per_hari;
        $this->denganSupir          = $data->mobil->harga_dengan_supir;
        $this->totalHarga           = $data->total_harga;
    }

    public function update()
    {
        $this->validate([
            'tanggalPemesanan'      => 'required|date',
            'tanggalPengembalian'   => 'required|date',
            'supir'                 => 'required|string',
            'tanpaSupir'            => 'required|numeric',
            'denganSupir'           => 'required|numeric',
            'totalHarga'            => 'required|numeric'
        ]);

        $tanggalPemesanan       = new DateTime($this->tanggalPemesanan);
        $tanggalPengembalian    = new DateTime($this->tanggalPengembalian);
        $jumlahHari             = $tanggalPemesanan->diff($tanggalPengembalian);

        $data   = [
            'profile_id'            => $this->profileId,
            'mobil_id'              => $this->mobilId,
            'supir'                 => $this->supir,
            'tanggal_pemesanan'     => $this->tanggalPemesanan,
            'tanggal_pengembalian'  => $this->tanggalPengembalian,
            'total_harga'           => $this->totalHarga,
            'status_bayar'          => 'pending',
            'jumlah_hari'           => $jumlahHari->d,
            'total_bayar'           => $jumlahHari->d * $this->totalHarga,
            'keterangan'            => 'Silahkan melakukan konfirmasi pembayaran !.'
        ];

        if ($this->supir == "YA" && $this->supirId == null) {

            session()->flash('error', 'Opps.. silahkan pilih supir terlebih dahulu !.');

            $this->dispatch('close-toast');
        } elseif ($this->supir == 'YA' && $this->supirId != null) {

            Supir::where('id', $this->supirId)->update([
                'status_supir'  => 1
            ]);

            $data['supir_id'] = $this->supirId;

            Pesanan::where('id', $this->pesananId)->update($data);

            session()->flash('success', 'Yayy !. data berhasil diupdate !.');

            $this->close();
        } elseif (($this->supir == 'TIDAK' && $this->supirId != null)) {

            Supir::where('id', $this->supirId)->update([
                'status_supir'  => 0
            ]);

            $data['supir_id']       = null;
            $data['total_harga']    = $this->tanpaSupir;

            Pesanan::where('id', $this->pesananId)->update($data);

            session()->flash('success', 'Yayy !. data berhasil diupdate !.');

            $this->close();
        } else {
            $data['supir_id'] = $this->supirId;

            Pesanan::where('id', $this->pesananId)->update($data);

            session()->flash('success', 'Yayy !. data berhasil diupdate !.');

            $this->close();
        }
    }

    public function pilihSupir(int $id)
    {
        $this->supirId      = $id;
        $this->totalHarga   = $this->denganSupir;
    }

    public function hapusSupir()
    {
        Supir::where('id', $this->supirId)->update([
            'status_supir'  => 0
        ]);

        $this->supirId      = null;
        $this->supir        = "TIDAK";
        $this->totalHarga   = $this->tanpaSupir;
    }

    public function setPengembalian()
    {
        $data   = Pesanan::with(['mobil', 'profile', 'driver'])->findOrFail($this->pesananId);

        $this->namaPemesan          = $data->profile->nama;
        $this->mobilId              = $data->mobil_id;
        $this->namaMobil            = $data->mobil->nama_mobil;
        $this->jenisMobil           = $data->mobil->jenismobil->jenis_mobil;
        $this->merekMobil           = $data->mobil->merekmobil->merek_mobil;
        $this->supirId              = $data->supir_id;
        $this->tanggalPengembalian  = $data->tanggal_pengembalian;
    }

    public function pengembalian()
    {
        $this->validate([
            'tanggalKembali'        => 'required|date',
            'tanggalPengembalian'   => 'required|date'
        ]);

        $tanggalPengembalian    = new DateTime($this->tanggalPengembalian);
        $tanggalKembali         = new DateTime($this->tanggalKembali);
        $jumlahHari             = $tanggalPengembalian->diff($tanggalKembali);

        $data = [
            'pesanan_id'            => $this->pesananId,
            'tanggal_pengembalian'  => $this->tanggalPengembalian,
            'tanggal_kembali'       => $this->tanggalKembali,
            'telat'                 => $jumlahHari->d,
            'denda'                 => $jumlahHari->d * 150000
        ];

        Pengembalian::create($data);
        Pesanan::where('id', $this->pesananId)->update([
            'keterangan'    => 'Terima kasih sudah menggunakan jasa kami !.'
        ]);
        Mobil::where('id', $this->mobilId)->update([
            'status_mobil' => 0
        ]);
        if ($this->supirId != null) {
            Supir::where('id', $this->supirId)->update([
                'status_supir' => 0
            ]);
        }

        $this->close();

        $this->redirectRoute('admin-pengembalian');
    }

    public function close()
    {
        $this->resetExcept('pesananId');
        $this->resetErrorBag();
        $this->dispatch('close-modal');
        $this->dispatch('close-toast');
    }
}
