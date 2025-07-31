<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kegiatan;
use Carbon\Carbon;

class KegiatanSeeder extends Seeder
{
    public function run(): void
    {
        $kategoriList = [
            'kajian' => [
                'Kajian Tafsir Al-Qur\'an',
                'Kajian Fiqih Ibadah',
                'Kajian Akhlak Remaja',
                'Kajian Hadits Arbain',
                'Kajian Tematik Malam Jumat'
            ],
            'rapat' => [
                'Rapat Bulanan Pengurus',
                'Rapat Persiapan Event Besar',
                'Rapat Evaluasi Program',
                'Rapat Koordinasi Divisi',
                'Rapat Anggaran Tahunan'
            ],
            'lomba' => [
                'Lomba Adzan',
                'Lomba MTQ',
                'Lomba Kaligrafi',
                'Lomba Cerdas Cermat Islami',
                'Lomba Hafalan Surat Pendek'
            ],
            'sosial' => [
                'Bakti Sosial Santunan Yatim',
                'Gotong Royong Bersama',
                'Donor Darah',
                'Bagi-Bagi Takjil',
                'Penggalangan Dana Bencana'
            ],
            'lainnya' => [
                'Pelatihan Multimedia',
                'Workshop Public Speaking',
                'Kunjungan Masjid Tetangga',
                'Outbound Remaja Masjid',
                'Camping Ukhuwah'
            ]
        ];

        for ($i = 1; $i <= 20; $i++) {
            // Pilih kategori random
            $kategori = array_rand($kategoriList);

            // Pilih nama kegiatan dari kategori tersebut
            $namaKegiatan = $kategoriList[$kategori][array_rand($kategoriList[$kategori])];

            // Waktu random antara jam 07:00 sampai 20:30
            $jam = rand(7, 20);
            $menit = rand(0, 1) ? 0 : 30; // pilih 00 atau 30 menit

            Kegiatan::create([
                'nama_kegiatan' => $namaKegiatan,
                'deskripsi'     => 'Deskripsi untuk ' . strtolower($namaKegiatan),
                'tanggal'       => Carbon::now()->addDays($i),
                'waktu'         => Carbon::createFromTime($jam, $menit),
                'lokasi'        => 'Masjid Al Manshuriyah',
                'kategori'      => $kategori,
                'foto'          => null,
                'terlaksana'    => false,
            ]);
        }
    }
}
