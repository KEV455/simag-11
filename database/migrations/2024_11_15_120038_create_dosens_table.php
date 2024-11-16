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
        Schema::create('dosens', function (Blueprint $table) {
            $table->id();
            $table->string('nama_dosen')->nullable(false);
            $table->string('email')->nullable(false);
            $table->string('nomor_telp', 15)->nullable(false);
            $table->enum('jenis_kelamin', ['L', 'P'])->nullable(false);
            $table->string('nip', 18)->nullable(false);
            $table->string('nidn', 10)->nullable(false);
            $table->text('alamat')->nullable(true);
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
        Schema::dropIfExists('dosens');
    }
};
