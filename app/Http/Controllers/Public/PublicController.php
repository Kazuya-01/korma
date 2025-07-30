<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
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

}
