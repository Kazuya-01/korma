<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pengaturan;

class PengaturanSeeder extends Seeder
{
    public function run(): void
    {
        Pengaturan::create([
            'nama_organisasi' => 'KORMA Al Manshuriyah',
            'logo' => null, // Jika belum ada file logonya, bisa diisi null
        ]);
    }
}
