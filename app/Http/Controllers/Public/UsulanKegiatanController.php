<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UsulanKegiatan;
use App\Models\Anggota;

class UsulanKegiatanController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tanggal' => 'required|date',
            'waktu' => 'required|date_format:H:i',
            'lokasi' => 'nullable|string|max:255',
            'kategori' => 'required|in:kajian,rapat,lomba,sosial,lainnya',
            'pengusul' => 'required|string|max:255',
            'nomor_anggota' => 'required|string|max:50',
        ]);

        // ✨ Normalisasi nama pengusul agar huruf besar-kecil konsisten
        $validated['pengusul'] = ucwords(strtolower($validated['pengusul']));

        // ✅ Pengecekan case-insensitive
        $anggota = Anggota::whereRaw('LOWER(nama) = ?', [strtolower($validated['pengusul'])])
            ->where('nomor_anggota', $validated['nomor_anggota'])
            ->first();

        if (!$anggota) {
            return back()->withErrors([
                'nomor_anggota' => 'Nomor anggota tidak valid atau tidak terdaftar.',
            ])->withInput();
        }

        // Simpan usulan
        UsulanKegiatan::create([
            'nama_kegiatan' => $validated['nama_kegiatan'],
            'deskripsi'     => $validated['deskripsi'],
            'tanggal'       => $validated['tanggal'],
            'waktu'         => $validated['waktu'],
            'lokasi'        => $validated['lokasi'],
            'kategori'      => $validated['kategori'],
            'pengusul'      => $validated['pengusul'],
            'nomor_anggota' => $validated['nomor_anggota'],
            'status'        => 'menunggu',
        ]);
        return redirect()->route('home')->with('success', 'Usulan kegiatan berhasil dikirim!');
    }
}
