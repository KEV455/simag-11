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
        Schema::create('logbooks', function (Blueprint $table) {
            $table->id();
            $table->string('judul_kegiatan', 255)->nullable(false);
            $table->enum('status_kehadiran', ['hadir', 'alpa', 'tidak ada keterangan'])->nullable(false);
            $table->string('dokumentasi_kegiatan', 255)->nullable(false);
            $table->text('deskripsi_kegiatan')->nullable(false);
            $table->date('tanggal_kegiatan')->nullable(false);
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
        Schema::dropIfExists('logbooks');
    }
};
