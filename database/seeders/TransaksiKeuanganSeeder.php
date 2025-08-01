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
        $keteranganList = [
            'Kas rutin bulan ini',
            'Donasi sosial remaja masjid',
            'Infaq kegiatan dakwah',
            'Operasional perlengkapan masjid',
            'Pembelian alat kebersihan masjid',
            'Santunan anak yatim',
            'Pengeluaran acara Maulid',
            'Pemasukan hasil bazar Ramadhan',
            'Pengeluaran lomba MTQ',
            'Pemasukan donatur tetap',
        ];

        // 15 pemasukan
        for ($i = 0; $i < 15; $i++) {
            TransaksiKeuangan::create([
                'jenis'     => 'pemasukan',
                'kategori'  => $kategoriList[array_rand($kategoriList)],
                'jumlah'    => rand(1, 50) * 100000, // Rp 100 ribu - 5 juta
                'tanggal'   => Carbon::now()->subDays(rand(0, 30)),
                'keterangan'=> $keteranganList[array_rand($keteranganList)],
                'bukti'     => null,
            ]);
        }

        // 10 pengeluaran
        for ($i = 0; $i < 10; $i++) {
            TransaksiKeuangan::create([
                'jenis'     => 'pengeluaran',
                'kategori'  => $kategoriList[array_rand($kategoriList)],
                'jumlah'    => rand(1, 20) * 100000, // Rp 100 ribu - 2 juta
                'tanggal'   => Carbon::now()->subDays(rand(0, 30)),
                'keterangan'=> $keteranganList[array_rand($keteranganList)],
                'bukti'     => null,
            ]);
        }
    }
}
