<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class JenisMobil extends Model
{
    use HasFactory;

    protected $table    = 'jenis_mobil';

    protected $fillable = ['jenis_mobil'];

    public function mobil(): HasOne
    {
        return $this->hasOne(Mobil::class);
    }
}
