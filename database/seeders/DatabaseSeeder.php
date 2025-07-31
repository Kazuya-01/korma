<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Syarif',
            'email' => 'ketua@korma.test',
            'password' => bcrypt('admin123'),
            'role' => 'ketua',
        ]);

        User::create([
            'name' => 'Imam',
            'email' => 'wakil@korma.test',
            'password' => bcrypt('wakil123'),
            'role' => 'wakil',
        ]);

        User::create([
            'name' => 'Nadia',
            'email' => 'sekretaris@korma.test',
            'password' => bcrypt('sekretaris123'),
            'role' => 'sekretaris',
        ]);

        User::create([
            'name' => 'Fajar',
            'email' => 'bendahara@korma.test',
            'password' => bcrypt('bendahara123'),
            'role' => 'bendahara',
        ]);

        $this->call([
            AnggotaSeeder::class,
            PengaturanSeeder::class,
            KegiatanSeeder::class,
            TransaksiKeuanganSeeder::class,
        ]);
    }
}
