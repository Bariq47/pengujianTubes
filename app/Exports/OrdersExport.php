<?php

namespace App\Exports;

use App\Models\Pesanan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class OrdersExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Pesanan::all();
    }

    public function headings(): array
    {
        return [
            'Mobil',
            'Nama Pemesan',
            'Tgl Pesan',
            'Tgl Kembali',
            'Total Bayar',
            'Status',
        ];
    }

    public function map($pesanan): array
    {
        return [
            $pesanan->mobil->nama_mobil,
            $pesanan->profile->nama,
            $pesanan->tanggal_pemesanan,
            $pesanan->tanggal_pengembalian,
            'Rp. ' . number_format($pesanan->total_bayar, 0, ',', '.'),
            $pesanan->status_bayar,
        ];
    }
}
