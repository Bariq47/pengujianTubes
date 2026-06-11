<?php

namespace App\Livewire\Admin\Supir;

use App\Models\Supir;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

#[Layout('layouts.app-layout')]
#[Title('Data Supir')]
class Index extends Component
{

    use WithPagination;
    use WithFileUploads;

    public $keyword;
    public $result  = 10;

    public $supirId;
    public $nama;
    public $noKtp;
    public $jenisKelamin;
    public $noTelp;
    public $alamat;
    public $foto;
    public $oldFoto;

    public function render()
    {

        if ($this->keyword !== null) {
            $data   = Supir::where('nama', 'like', '%' . $this->keyword . '%')
                ->orWhere('no_ktp', 'like', '%' . $this->keyword . '%')
                ->orWhere('jenis_kelamin', 'like', '%' . $this->keyword . '%')
                ->orderBy('id', 'DESC')
                ->paginate($this->result);
        } else {
            $data   = Supir::orderBy('id', 'DESC')->paginate($this->result);
        }

        return view('livewire.admin.supir.index', [
            'data'  => $data
        ]);
    }

    public function save()
    {
        $this->validate([
            'nama'          => 'required|string',
            'noKtp'         => 'required|numeric|unique:supir,no_ktp',
            'jenisKelamin'  => 'required|string',
            'noTelp'        => 'required|numeric',
            'alamat'        => 'required|string',
            'foto'          => 'required|image'
        ]);

        $imageName  = time() . '.' . $this->foto->extension();
        $this->foto->storeAs('supir', $imageName, ['disk' => 'upload']);

        $data   = [
            'nama'          => $this->nama,
            'no_ktp'        => $this->noKtp,
            'jenis_kelamin' => $this->jenisKelamin,
            'no_telp'       => $this->noTelp,
            'alamat'        => $this->alamat,
            'foto'          => $imageName
        ];

        Supir::create($data);

        session()->flash('success', 'Data supir berhasil ditambah !');

        $this->reset();
        $this->dispatch('close-modal');
        $this->dispatch('close-toast');
    }

    public function edit(int $id)
    {
        $data               = Supir::findOrFail($id);

        $this->supirId      = $data->id;
        $this->nama         = $data->nama;
        $this->noKtp        = $data->no_ktp;
        $this->jenisKelamin = $data->jenis_kelamin;
        $this->noTelp       = $data->no_telp;
        $this->alamat       = $data->alamat;
        $this->oldFoto      = $data->foto;
    }

    public function update()
    {
        $this->validate([
            'nama'          => 'required|string',
            'noKtp'         => 'required|numeric',
            'jenisKelamin'  => 'required|string',
            'noTelp'        => 'required|numeric',
            'alamat'        => 'required|string',
        ]);

        if ($this->foto != null) {

            $imageName  = time() . '.' . $this->foto->extension();
            $this->foto->storeAs('supir', $imageName, ['disk' => 'upload']);

            Storage::disk('upload')->delete('supir/' . $this->oldFoto);

            $data   = [
                'nama'          => $this->nama,
                'no_ktp'        => $this->noKtp,
                'jenis_kelamin' => $this->jenisKelamin,
                'no_telp'       => $this->noTelp,
                'alamat'        => $this->alamat,
                'foto'          => $imageName
            ];
        } else {
            $data   = [
                'nama'          => $this->nama,
                'no_ktp'        => $this->noKtp,
                'jenis_kelamin' => $this->jenisKelamin,
                'no_telp'       => $this->noTelp,
                'alamat'        => $this->alamat,
                'foto'          => $this->oldFoto
            ];
        }

        Supir::where('id', $this->supirId)->update($data);

        session()->flash('success', 'Data supir berhasil diupdate !');

        $this->reset();
        $this->dispatch('close-modal');
        $this->dispatch('close-toast');
    }

    public function setDelete(int $id)
    {
        $data   = Supir::findOrFail($id);

        $this->supirId  = $data->id;
        $this->oldFoto  = $data->foto;
    }

    public function destroy()
    {
        Storage::disk('upload')->delete('supir/' . $this->oldFoto);

        Supir::where('id', $this->supirId)->delete();

        session()->flash('success', 'Data supir berhasil dihapus !');

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
