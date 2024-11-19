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
        Schema::create('pembimbing_magangs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_dosen_pembimbing');
            $table->unsignedBigInteger('id_mahasiswa');
            $table->foreign('id_dosen_pembimbing')->references('id')->on('dosen_pembimbings')->onDelete('cascade');
            $table->foreign('id_mahasiswa')->references('id')->on('mahasiswas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembimbing_magangs');
    }
};
