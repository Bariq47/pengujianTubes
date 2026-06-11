<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mobil', function (Blueprint $table) {
            $table->id();
            $table->string('nama_mobil');
            $table->unsignedBigInteger('merek_mobil_id');
            $table->foreign('merek_mobil_id')->references('id')->on('merek_mobil');
            $table->unsignedBigInteger('jenis_mobil_id');
            $table->foreign('jenis_mobil_id')->references('id')->on('jenis_mobil');
            $table->string('no_polisi')->unique();
            $table->string('warna');
            $table->integer('jumlah_penumpang');
            $table->string('tahun_mobil', 4);
            $table->integer('harga_per_hari');
            $table->string('foto');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mobil');
    }
};
