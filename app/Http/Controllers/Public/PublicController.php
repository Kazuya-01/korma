<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use App\Models\TransaksiKeuangan;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PublicController extends Controller
{

    public function index()
    {
        $events = Kegiatan::all()->map(function ($kegiatan) {
            return [
                'title' => $kegiatan->nama_kegiatan,
                'start' => \Carbon\Carbon::parse($kegiatan->tanggal)->format('Y-m-d')
                    . 'T' . \Carbon\Carbon::parse($kegiatan->waktu)->format('H:i'),
                'lokasi' => $kegiatan->lokasi,
                'deskripsi' => $kegiatan->deskripsi,
                'color' => match ($kegiatan->kategori) {
                    'kajian' => '#28a745',
                    'rapat' => '#007bff',
                    'lomba' => '#ffc107',
                    'sosial' => '#dc3545',
                    default => '#6c757d',
                }
            ];
        });

        return view('public.home', [
            'events' => $events,
        ]);
    }

    public function home()
    {
        $bulanIni = now()->month;
        $tahunIni = now()->year;

        $totalPemasukan = TransaksiKeuangan::where('jenis', 'pemasukan')->sum('jumlah');
        $totalPengeluaran = TransaksiKeuangan::where('jenis', 'pengeluaran')->sum('jumlah');
        $saldoKas = $totalPemasukan - $totalPengeluaran;

        $pemasukanBulanIni = TransaksiKeuangan::where('jenis', 'pemasukan')
            ->whereYear('tanggal', $tahunIni)
            ->whereMonth('tanggal', $bulanIni)
            ->sum('jumlah');

        $pengeluaranBulanIni = TransaksiKeuangan::where('jenis', 'pengeluaran')
            ->whereYear('tanggal', $tahunIni)
            ->whereMonth('tanggal', $bulanIni)
            ->sum('jumlah');

        $events = Kegiatan::select('nama_kegiatan as title', 'tanggal as start')->get();

        return view('public.home', compact(
            'saldoKas',
            'pemasukanBulanIni',
            'pengeluaranBulanIni',
            'events'
        ));
    }

    public function unduh()
    {
        $transaksi = TransaksiKeuangan::orderBy('tanggal', 'desc')->get();

        $totalPemasukan = $transaksi->where('jenis', 'pemasukan')->sum('jumlah');
        $totalPengeluaran = $transaksi->where('jenis', 'pengeluaran')->sum('jumlah');
        $saldoKas = $totalPemasukan - $totalPengeluaran;

        $pdf = Pdf::loadView('exports.laporan-keuangan-publik', compact(
            'transaksi',
            'totalPemasukan',
            'totalPengeluaran',
            'saldoKas'
        ));

        return $pdf->download('Laporan_Keuangan_KORMA.pdf');
    }
}
