<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{ $judul }}</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #aaa; padding: 6px; text-align: left; }
    </style>
</head>
<body>
    <h2>{{ $judul }}</h2>

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
                <td>{{ $i + 1 }}</td>
                <td>{{ $item->nama_kegiatan }}</td>
                <td>{{ $item->tanggal }}</td>
                <td>{{ $item->waktu }}</td>
                <td>{{ $item->lokasi }}</td>
                <td>{{ ucfirst($item->kategori) }}</td>
                <td>{{ $item->terlaksana ? 'Terlaksana' : 'Belum' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
