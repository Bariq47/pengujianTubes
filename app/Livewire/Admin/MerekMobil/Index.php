<?php

namespace App\Livewire\Admin\MerekMobil;

use App\Models\MerekMobil;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app-layout')]
#[Title('Merek Mobil')]
class Index extends Component
{
    use WithPagination;

    protected $paginationTheme  = 'bootstrap';

    public $merekId;
    public $merek;
    public $keyword;
    public $result  = 10;

    public function render()
    {

        if ($this->keyword != null) {
            $data   = MerekMobil::where('merek_mobil', 'like', '%' . $this->keyword . '%')->orderBy('id', 'DESC')->paginate($this->result);
        } else {
            $data   = MerekMobil::orderBy('id', 'DESC')->paginate($this->result);
        }

        return view('livewire.admin.merek-mobil.index', [
            'data'  => $data
        ]);
    }

    public function rules()
    {
        return [
            'merek' => 'required|string'
        ];
    }

    public function save()
    {
        $this->validate();

        $data = [
            'merek_mobil'   => $this->merek
        ];

        MerekMobil::create($data);

        session()->flash('success', 'Data merek mobil berhasil ditambah !');

        $this->reset();
        $this->dispatch('close-modal');
        $this->dispatch('close-toast');
    }

    public function edit(int $id)
    {
        $data   = MerekMobil::findOrFail($id);

        $this->merekId  = $data->id;
        $this->merek    = $data->merek_mobil;
    }

    public function update()
    {
        $this->validate();

        $data = [
            'merek_mobil'   => $this->merek
        ];

        MerekMobil::where('id', $this->merekId)->update($data);

        session()->flash('success', 'Data merek mobil berhasil diupdate !');

        $this->reset();
        $this->dispatch('close-modal');
        $this->dispatch('close-toast');
    }

    public function setDelete(int $id)
    {
        $this->merekId  = $id;
    }

    public function destroy()
    {
        MerekMobil::where('id', $this->merekId)->delete();

        session()->flash('success', 'Data merek mobil berhasil dihapus !');

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
