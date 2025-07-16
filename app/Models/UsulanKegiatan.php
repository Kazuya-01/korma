<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsulanKegiatan extends Model
{
    protected $fillable = [
    'nama_kegiatan',
    'deskripsi',
    'tanggal',
    'lokasi',
    'kategori',
    'status',
    'pengusul',
];

}
