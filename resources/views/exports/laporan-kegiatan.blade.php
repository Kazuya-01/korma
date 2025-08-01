<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ $judul }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            margin: 20px;
            color: #333;
        }

        .header {
            text-align: center;
            margin-bottom: 15px;
            border-bottom: 2px solid #333;
            padding-bottom: 5px;
        }

        .header h2 {
            margin: 0;
            font-size: 18px;
        }

        .header p {
            margin: 0;
            font-size: 13px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            font-size: 11px;
        }

        th {
            background-color: #f0f0f0;
            border: 1px solid #555;
            padding: 6px;
            text-align: center;
            font-weight: bold;
        }

        td {
            border: 1px solid #555;
            padding: 6px;
        }

        tr:nth-child(even) td {
            background-color: #f9f9f9;
        }

        .status-terlaksana {
            color: green;
            font-weight: bold;
        }

        .status-belum {
            color: red;
            font-weight: bold;
        }

        td.text-center {
            text-align: center;
        }
    </style>
</head>
<body>

    <div class="header">
        <h2>KORMA Al Manshuriyah</h2>
        <h3>{{ $judul }}</h3>
        <p>Periode: {{ $periode ?? 'Semua Kegiatan' }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Kegiatan</th>
                <th>Tanggal</th>
                <th>Waktu</th>
                <th>Lokasi</th>
                <th>Kategori</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $i => $item)
            <tr>
                <td class="text-center">{{ $i + 1 }}</td>
                <td>{{ $item->nama_kegiatan }}</td>
                <td class="text-center">{{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}</td>
                <td class="text-center">{{ \Carbon\Carbon::parse($item->waktu)->format('H:i') }}</td>
                <td>{{ $item->lokasi }}</td>
                <td>{{ ucfirst($item->kategori) }}</td>
                <td class="{{ $item->terlaksana ? 'status-terlaksana' : 'status-belum' }}">
                    {{ $item->terlaksana ? 'Terlaksana' : 'Belum' }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>