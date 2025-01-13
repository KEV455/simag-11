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
        Schema::create('dpl_lowongans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_dpl_mitra');
            $table->unsignedBigInteger('id_lowongan');
            $table->foreign('id_dpl_mitra')->references('id')->on('dpl_mitras')->onDelete('cascade');
            $table->foreign('id_lowongan')->references('id')->on('lowongans')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dpl_lowongans');
    }
};
