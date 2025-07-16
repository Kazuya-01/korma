<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    protected $fillable = [
        'nama_kegiatan',
        'deskripsi',
        'tanggal',
        'waktu',
        'lokasi',
        'kategori',
        'terlaksana',
        'foto',
    ];

    protected $casts = [
        'terlaksana' => 'boolean',
        'tanggal' => 'date',
        'waktu' => 'datetime:H:i',
    ];
}
