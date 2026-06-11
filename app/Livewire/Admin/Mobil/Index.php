<?php

namespace App\Livewire\Admin\Mobil;

use App\Models\JenisMobil;
use App\Models\MerekMobil;
use App\Models\Mobil;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

#[Layout('layouts.app-layout')]
#[Title('Mobil')]
class Index extends Component
{

    use WithPagination;
    use WithFileUploads;

    protected $paginationTheme  = 'bootstrap';

    public $keyword;
    public $result  = 10;

    public $mobilId;
    public $nama;
    public $jenis;
    public $merek;
    public $noPolisi;
    public $warna;
    public $jumlahPenumpang;
    public $tahun;
    public $harga;
    public $hargaDenganSupir;
    public $tenaga;
    public $bahanBakar;
    public $ac;
    public $foto;
    public $oldFoto;

    public function render()
    {

        if ($this->keyword != null) {

            $data       = Mobil::with(['merekmobil', 'jenismobil'])
                ->where('nama_mobil', 'like', '%' . $this->keyword . '%')
                ->orWhereHas('jenismobil', function (Builder $builder) {
                    $builder->where('jenis_mobil', 'like', '%' . $this->keyword . '%');
                })
                ->orWhereHas('merekmobil', function (Builder $builder) {
                    $builder->where('merek_mobil', 'like', '%' . $this->keyword . '%');
                })
                ->orderBy('id', 'DESC')
                ->paginate($this->result);
        } else {

            $data       = Mobil::with(['jenismobil', 'merekmobil'])->orderBy('id', 'DESC')->paginate($this->result);
        }

        $jenisMobil = JenisMobil::all();
        $merekMobil = MerekMobil::all();

        return view('livewire.admin.mobil.index', [
            'data'          => $data,
            'jenisMobil'    => $jenisMobil,
            'merekMobil'    => $merekMobil,
        ]);
    }

    public function save()
    {
        $this->validate([
            'nama'                  => 'required|string',
            'jenis'                 => 'required|numeric',
            'merek'                 => 'required|numeric',
            'noPolisi'              => 'required|string|unique:mobil,no_polisi',
            'warna'                 => 'required|string',
            'jumlahPenumpang'       => 'required|numeric',
            'tahun'                 => 'required|string|max:4|min:4',
            'harga'                 => 'required|numeric',
            'hargaDenganSupir'      => 'required|numeric',
            'tenaga'                => 'required|string',
            'bahanBakar'            => 'required|string',
            'ac'                    => 'required|string',
            'foto'                  => 'required|image',
        ]);

        $imageName  = time() . '.' . $this->foto->extension();
        $this->foto->storeAs('cars', $imageName, ['disk' => 'upload']);

        $data = [
            'nama_mobil'            => $this->nama,
            'merek_mobil_id'        => $this->merek,
            'jenis_mobil_id'        => $this->jenis,
            'no_polisi'             => $this->noPolisi,
            'warna'                 => $this->warna,
            'jumlah_penumpang'      => $this->jumlahPenumpang,
            'tahun_mobil'           => $this->tahun,
            'harga_per_hari'        => $this->harga,
            'harga_dengan_supir'    => $this->hargaDenganSupir,
            'kecepatan'             => $this->tenaga,
            'bahan_bakar'           => $this->bahanBakar,
            'ac'                    => $this->ac,
            'foto'                  => $imageName,
        ];

        Mobil::create($data);

        session()->flash('success', 'Data mobil berhasil ditambah !');

        $this->reset();
        $this->dispatch('close-modal');
        $this->dispatch('close-toast');
    }

    public function edit(int $id)
    {
        $data = Mobil::with(['jenismobil', 'merekmobil'])->findOrFail($id);

        $this->mobilId          = $data->id;
        $this->nama             = $data->nama_mobil;
        $this->jenis            = $data->jenis_mobil_id;
        $this->merek            = $data->merek_mobil_id;
        $this->noPolisi         = $data->no_polisi;
        $this->warna            = $data->warna;
        $this->jumlahPenumpang  = $data->jumlah_penumpang;
        $this->tahun            = $data->tahun_mobil;
        $this->harga            = $data->harga_per_hari;
        $this->hargaDenganSupir = $data->harga_dengan_supir;
        $this->tenaga           = $data->kecepatan;
        $this->bahanBakar       = $data->bahan_bakar;
        $this->ac               = $data->ac;
        $this->oldFoto          = $data->foto;
    }

    public function update()
    {

        $this->validate([
            'nama'                  => 'required|string',
            'jenis'                 => 'required|numeric',
            'merek'                 => 'required|numeric',
            'noPolisi'              => 'required|string',
            'warna'                 => 'required|string',
            'jumlahPenumpang'       => 'required|numeric',
            'tahun'                 => 'required|string|max:4|min:4',
            'harga'                 => 'required|numeric',
            'hargaDenganSupir'      => 'required|numeric',
            'tenaga'                => 'required|string',
            'bahanBakar'            => 'required|string',
            'ac'                    => 'required|string',
        ]);

        if ($this->foto != null) {

            $imageName  = time() . '.' . $this->foto->extension();
            $this->foto->storeAs('cars', $imageName, ['disk' => 'upload']);

            Storage::disk('upload')->delete('cars/' . $this->oldFoto);

            $data = [
                'nama_mobil'            => $this->nama,
                'merek_mobil_id'        => $this->merek,
                'jenis_mobil_id'        => $this->jenis,
                'no_polisi'             => $this->noPolisi,
                'warna'                 => $this->warna,
                'jumlah_penumpang'      => $this->jumlahPenumpang,
                'tahun_mobil'           => $this->tahun,
                'harga_per_hari'        => $this->harga,
                'harga_dengan_supir'    => $this->hargaDenganSupir,
                'kecepatan'             => $this->tenaga,
                'bahan_bakar'           => $this->bahanBakar,
                'ac'                    => $this->ac,
                'foto'                  => $imageName,
            ];
        } else {

            $data = [
                'nama_mobil'            => $this->nama,
                'merek_mobil_id'        => $this->merek,
                'jenis_mobil_id'        => $this->jenis,
                'no_polisi'             => $this->noPolisi,
                'warna'                 => $this->warna,
                'jumlah_penumpang'      => $this->jumlahPenumpang,
                'tahun_mobil'           => $this->tahun,
                'harga_per_hari'        => $this->harga,
                'harga_dengan_supir'    => $this->hargaDenganSupir,
                'kecepatan'             => $this->tenaga,
                'bahan_bakar'           => $this->bahanBakar,
                'ac'                    => $this->ac,
                'foto'                  => $this->oldFoto,
            ];
        }

        Mobil::where('id', $this->mobilId)->update($data);

        session()->flash('success', 'Data mobil berhasil diubah !');

        $this->reset();
        $this->dispatch('close-modal');
        $this->dispatch('close-toast');
    }

    public function setDelete(int $id)
    {
        $data   = Mobil::findOrFail($id);

        if ($data) {
            $this->mobilId  = $data->id;
            $this->oldFoto  = $data->foto;
        }
    }

    public function destroy()
    {
        Storage::disk('upload')->delete('cars/' . $this->oldFoto);

        Mobil::where('id', $this->mobilId)->delete();

        session()->flash('success', 'Data mobil berhasil dihapus !');

        $this->reset();
        $this->dispatch('close-modal');
        $this->dispatch('close-toast');
    }

    public function close()
    {
        $this->reset();
        $this->resetErrorBag();
    }
}
