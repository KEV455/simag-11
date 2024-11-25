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
        Schema::create('transkrip_nilai_dpls', function (Blueprint $table) {
            $table->id();
            $table->string('file_transkrip_nilai', 255)->nullable(false);
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
        Schema::dropIfExists('transkrip_nilai_dpls');
    }
};
