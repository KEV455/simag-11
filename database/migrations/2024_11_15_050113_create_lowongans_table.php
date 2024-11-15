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
        Schema::create('lowongans', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->nullable(false);
            $table->integer('jumlah_lowongan')->nullable(false);
            $table->text('deskripsi')->nullable(false);
            $table->date('tanggal_dibuka')->nullable(false);
            $table->date('tanggal_ditutup')->nullable(false);
            $table->date('tanggal_magang_dimulai')->nullable(false);
            $table->date('tanggal_ditutup_magang_ditutup')->nullable(false);
            $table->enum('status', ['Aktif', 'Tidak Aktif'])->nullable(false);
            $table->unsignedBigInteger('id_mitra');
            $table->foreign('id_mitra')->references('id')->on('mitras')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lowongans');
    }
};
