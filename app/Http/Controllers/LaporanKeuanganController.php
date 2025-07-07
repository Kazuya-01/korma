<?php

namespace App\Http\Controllers;

use App\Models\TransaksiKeuangan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as DomPDF;

class LaporanKeuanganController extends Controller
{
    public function export(Request $request)
    {
        $request->validate([
            'periode' => 'required|in:bulanan,tahunan',
            'tahun' => 'required|numeric',
            'bulan' => 'nullable|numeric',
        ]);

        $query = TransaksiKeuangan::query();

        if ($request->periode === 'bulanan') {
            $query->whereYear('tanggal', $request->tahun)
                  ->whereMonth('tanggal', $request->bulan);
            $judul = 'Laporan Keuangan Bulan ' . now()->setMonth((int) $request->bulan)->translatedFormat('F') . ' ' . $request->tahun;
        } else {
            $query->whereYear('tanggal', $request->tahun);
            $judul = 'Laporan Keuangan Tahun ' . $request->tahun;
        }

        $data = $query->get();

        $pdf = DomPDF::loadView('exports.laporan-keuangan', [
            'judul' => $judul,
            'data' => $data,
        ])->setPaper('A4', 'portrait');

        return $pdf->download('laporan-keuangan.pdf');
    }
}
