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
        Schema::create('dpl_mitras', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->nullable(false);
            $table->date('tanggal_lahir')->nullable(false);
            $table->string('email')->nullable(false);
            $table->string('nomor_telp', 15)->nullable(false);
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
        Schema::dropIfExists('dpl_mitras');
    }
};
