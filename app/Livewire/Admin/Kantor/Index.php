<?php

namespace App\Livewire\Admin\Kantor;

use App\Models\Kantor;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.app-layout')]
#[Title('Kantor')]
class Index extends Component
{
    public $kantorId;
    public $nama;
    public $alamat;
    public $noRek;
    public $noTelp;

    public function render()
    {
        $data   = Kantor::paginate(10);

        return view('livewire.admin.kantor.index', [
            'data'  => $data
        ]);
    }

    public function rules()
    {
        return [
            'nama'      => 'required',
            'alamat'    => 'required',
            'noRek'     => 'required',
            'noTelp'    => 'required'
        ];
    }

    public function save()
    {
        $this->validate();

        $data   = [
            'nama'      => $this->nama,
            'alamat'    => $this->alamat,
            'no_rek'    => $this->noRek,
            'no_telp'   => $this->noTelp
        ];

        Kantor::create($data);

        session()->flash('success', 'Data berhasil ditambahkan !');

        $this->close();
    }

    public function edit(int $id)
    {
        $data           = Kantor::findOrFail($id);

        $this->kantorId = $data->id;
        $this->nama     = $data->nama;
        $this->alamat   = $data->alamat;
        $this->noRek    = $data->no_rek;
        $this->noTelp   = $data->no_telp;
    }

    public function update()
    {
        $this->validate();

        $data   = [
            'nama'      => $this->nama,
            'alamat'    => $this->alamat,
            'no_rek'    => $this->noRek,
            'no_telp'   => $this->noTelp
        ];

        Kantor::where('id', $this->kantorId)->update($data);

        session()->flash('success', 'Data berhasil diupdate !');

        $this->close();
    }

    public function setDelete(int $id)
    {
        $this->kantorId = $id;
    }

    public function destroy()
    {
        Kantor::where('id', $this->kantorId)->delete();

        session()->flash('success', 'Data berhasil dihapus !');

        $this->close();
    }

    public function close()
    {
        $this->resetErrorBag();
        $this->reset();
        $this->dispatch('close-modal');
        $this->dispatch('close-toast');
    }
}
