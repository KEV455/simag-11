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
        Schema::create('mitra_mandiris', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->nullable(false);
            $table->text('alamat')->nullable(false);
            $table->string('kota')->nullable(false);
            $table->string('provinsi')->nullable(false);
            $table->string('narahubung')->nullable(false);
            $table->string('email')->nullable(false);
            $table->enum('status_disetujui', ['Menunggu Persetujuan', 'Ditolak', 'Diterima'])->nullable(false);
            $table->unsignedBigInteger('id_mahasiswa');
            $table->foreign('id_mahasiswa')->references('id')->on('mahasiswas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mitra_mandiris');
    }
};
