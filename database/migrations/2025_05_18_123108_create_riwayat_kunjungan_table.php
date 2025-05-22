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
        Schema::create('riwayat_kunjungan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pasien_id')->references('id')->on('pasien');
            $table->foreignId('dokter_id')->references('id')->on('datadokter');
            $table->foreignId('poli_id')->references('id')->on('datapoli');
            $table->date('tanggal');
            $table->text('diagnosa');
            $table->text('tindakan');
            $table->text('obat');
            $table->decimal('biaya', 10,2)->nullable;

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_kunjungan');
    }
};
