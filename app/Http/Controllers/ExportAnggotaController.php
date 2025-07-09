<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\AnggotaExport;

class ExportAnggotaController extends Controller
{
    public function excel()
    {
        return Excel::download(new AnggotaExport, 'anggota.xlsx');
    }

    public function pdf()
    {
        $data = Anggota::all();
        $pdf = Pdf::loadView('exports.anggota-pdf', compact('data'));
        return $pdf->download('anggota.pdf');
    }
}

