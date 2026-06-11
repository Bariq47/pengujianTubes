<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class MerekMobil extends Model
{
    use HasFactory;

    protected $table    = 'merek_mobil';

    protected $fillable = ['merek_mobil'];

    public function mobil(): HasOne
    {
        return $this->hasOne(Mobil::class);
    }
}
