<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Keuangan KORMA</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            margin: 20px;
            color: #333;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #333;
            padding-bottom: 5px;
            margin-bottom: 15px;
        }

        .title {
            margin: 0;
            font-size: 18px;
            font-weight: bold;
        }

        .subtitle {
            margin: 0;
            font-size: 14px;
        }

        h3.section {
            margin-top: 20px;
            margin-bottom: 5px;
            text-align: left;
            font-size: 14px;
            border-left: 4px solid #4CAF50;
            padding-left: 6px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
            font-size: 11px;
        }

        table th {
            background-color: #f0f0f0;
            border: 1px solid #999;
            padding: 6px;
            text-align: center;
            font-weight: bold;
        }

        table td {
            border: 1px solid #999;
            padding: 6px;
        }

        td.text-right {
            text-align: right;
        }

        td.text-center {
            text-align: center;
        }

        .summary {
            margin-top: 15px;
            padding: 8px;
            border: 1px solid #999;
            background-color: #f9f9f9;
            width: 50%;
        }

        .summary p {
            margin: 4px 0;
            font-size: 12px;
        }

        .total {
            font-weight: bold;
            background-color: #eafaea;
        }
    </style>
</head>
<body>

    <div class="header">
        <h2 class="title">KORMA Al Manshuriyah</h2>
        <p class="subtitle">Laporan Keuangan</p>
        <p class="subtitle">Periode: Semua Transaksi</p>
    </div>

    {{-- Tabel Pemasukan --}}
    <h3 class="section" style="border-left-color: #4CAF50;">Pemasukan</h3>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Kategori</th>
                <th>Keterangan</th>
                <th>Jumlah (Rp)</th>
            </tr>
        </thead>
        <tbody>
            @php $no=1; @endphp
            @foreach ($transaksi->where('jenis', 'pemasukan') as $t)
                <tr>
                    <td class="text-center">{{ $no++ }}</td>
                    <td class="text-center">{{ \Carbon\Carbon::parse($t->tanggal)->format('d/m/Y') }}</td>
                    <td>{{ $t->kategori }}</td>
                    <td>{{ $t->keterangan ?? '-' }}</td>
                    <td class="text-right">{{ number_format($t->jumlah, 0, ',', '.') }}</td>
                </tr>
            @endforeach
            <tr class="total">
                <td colspan="4" class="text-right"><strong>Total Pemasukan</strong></td>
                <td class="text-right"><strong>Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</strong></td>
            </tr>
        </tbody>
    </table>

    {{-- Tabel Pengeluaran --}}
    <h3 class="section" style="border-left-color: #F44336;">Pengeluaran</h3>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Kategori</th>
                <th>Keterangan</th>
                <th>Jumlah (Rp)</th>
            </tr>
        </thead>
        <tbody>
            @php $no=1; @endphp
            @foreach ($transaksi->where('jenis', 'pengeluaran') as $t)
                <tr>
                    <td class="text-center">{{ $no++ }}</td>
                    <td class="text-center">{{ \Carbon\Carbon::parse($t->tanggal)->format('d/m/Y') }}</td>
                    <td>{{ $t->kategori }}</td>
                    <td>{{ $t->keterangan ?? '-' }}</td>
                    <td class="text-right">{{ number_format($t->jumlah, 0, ',', '.') }}</td>
                </tr>
            @endforeach
            <tr class="total" style="background-color: #fdecea;">
                <td colspan="4" class="text-right"><strong>Total Pengeluaran</strong></td>
                <td class="text-right"><strong>Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</strong></td>
            </tr>
        </tbody>
    </table>

    {{-- Ringkasan Saldo --}}
    <div class="summary">
        <p><strong>Total Pemasukan:</strong> Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</p>
        <p><strong>Total Pengeluaran:</strong> Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</p>
        <p class="total"><strong>Saldo Kas:</strong> Rp {{ number_format($saldoKas, 0, ',', '.') }}</p>
    </div>

</body>
</html>