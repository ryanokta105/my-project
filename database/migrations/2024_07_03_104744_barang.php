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
        Schema::create('barang', function (Blueprint $table) {
            $table->string('kode_barang')->primary();
            $table->string('merek_barang');
            $table->string('gambar');
            $table->string('tipe');
            $table->string('tahun');
            $table->string('kode_kategori');
            $table->timestamps();

            // Menambahkan foreign key constraint
            $table->foreign('kode_kategori')->references('kode_kategori')->on('kategori')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang');
    }
};
