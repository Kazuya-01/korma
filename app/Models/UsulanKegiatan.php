<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsulanKegiatan extends Model
{
    public function anggota()
{
    return $this->belongsTo(Anggota::class, 'nomor_anggota', 'nomor_anggota');
}
    protected $fillable = [
    'nama_kegiatan',
    'deskripsi',
    'tanggal',
    'lokasi',
    'waktu',
    'kategori',
    'status',
    'pengusul',
    'nomor_anggota',
];

}
