<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use Illuminate\Http\Request;

class PublicController extends Controller
{

    public function home(Request $request)
    {
        $query = Kegiatan::query();

        if ($request->filled('bulan')) {
            $query->whereMonth('tanggal', $request->bulan);
        }

        if ($request->filled('tahun')) {
            $query->whereYear('tanggal', $request->tahun);
        }

        // Tampilkan mulai dari hari ini ke atas
        $query->whereDate('tanggal', '>=', now());

        // Ambil 5 data per halaman + simpan query filter-nya
        $kegiatan = $query->orderBy('tanggal')->paginate(5)->withQueryString();

        return view('public.home', compact('kegiatan'));
    }
}
