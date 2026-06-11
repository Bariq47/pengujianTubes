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
        Schema::table('pesanan', function (Blueprint $table) {
            $table->string('status_bayar')->after('total_harga');
            $table->integer('jumlah_hari')->after('status_bayar');
            $table->integer('total_bayar')->after('jumlah_hari');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pesanan', function (Blueprint $table) {
            $table->dropColumn('status_bayar');
            $table->dropColumn('jumlah_hari');
            $table->dropColumn('total_bayar');
        });
    }
};
