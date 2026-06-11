<?php

namespace App\Livewire\Home;

use App\Models\JenisMobil;
use App\Models\Kantor;
use App\Models\MerekMobil;
use App\Models\Mobil;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.home-layout')]
#[Title('Home')]
class Index extends Component
{

    public $filterJenis;
    public $filterMerek;

    public function render()
    {

        if ($this->filterJenis != null && $this->filterMerek != null) {
            $data   = Mobil::with(['jenismobil', 'merekmobil'])
                ->where('jenis_mobil_id', $this->filterJenis)
                ->where('merek_mobil_id', $this->filterMerek)
                ->orderBy('id', 'DESC')
                ->get();
        } else if ($this->filterJenis != null || $this->filterMerek != null) {
            $data   = Mobil::with(['jenismobil', 'merekmobil'])
                ->where('jenis_mobil_id', $this->filterJenis)
                ->orWhere('jenis_mobil_id', $this->filterJenis)
                ->where('merek_mobil_id', $this->filterMerek)
                ->orWhere('merek_mobil_id', $this->filterMerek)
                ->orderBy('id', 'DESC')
                ->get();
        } else {
            $data   = Mobil::with(['jenismobil', 'merekmobil'])->orderBy('id', 'DESC')->limit(8)->get();
        }

        $jenisMobil = JenisMobil::all();
        $merekMobil = MerekMobil::all();
        $kantor     = Kantor::first();

        return view('livewire.home.index', [
            'data'          => $data,
            'jenisMobil'    => $jenisMobil,
            'merekMobil'    => $merekMobil,
            'kantor'        => $kantor
        ]);
    }

    public function filter()
    {
        $this->dispatch('close-modal');
    }
}
