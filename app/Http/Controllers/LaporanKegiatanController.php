<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kegiatan;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class LaporanKegiatanController extends Controller
{
    public function export(Request $request)
    {
        $request->validate([
            'tanggal_awal'  => 'required|date',
            'tanggal_akhir' => 'required|date|after_or_equal:tanggal_awal',
        ]);

        $tanggalAwal = Carbon::parse($request->tanggal_awal)->startOfDay();
        $tanggalAkhir = Carbon::parse($request->tanggal_akhir)->endOfDay();

        $kegiatan = Kegiatan::whereBetween('tanggal', [$tanggalAwal, $tanggalAkhir])
                            ->orderBy('tanggal')
                            ->get();

        $judul = 'Laporan Kegiatan '
               . $tanggalAwal->translatedFormat('d F Y')
               . ' - '
               . $tanggalAkhir->translatedFormat('d F Y');

        $pdf = Pdf::loadView('exports.laporan-kegiatan', [
            'data'  => $kegiatan,
            'judul' => $judul,
        ])->setPaper('A4', 'portrait');

        return $pdf->download('laporan-kegiatan.pdf');
    }
}
