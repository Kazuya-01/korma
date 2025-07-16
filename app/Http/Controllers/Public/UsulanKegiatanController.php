<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UsulanKegiatan;

class UsulanKegiatanController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tanggal' => 'required|date',
            'lokasi' => 'nullable|string|max:255',
            'kategori' => 'required|in:kajian,rapat,lomba,sosial,lainnya',
            'pengusul' => 'required|string|max:255',
        ]);

        UsulanKegiatan::create([
            ...$validated,
            'status' => 'menunggu',
        ]);

        return redirect()->route('home')->with('success', 'Usulan kegiatan berhasil dikirim!');
    }
}
