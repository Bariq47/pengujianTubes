<?php

namespace App\Livewire\Admin\Pengembalian;

use App\Models\Pengembalian;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.app-layout')]
#[Title('Daftar Pengembalian')]

class Index extends Component
{

    public $result;
    public $keyword;

    public function mount()
    {
        $this->result   = 10;
    }

    public function render()
    {

        if ($this->keyword != null) {
            $data   = Pengembalian::with(['pesanan'])
                ->where('tanggal_kembali', $this->keyword)
                ->orderBy('id', 'DESC')
                ->paginate($this->result);
        } else {
            $data   = Pengembalian::with(['pesanan'])
                ->orderBy('id', 'DESC')
                ->paginate($this->result);
        }

        return view('livewire.admin.pengembalian.index', [
            'data'  => $data,
        ]);
    }
}
