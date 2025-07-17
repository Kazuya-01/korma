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
    Schema::create('anggotas', function (Blueprint $table) {
        $table->id();
        $table->string('nama');
        $table->enum('jabatan', ['ketua', 'wakil', 'sekretaris', 'bendahara', 'anggota']);
        $table->string('kontak')->nullable(); // Bisa nomor HP atau email
        $table->string('foto')->nullable();   // Foto profil (upload)
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anggotas');
    }
};
