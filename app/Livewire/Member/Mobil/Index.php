<?php

namespace App\Livewire\Member\Mobil;

use App\Models\JenisMobil;
use App\Models\MerekMobil;
use App\Models\Mobil;
use App\Models\Pesanan;
use App\Models\Supir;
use App\Models\TransaksiPembayaran;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.app-layout')]
#[Title('Daftar Mobil')]

class Index extends Component
{
    public $filterJenis;
    public $filterMerek;

    public $mobilId;
    public $mobilName;
    public $profileId;
    public $profileName;
    public $profileAlamat;
    public $profileTelp;
    public $tanggalPemesanan;
    public $tanggalPengembalian;
    public $supir;
    public $supirId;
    public $tanpaSupir;
    public $denganSupir;
    public $totalHarga;

    public function mount()
    {
        $this->profileId        = Auth::user()->profile->id;
        $this->profileName      = Auth::user()->profile->nama;
        $this->profileAlamat    = Auth::user()->profile->alamat;
        $this->profileTelp      = Auth::user()->profile->no_telp;
    }

    public function render()
    {

        if ($this->filterJenis != null && $this->filterMerek != null) {
            $data   = Mobil::with(['jenismobil', 'merekmobil', 'pesanan'])
                ->where('jenis_mobil_id', $this->filterJenis)
                ->where('merek_mobil_id', $this->filterMerek)
                ->orderBy('id', 'DESC')
                ->get();
        } else if ($this->filterJenis != null || $this->filterMerek != null) {
            $data   = Mobil::with(['jenismobil', 'merekmobil', 'pesanan'])
                ->where('jenis_mobil_id', $this->filterJenis)
                ->orWhere('jenis_mobil_id', $this->filterJenis)
                ->where('merek_mobil_id', $this->filterMerek)
                ->orWhere('merek_mobil_id', $this->filterMerek)
                ->orderBy('id', 'DESC')
                ->get();
        } else {
            $data   = Mobil::with(['jenismobil', 'merekmobil', 'pesanan'])
                ->orderBy('id', 'DESC')
                ->get();
        }

        $jenisMobil     = JenisMobil::all();
        $merekMobil     = MerekMobil::all();

        $daftarSupir    = Supir::with('pesanan')->get();

        return view('livewire.member.mobil.index', [
            'data'              => $data,
            'jenisMobil'        => $jenisMobil,
            'merekMobil'        => $merekMobil,
            'daftarSupir'       => $daftarSupir
        ]);
    }

    public function rules()
    {
        return [
            'tanggalPemesanan'      => 'required|date',
            'tanggalPengembalian'   => 'required|date',
            'supir'                 => 'required|string',
            'tanpaSupir'            => 'required|numeric',
            'denganSupir'           => 'required|numeric',
            'totalHarga'            => 'required|numeric'
        ];
    }

    public function filter()
    {
        $this->dispatch('close-modal');
    }

    public function booking(int $id)
    {
        $data               = Mobil::findOrFail($id);

        $this->mobilId      = $data->id;
        $this->mobilName    = $data->nama_mobil;
        $this->supir        = 'TIDAK';
        $this->supirId      = null;
        $this->tanpaSupir   = $data->harga_per_hari;
        $this->denganSupir  = $data->harga_dengan_supir;
        $this->totalHarga   = $this->tanpaSupir;
    }

    public function pilihSupir(int $id)
    {
        $this->supirId      = $id;
        $this->totalHarga   = $this->denganSupir;
    }

    public function hapusSupir()
    {
        $this->supirId      = null;
        $this->supir        = 'TIDAK';
        $this->totalHarga   = $this->tanpaSupir;
    }

    public function save()
    {
        $this->validate();

        $tglPesan   = new DateTime($this->tanggalPemesanan);
        $tglKembali = new DateTime($this->tanggalPengembalian);
        $jumlahHari = $tglPesan->diff($tglKembali);

        $data   = [
            'profile_id'            => $this->profileId,
            'mobil_id'              => $this->mobilId,
            'supir'                 => $this->supir,
            'supir_id'              => $this->supirId,
            'tanggal_pemesanan'     => $this->tanggalPemesanan,
            'tanggal_pengembalian'  => $this->tanggalPengembalian,
            'total_harga'           => $this->totalHarga,
            'status_bayar'          => 'pending',
            'jumlah_hari'           => $jumlahHari->d,
            'total_bayar'           => $jumlahHari->d * $this->totalHarga,
            'keterangan'            => 'Silahkan melakukan pembayaran !.'
        ];

        if ($this->supir == 'YA' && $this->supirId == null) {

            session()->flash('error', 'Opps.. silahkan pilih supir terlebih dahulu !.');
        } elseif ($this->supir == 'YA' && $this->supirId != null) {

            Supir::where('id', $this->supirId)->update([
                'status_supir'  => 1
            ]);

            $mobil      = Mobil::findOrFail($this->mobilId);
            $mobil->update([
                'status_mobil'  => 1
            ]);

            Pesanan::create($data);

            session()->flash('success', 'Yayy !. Silahkan melakukan konfirmasi pembayaran !.');

            $this->close();
            $this->redirectRoute('member-pesanan', [], true, true);
        } elseif ($this->supir == 'TIDAK' && $this->supirId != null) {

            Supir::where('id', $this->supirId)->update([
                'status_supir'  => 0
            ]);

            $data['supir_id']       = null;
            $data['total_harga']    = $this->tanpaSupir;

            $mobil      = Mobil::findOrFail($this->mobilId);
            $mobil->update([
                'status_mobil'  => 1
            ]);

            Pesanan::create($data);

            session()->flash('success', 'Yayy !. Silahkan melakukan konfirmasi pembayaran !.');

            $this->close();
            $this->redirectRoute('member-pesanan', [], true, true);
        } else {

            $mobil      = Mobil::findOrFail($this->mobilId);
            $mobil->update([
                'status_mobil'  => 1
            ]);

            Pesanan::create($data);

            session()->flash('success', 'Yayy !. Silahkan melakukan konfirmasi pembayaran !.');

            $this->close();
            $this->redirectRoute('member-pesanan', [], true, true);
        }
    }

    public function close()
    {
        $this->resetExcept('profileId', 'profileName');
        $this->resetErrorBag();
        $this->dispatch('close-toast');
        $this->dispatch('close-modal');
    }
}
