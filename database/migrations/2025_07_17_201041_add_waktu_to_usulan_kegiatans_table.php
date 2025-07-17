<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('usulan_kegiatans', function (Blueprint $table) {
            $table->time('waktu')->after('tanggal')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('usulan_kegiatans', function (Blueprint $table) {
            $table->dropColumn('waktu');
        });
    }
};
