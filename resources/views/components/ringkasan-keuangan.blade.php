@php
use App\Models\TransaksiKeuangan;

$totalPemasukan = TransaksiKeuangan::where('jenis', 'pemasukan')->sum('jumlah');
$totalPengeluaran = TransaksiKeuangan::where('jenis', 'pengeluaran')->sum('jumlah');
$saldoAkhir = $totalPemasukan - $totalPengeluaran;

@endphp
<div class="flex gap-3">
    <div class="bg-green-600 text-white px-4 py-2 rounded-lg shadow">
        <div class="text-xs opacity-80">Total Pemasukan</div>
        <div class="text-lg font-bold">Rp {{ number_format($totalPemasukan,0,',','.') }}</div>
    </div>
    <div class="bg-red-600 text-white px-4 py-2 rounded-lg shadow">
        <div class="text-xs opacity-80">Total Pengeluaran</div>
        <div class="text-lg font-bold">Rp {{ number_format($totalPengeluaran,0,',','.') }}</div>
    </div>
    <div class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow">
        <div class="text-xs opacity-80">Saldo Akhir</div>
        <div class="text-lg font-bold">Rp {{ number_format($saldoAkhir,0,',','.') }}</div>
    </div>
</div>

