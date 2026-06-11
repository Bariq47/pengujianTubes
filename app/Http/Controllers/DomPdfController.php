<?php

namespace App\Http\Controllers;

use App\Models\Kantor;
use App\Models\Pesanan;
use Barryvdh\DomPDF\Facade\Pdf;

class DomPdfController extends Controller
{
    public function pdf(int $id)
    {

        $data   = Pesanan::with(['mobil', 'profile', 'driver'])->findOrFail($id);
        $kantor = Kantor::all();

        $pdf = Pdf::loadView('pdf.index', [
            'data'      => $data,
            'kantor'    => $kantor[0],
        ]);
        $pdf->setPaper('A4', 'portrait');
        return $pdf->stream('transaksi-' . $id . '.pdf');
    }
}
