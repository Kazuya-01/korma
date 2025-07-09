<?php

namespace App\Exports;

use App\Models\Anggota;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AnggotaExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Anggota::all();
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama',
            'Jabatan',
            'Kontak',
        ];
    }

    public function map($anggota): array
    {
        static $no = 0;
        return [
            ++$no,
            $anggota->nama,
            $anggota->jabatan,
            $anggota->kontak,
        ];
    }
}

