<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ $judul }}</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }
        th, td {
            padding: 6px 8px;
            border: 1px solid #000;
            text-align: left;
        }
        th {
            background-color: #eee;
        }
        .total {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h2>{{ $judul }}</h2>

    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Jenis</th>
                <th>Kategori</th>
                <th>Jumlah</th>
                <th>Deskripsi</th>
            </tr>
        </thead>
        <tbody>
            @php
                $total = 0;
            @endphp

            @foreach ($data as $item)
                @php
                    $jumlah = $item->jenis === 'pemasukan' ? $item->jumlah : -$item->jumlah;
                    $total += $jumlah;
                @endphp
                <tr>
                    <td>{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}</td>
                    <td>{{ ucfirst($item->jenis) }}</td>
                    <td>{{ ucfirst($item->kategori) }}</td>
                    <td>Rp {{ number_format($item->jumlah, 0, ',', '.') }}</td>
                    <td>{{ $item->deskripsi }}</td>
                </tr>
            @endforeach

            <tr class="total">
                <td colspan="3">Total Saldo</td>
                <td colspan="2">Rp {{ number_format($total, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>
