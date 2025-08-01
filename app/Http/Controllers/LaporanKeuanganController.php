<?php

namespace App\Http\Controllers;

use App\Models\TransaksiKeuangan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Carbon\Carbon;


class LaporanKeuanganController extends Controller
{
    public function export(Request $request)
    {
        $query = TransaksiKeuangan::query();

        // Filter tanggal
        if ($request->filled('tanggal_awal')) {
            $query->whereDate('tanggal', '>=', $request->tanggal_awal);
        }
        if ($request->filled('tanggal_akhir')) {
            $query->whereDate('tanggal', '<=', $request->tanggal_akhir);
        }

        // Filter jenis
        if ($request->jenis !== 'semua') {
            $query->where('jenis', $request->jenis);
        }

        $transaksi = $query->orderBy('tanggal')->get();

        $pdf = Pdf::loadView('exports.laporan-keuangan', [
            'transaksi' => $transaksi,
            'tanggal_awal' => $request->tanggal_awal,
            'tanggal_akhir' => $request->tanggal_akhir,
            'jenis' => $request->jenis,
        ]);

        return $pdf->download($request->file ?? 'laporan-keuangan.pdf');
    }
}
