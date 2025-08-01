<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Keuangan</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #333;
            margin: 0 20px;
        }

        h1,
        h2,
        h3 {
            text-align: center;
            margin-bottom: 5px;
            color: #2c3e50;
        }

        .periode {
            text-align: center;
            font-size: 11px;
            margin-bottom: 20px;
            color: #555;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table thead {
            background-color: #2c3e50;
            color: white;
        }

        table,
        th,
        td {
            border: 1px solid #ccc;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        tbody tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        .total {
            background-color: #ecf0f1;
            font-weight: bold;
        }

        .saldo {
            background-color: #27ae60;
            color: white;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <h1>KORMA Al Manshuriyah</h1>
    <h2>Laporan Keuangan</h2>
    <div class="periode">
        Periode: {{ $tanggal_awal }} s/d {{ $tanggal_akhir }}
    </div>

    {{-- Pemasukan --}}
    <h3>Pemasukan</h3>
    @php
        $pemasukan = $transaksi->where('jenis', 'pemasukan');
        $totalPemasukan = $pemasukan->sum('jumlah');
    @endphp
    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Kategori</th>
                <th>Jumlah</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pemasukan as $item)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}</td>
                    <td>{{ $item->kategori }}</td>
                    <td>Rp {{ number_format($item->jumlah, 0, ',', '.') }}</td>
                    <td>{{ $item->keterangan }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="text-align:center;">Tidak ada pemasukan</td>
                </tr>
            @endforelse
            <tr class="total">
                <td colspan="2">Total Pemasukan</td>
                <td colspan="2">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    {{-- Pengeluaran --}}
    <h3>Pengeluaran</h3>
    @php
        $pengeluaran = $transaksi->where('jenis', 'pengeluaran');
        $totalPengeluaran = $pengeluaran->sum('jumlah');
    @endphp
    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Kategori</th>
                <th>Jumlah</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pengeluaran as $item)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}</td>
                    <td>{{ $item->kategori }}</td>
                    <td>Rp {{ number_format($item->jumlah, 0, ',', '.') }}</td>
                    <td>{{ $item->keterangan }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="text-align:center;">Tidak ada pengeluaran</td>
                </tr>
            @endforelse
            <tr class="total">
                <td colspan="2">Total Pengeluaran</td>
                <td colspan="2">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    {{-- Rekap Saldo --}}
    @php
        $saldoAkhir = $totalPemasukan - $totalPengeluaran;
    @endphp
    <h3>Rekap Saldo</h3>
    <table>
        <tr class="total">
            <td>Total Pemasukan</td>
            <td>Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</td>
        </tr>
        <tr class="total">
            <td>Total Pengeluaran</td>
            <td>Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</td>
        </tr>
        <tr class="saldo">
            <td>Saldo Akhir</td>
            <td>Rp {{ number_format($saldoAkhir, 0, ',', '.') }}</td>
        </tr>
    </table>

</body>

</html>
