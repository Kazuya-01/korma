<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>KORMA Al Manshuriyah</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .section-padding {
            padding-top: 80px;
            padding-bottom: 80px;
        }

        .section-heading {
            margin-bottom: 40px;
        }

        .table thead th {
            vertical-align: middle;
            text-align: center;
            font-weight: 600;
            background-color: #e9f5ec;
            color: #155724;
        }

        .table td,
        .table th {
            text-align: center;
            vertical-align: middle;
            font-size: 0.95rem;
            padding: 10px;
        }

        .table-hover tbody tr:hover {
            background-color: #f2fdf6;
        }

        .badge {
            font-size: 0.75rem;
            padding: 5px 8px;
            border-radius: 6px;
        }

        .table img {
            width: 60px;
            height: auto;
            object-fit: cover;
            border-radius: 5px;
        }

        .btn-download {
            font-size: 0.8rem;
            padding: 3px 8px;
        }
    </style>
    {{-- Tambahkan CSS tambahan jika ada --}}
</head>

<body>

    {{-- Navbar (opsional) --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#home">KORMA</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav gap-3">
                    <li class="nav-item"><a class="nav-link" href="#home">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#tentang">Tentang</a></li>
                    <li class="nav-item"><a class="nav-link" href="#kegiatan">Kegiatan</a></li>
                    <li class="nav-item"><a class="nav-link" href="#usulan">Usulan</a></li>
                    <li class="nav-item"><a class="nav-link" href="#kontak">Kontak</a></li>
                </ul>
            </div>
        </div>
    </nav>

    {{-- Konten Halaman --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer (opsional) --}}

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
