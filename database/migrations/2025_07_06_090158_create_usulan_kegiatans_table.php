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
    Schema::create('usulan_kegiatans', function (Blueprint $table) {
        $table->id();
        $table->string('nama_kegiatan');
        $table->text('deskripsi')->nullable();
        $table->date('tanggal');
        $table->string('lokasi')->nullable();
        $table->enum('kategori', ['kajian', 'rapat', 'lomba', 'sosial', 'lainnya']);
        $table->enum('status', ['menunggu', 'disetujui', 'ditolak'])->default('menunggu');
        $table->timestamps();
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usulan_kegiatans');
    }
};
