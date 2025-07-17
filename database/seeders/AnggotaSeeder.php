<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Models\Anggota;

class AnggotaSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        $data = [
            [
                'nama' => 'Syarif',
                'jabatan' => 'ketua',
                'kontak' => '081234567890',
                'foto' => null,
                'nomor_anggota' => 'KORMA-001',
            ],
            [
                'nama' => 'Imam',
                'jabatan' => 'wakil',
                'kontak' => '081234567891',
                'foto' => null,
                'nomor_anggota' => 'KORMA-002',
            ],
            [
                'nama' => 'Nadia',
                'jabatan' => 'sekretaris',
                'kontak' => '081234567892',
                'foto' => null,
                'nomor_anggota' => 'KORMA-003',
            ],
            [
                'nama' => 'Fajar',
                'jabatan' => 'bendahara',
                'kontak' => '081234567893',
                'foto' => null,
                'nomor_anggota' => 'KORMA-004',
            ],
            [
                'nama' => 'Dewi Anggraini',
                'jabatan' => 'anggota',
                'kontak' => '081234567894',
                'foto' => null,
                'nomor_anggota' => 'KORMA-005',
            ],
            [
                'nama' => 'Rian Hidayat',
                'jabatan' => 'anggota',
                'kontak' => '081234567895',
                'foto' => null,
                'nomor_anggota' => 'KORMA-006',
            ],
            [
                'nama' => 'Lina Sari',
                'jabatan' => 'anggota',
                'kontak' => '081234567896',
                'foto' => null,
                'nomor_anggota' => 'KORMA-007',
            ],
            [
                'nama' => 'Dedi Firmansyah',
                'jabatan' => 'anggota',
                'kontak' => '081234567897',
                'foto' => null,
                'nomor_anggota' => 'KORMA-008',
            ],
            [
                'nama' => 'Yusuf Maulana',
                'jabatan' => 'anggota',
                'kontak' => '081234567898',
                'foto' => null,
                'nomor_anggota' => 'KORMA-009',
            ],
        ];

        foreach ($data as $anggota) {
            Anggota::create([
                ...$anggota,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }
}
