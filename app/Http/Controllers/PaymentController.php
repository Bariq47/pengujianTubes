<?php

namespace App\Http\Controllers;

use App\Models\Pengembalian;
use Illuminate\Http\Request;
use App\Models\Pesanan; // Pastikan Anda mengimpor model Pesanan

class PaymentController extends Controller
{
    public function redirectToPayment(Request $request)
    {
        $phoneNumber = '6285731021898';
        $message = urlencode("Saya tertarik untuk menyewa mobil ini segera");

        $whatsappUrl = "https://api.whatsapp.com/send?phone=$phoneNumber&text=$message";

        return redirect($whatsappUrl);
    }

    public function confirmPayment($id)
    {
        // Ambil data pesanan berdasarkan ID
        $pesanan = Pesanan::find($id);

        // Cek apakah data pesanan ditemukan
        if (!$pesanan) {
            return redirect()->route('admin-pesanan')->with('error', 'Pesanan tidak ditemukan.');
        }

        // Ubah status pembayaran
        $pesanan->status_bayar = 'konfirmasi';
        $pesanan->save();


        Pengembalian::create([
            'pesanan_id' => $pesanan->id,
            'tanggal_pengembalian' => $pesanan->tanggal_pengembalian,
            'tanggal_kembali' => now(), // Asumsikan tanggal kembali adalah saat ini
            'telat' => 0, // Asumsikan tidak ada keterlambatan
            'denda' => 0, // Asumsikan tidak ada denda
        ]);

        // Alihkan kembali dengan pesan sukses
        return redirect()->route('admin-pesanan')->with('success', 'Pembayaran berhasil dikonfirmasi.');
    }
}
