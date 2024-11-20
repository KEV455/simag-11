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
        Schema::create('berkas_pelamars', function (Blueprint $table) {
            $table->id();
            $table->string('file', 255)->nullable(false);
            $table->unsignedBigInteger('id_pelamar_magang');
            $table->unsignedBigInteger('id_berkas_lowongan');
            $table->foreign('id_pelamar_magang')->references('id')->on('pelamar_magangs')->onDelete('cascade');
            $table->foreign('id_berkas_lowongan')->references('id')->on('berkas_lowongans')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('berkas_pelamars');
    }
};
