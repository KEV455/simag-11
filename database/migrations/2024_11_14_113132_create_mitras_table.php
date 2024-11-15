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
        Schema::create('mitras', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->nullable(false);
            $table->text('alamat')->nullable(false);
            $table->string('kota')->nullable(false);
            $table->string('provinsi')->nullable(false);
            $table->text('website')->nullable(true);
            $table->string('narahubung')->nullable(false);
            $table->string('email')->nullable(false);
            $table->string('foto')->nullable(true);
            $table->enum('status', ['Aktif', 'Tidak Aktif'])->nullable(false);
            $table->text('deskripsi')->nullable(false);
            $table->unsignedBigInteger('id_kategori_bidang');
            $table->foreign('id_kategori_bidang')->references('id')->on('kategori_bidangs')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mitras');
    }
};
