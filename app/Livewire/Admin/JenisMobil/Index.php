<?php

namespace App\Livewire\Admin\JenisMobil;

use App\Models\JenisMobil;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app-layout')]
#[Title('Jenis Mobil')]
class Index extends Component
{
    use WithPagination;
    protected $paginationTheme  = 'bootstrap';

    public $jenisId;
    public $jenis;
    public $keyword;
    public $result  = 10;

    public function render()
    {

        if ($this->keyword != null) {
            $data   = JenisMobil::where('jenis_mobil', 'like', '%' . $this->keyword . '%')->orderBy('id', 'DESC')->paginate($this->result);
        } else {
            $data   = JenisMobil::orderBy('id', 'DESC')->paginate($this->result);
        }

        return view('livewire.admin.jenis-mobil.index', [
            'data'   => $data
        ]);
    }

    public function rules()
    {
        return [
            'jenis' => 'required|string'
        ];
    }

    public function save()
    {
        $this->validate();

        $data = [
            'jenis_mobil'   => $this->jenis
        ];

        JenisMobil::create($data);

        session()->flash('success', 'Data jenis mobil berhasil ditambahkan !');

        $this->reset();
        $this->dispatch('close-modal');
        $this->dispatch('close-toast');
    }

    public function edit(int $id)
    {
        $data           = JenisMobil::findOrFail($id);

        $this->jenisId  = $data->id;
        $this->jenis    = $data->jenis_mobil;
    }

    public function update()
    {
        $this->validate();

        $data   = [
            'jenis_mobil'   => $this->jenis
        ];

        JenisMobil::where('id', $this->jenisId)->update($data);

        session()->flash('success', 'Data jenis mobil berhasil diupdate !');

        $this->reset();
        $this->dispatch('close-modal');
        $this->dispatch('close-toast');
    }

    public function setDelete(int $id)
    {
        $this->jenisId  = $id;
    }

    public function destroy()
    {
        JenisMobil::where('id', $this->jenisId)->delete();

        session()->flash('success', 'Data jenis mobil berhasil dihapus !');

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
