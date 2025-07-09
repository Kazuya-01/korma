<!DOCTYPE html>
<html>
<head>
    <title>Data Anggota</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
    </style>
</head>
<body>
    <h2>Data Anggota KORMA</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Jabatan</th>
                <th>Kontak</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $i => $anggota)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $anggota->nama }}</td>
                    <td>{{ $anggota->jabatan }}</td>
                    <td>{{ $anggota->kontak }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
