<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    protected $fillable = ['nama', 'jabatan', 'kontak', 'foto', 'nomor_anggota'];
}
