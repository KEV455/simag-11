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
        Schema::create('nilai_dpls', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('nilai')->nullable(false);
            $table->unsignedBigInteger('id_mahasiswa');
            $table->unsignedBigInteger('id_lowongan');
            $table->unsignedBigInteger('id_dpl_mitra');
            $table->unsignedBigInteger('id_kriteria_penilaian');
            $table->foreign('id_mahasiswa')->references('id')->on('mahasiswas')->onDelete('cascade');
            $table->foreign('id_lowongan')->references('id')->on('lowongans')->onDelete('cascade');
            $table->foreign('id_dpl_mitra')->references('id')->on('dpl_mitras')->onDelete('cascade');
            $table->foreign('id_kriteria_penilaian')->references('id')->on('kriteria_penilaians')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilai_dpls');
    }
};
