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
        Schema::create('kaprodis', function (Blueprint $table) {
            $table->id();
            $table->date('periode_mulai')->nullable(false);
            $table->date('periode_selesai')->nullable(false);
            $table->enum('status', ['Aktif', 'Tidak Aktif'])->nullable(false);
            $table->unsignedBigInteger('id_prodi');
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_prodi')->references('id')->on('prodis')->onDelete('cascade');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kaprodis');
    }
};
