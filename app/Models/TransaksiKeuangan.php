<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransaksiKeuangan extends Model
{
   protected $fillable = [
    'jenis',
    'kategori',
    'jumlah',
    'keterangan',
    'tanggal',
    'bukti',
];

}
