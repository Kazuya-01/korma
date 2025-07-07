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
        Schema::create('kegiatans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kegiatan'); // Nama kegiatan
            $table->text('deskripsi')->nullable(); // Deskripsi kegiatan
            $table->date('tanggal'); // Tanggal kegiatan
            $table->time('waktu'); // Waktu mulai kegiatan
            $table->string('lokasi')->nullable(); // Lokasi kegiatan
            $table->enum('kategori', ['kajian', 'rapat', 'lomba', 'sosial', 'lainnya']); // Kategori kegiatan
            $table->boolean('terlaksana')->default(false); // Status kegiatan: sudah/tidak
            $table->string('dokumentasi')->nullable(); // Dokumentasi: upload/link
            $table->timestamps(); // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kegiatans');
    }
};
