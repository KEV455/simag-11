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
        Schema::create('laporan_akhir_magangs', function (Blueprint $table) {
            $table->id();
            $table->string('file_laporan_akhir', 255)->nullable(false);
            $table->unsignedBigInteger('id_peserta_magang');
            $table->foreign('id_peserta_magang')->references('id')->on('peserta_magangs')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_akhir_magangs');
    }
};
