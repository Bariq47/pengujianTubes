<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Pesanan extends Model
{
    use HasFactory;

    protected $table    = 'pesanan';

    protected $fillable = [
        'profile_id',
        'mobil_id',
        'supir',
        'supir_id',
        'tanggal_pemesanan',
        'tanggal_pengembalian',
        'total_harga',
        'status_bayar',
        'jumlah_hari',
        'total_bayar',
        'keterangan'
    ];

    public function profile(): BelongsTo
    {
        return $this->belongsTo(Profile::class, 'profile_id');
    }

    public function mobil(): BelongsTo
    {
        return $this->belongsTo(Mobil::class, 'mobil_id');
    }

    public function driver(): BelongsTo
    {
        return $this->belongsTo(Supir::class, 'supir_id');
    }

    public function transaksipembayaran(): HasOne
    {
        return $this->hasOne(TransaksiPembayaran::class);
    }

    public function pengembalian(): HasOne
    {
        return $this->hasOne(Pengembalian::class);
    }
    public function konfirmasiPembayaran($id)
    {
        $pesanan = Pesanan::findOrFail($id);
        $pesanan->status_bayar = 'paid';
        $pesanan->save();

        return redirect()->back()->with('success', 'Pembayaran berhasil dikonfirmasi.');
    }
}
