<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Mobil extends Model
{
    use HasFactory;

    protected $table    = 'mobil';

    protected $fillable = [
        'nama_mobil',
        'merek_mobil_id',
        'jenis_mobil_id',
        'no_polisi',
        'warna',
        'jumlah_penumpang',
        'tahun_mobil',
        'harga_per_hari',
        'harga_dengan_supir',
        'kecepatan',
        'bahan_bakar',
        'ac',
        'foto',
        'status_mobil'
    ];

    public function merekmobil(): BelongsTo
    {
        return $this->belongsTo(MerekMobil::class, 'merek_mobil_id');
    }

    public function jenismobil(): BelongsTo
    {
        return $this->belongsTo(JenisMobil::class, 'jenis_mobil_id');
    }

    public function pesanan(): HasOne
    {
        return $this->hasOne(Pesanan::class);
    }
}
