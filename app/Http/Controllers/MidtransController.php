<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use App\Models\Pesanan;
use App\Models\Supir;
use Illuminate\Http\Request;

class MidtransController extends Controller
{
    public function callback(Request $request)
    {
        // $serverKey  = config('midtrans.server_key');
        // $hashed     = hash('sha512', $request->input('order_id') . $request->input('status_code') . $request->input('gross_amount') . $serverKey);

        // if ($hashed == $request->input('signature_key')) {

        if ($request->input('transaction_status') == 'capture' or $request->input('transaction_status') == 'settlement') {
            $pesanan    = Pesanan::findOrFail($request->input('order_id'));
            $pesanan->update([
                'status_bayar'  => 'paid',
                'keterangan'    => 'Terima kasih sudah menggunakan jasa kami !.'
            ]);

            session()->flash('success', 'pembayaran berhail !.');

            return redirect()->route('member-pesanan-detail', ['id' => $request->input('order_id')]);
        }

        if ($request->input('transaction_status') == 'deny' or $request->input('transaction_status') == 'failure') {
            $pesanan    = Pesanan::findOrFail($request->input('order_id'));
            $mobil      = Mobil::findOrFail($pesanan->mobil_id);

            $pesanan->update([
                'status_bayar'  => 'unpaid',
                'keterangan'    => 'Terjadi kelasahan pada proses pembayaran !. '
            ]);

            $mobil->update([
                'status_mobil'  => 0
            ]);

            if ($pesanan->supir_id != null) {
                $supir      = Supir::findOrFail($pesanan->supir_id);

                $supir->update([
                    'status_supir'  => 0
                ]);
            }


            session()->flash('error', 'terjadi kesalahan pada proses pembayaran !.');

            return redirect()->route('member-pesanan-detail', ['id' => $request->input('order_id')]);
        }

        if ($request->input('transaction_status') == 'expire') {
            $pesanan    = Pesanan::findOrFail($request->input('order_id'));
            $mobil      = Mobil::findOrFail($pesanan->mobil_id);

            $pesanan->update([
                'status_bayar'  => 'unpaid',
                'keterangan'    => 'Token pembayaran kadaluarsa !.'
            ]);

            $mobil->update([
                'status_mobil'  => 0
            ]);

            if ($pesanan->supir_id != null) {
                $supir      = Supir::findOrFail($pesanan->supir_id);

                $supir->update([
                    'status_supir'  => 0
                ]);
            }


            session()->flash('error', 'token pembayaran kadaluarsa !.');

            return redirect()->route('member-pesanan-detail', ['id' => $request->input('order_id')]);
        }
        // }
    }
}
