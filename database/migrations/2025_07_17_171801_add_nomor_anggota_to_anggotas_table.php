<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('anggotas', function (Blueprint $table) {
            $table->string('nomor_anggota')->unique()->after('nama');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('anggotas', function (Blueprint $table) {
            $table->dropColumn('nomor_anggota');
        });
    }
};
