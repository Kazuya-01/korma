<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TransaksiKeuangan;
use Carbon\Carbon;

class TransaksiKeuanganSeeder extends Seeder
{
    public function run(): void
    {
        $kategoriList = ['kas', 'infaq', 'donasi', 'operasional', 'lainnya'];

        // Bikin 6 pemasukan
        for ($i = 0; $i < 6; $i++) {
            TransaksiKeuangan::create([
                'jenis'     => 'pemasukan',
                'kategori'  => $kategoriList[array_rand($kategoriList)],
                'jumlah'    => rand(1_000_000, 5_000_000), // lebih besar
                'tanggal'   => Carbon::now()->subDays(rand(0, 180)),
                'bukti'     => null,
            ]);
        }

        // Bikin 4 pengeluaran
        for ($i = 0; $i < 4; $i++) {
            TransaksiKeuangan::create([
                'jenis'     => 'pengeluaran',
                'kategori'  => $kategoriList[array_rand($kategoriList)],
                'jumlah'    => rand(100_000, 2_000_000), // lebih kecil
                'tanggal'   => Carbon::now()->subDays(rand(0, 180)),
                'bukti'     => null,
            ]);
        }
    }
}
