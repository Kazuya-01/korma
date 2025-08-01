<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Anggota KORMA</title>
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
            font-size: 14px;
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

        td.text-center {
            text-align: center;
        }
    </style>
</head>
<body>

    <div class="header">
        <h2>KORMA Al Manshuriyah</h2>
        <p>Data Anggota</p>
    </div>

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
                    <td class="text-center">{{ $i + 1 }}</td>
                    <td>{{ $anggota->nama }}</td>
                    <td>{{ $anggota->jabatan }}</td>
                    <td>{{ $anggota->kontak }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>