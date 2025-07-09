<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kegiatan;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanKegiatanController extends Controller
{
    public function export(Request $request)
    {
        $request->validate([
            'periode' => 'required|in:bulanan',
            'bulan' => 'required|numeric',
            'tahun' => 'required|numeric',
        ]);

        $bulanInt = (int) $request->bulan;

        $kegiatan = Kegiatan::whereYear('tanggal', $request->tahun)
            ->whereMonth('tanggal', $bulanInt)
            ->orderBy('tanggal')
            ->get();

        $judul = 'Laporan Kegiatan Bulan ' . now()->setMonth($bulanInt)->translatedFormat('F') . ' ' . $request->tahun;

        $pdf = Pdf::loadView('exports.laporan-kegiatan', [
            'data' => $kegiatan,
            'judul' => $judul,
        ])->setPaper('A4', 'portrait');

        return $pdf->download('laporan-kegiatan.pdf');
    }
}
