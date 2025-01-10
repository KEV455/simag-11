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
        Schema::create('kriteria_penilaian_mitras', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_mitra');
            $table->unsignedBigInteger('id_kriteria_penilaian');
            $table->foreign('id_mitra')->references('id')->on('mitras')->onDelete('cascade');
            $table->foreign('id_kriteria_penilaian')->references('id')->on('kriteria_penilaians')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kriteria_penilaian_mitras');
    }
};
