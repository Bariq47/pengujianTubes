<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Supir extends Model
{
    use HasFactory;

    protected $table    = 'supir';

    protected $fillable = [
        'nama', 'no_ktp', 'jenis_kelamin', 'no_telp', 'alamat', 'foto'
    ];

    public function pesanan(): HasOne
    {
        return $this->hasOne(Pesanan::class);
    }
}
