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
        Schema::create('nilai_magangs', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('nilai_angka')->nullable(false);
            $table->string('nilai_huruf', 4)->nullable(false);
            $table->enum('validasi', ['Setuju', 'Tidak Setuju', 'Belum Divalidasi'])->nullable(false);
            $table->unsignedBigInteger('id_peserta_magang');
            $table->unsignedBigInteger('id_laporan_akhir_magang');
            $table->unsignedBigInteger('id_transkrip_nilai_dpl');
            $table->foreign('id_peserta_magang')->references('id')->on('peserta_magangs')->onDelete('cascade');
            $table->foreign('id_laporan_akhir_magang')->references('id')->on('laporan_akhir_magangs')->onDelete('cascade');
            $table->foreign('id_transkrip_nilai_dpl')->references('id')->on('transkrip_nilai_dpls')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilai_magangs');
    }
};
