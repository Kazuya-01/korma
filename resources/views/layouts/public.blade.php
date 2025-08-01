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
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <!-- File CSS Utama -->
    <link rel="stylesheet" href="{{ asset('css/korma-style.css') }}">
    <!-- FullCalendar CSS -->
    <link href="https://unpkg.com/@fullcalendar/core@6.1.8/index.global.min.css" rel="stylesheet" />
    <link href="https://unpkg.com/@fullcalendar/daygrid@6.1.8/index.global.min.css" rel="stylesheet" />
</head>

<body>
    <!-- Modal Bootstrap -->
    <div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content shadow-lg border-0 rounded-4">
                <div class="modal-header bg-success text-white rounded-top-4">
                    <h5 class="modal-title fw-semibold" id="eventModalLabel">
                        <i class="bi bi-calendar-event me-2"></i> Detail Kegiatan
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body p-4 bg-light">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item bg-transparent">
                            <strong class="text-success">Nama Kegiatan:</strong> <span id="modalTitle"
                                class="float-end text-dark fw-medium"></span>
                        </li>
                        <li class="list-group-item bg-transparent">
                            <strong class="text-success">Waktu:</strong> <span id="modalTime"
                                class="float-end text-dark fw-medium"></span>
                        </li>
                        <li class="list-group-item bg-transparent">
                            <strong class="text-success">Lokasi:</strong> <span id="modalLocation"
                                class="float-end text-dark fw-medium"></span>
                        </li>
                        <li class="list-group-item bg-transparent">
                            <strong class="text-success">Deskripsi:</strong>
                            <div id="modalDescription" class="mt-1 text-dark fw-medium"></div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold">KORMA Al Manshuriyah</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav gap-3">
                    <li class="nav-item"><a class="nav-link" href="#home">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#tentang">Tentang</a></li>
                    <li class="nav-item"><a class="nav-link" href="#kegiatan">Kegiatan</a></li>
                    <li class="nav-item"><a class="nav-link" href="#usulan">Usulan</a></li>
                    <li class="nav-item"><a class="nav-link" href="#keuangan">Keuangan</a></li>
                    <li class="nav-item"><a class="nav-link" href="#kontak">Kontak</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- KONTEN HALAMAN -->
    <main>
        @yield('content')
    </main>
    <!-- FOOTER -->
    <footer class="bg-dark text-white py-4">
        <div class="container text-center">
            <p class="mb-1">© {{ date('Y') }} KORMA Al Manshuriyah. Menyatukan Semangat, Mewujudkan Kebaikan.</p>
            <p class="mb-2">
                Dibina oleh Masjid Al Manshuriyah
            </p>
            <p class="mb-0">
                <a href="https://www.instagram.com/korma.almanshuriyah"
                    class="text-white text-decoration-underline me-3" target="_blank">
                    <i class="bi bi-instagram"></i> Instagram
                </a>
                <a href="https://www.tiktok.com/@korma.almanshuriyah" class="text-white text-decoration-underline me-3"
                    target="_blank">
                    <i class="bi bi-tiktok"></i> TikTok
                </a>
                <a href="https://www.youtube.com/@korma.almanshuriyah" class="text-white text-decoration-underline"
                    target="_blank">
                    <i class="bi bi-youtube"></i> YouTube
                </a>
            </p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- FullCalendar JS -->
    <script src="https://unpkg.com/@fullcalendar/core@6.1.8/index.global.min.js"></script>
    <script src="https://unpkg.com/@fullcalendar/daygrid@6.1.8/index.global.min.js"></script>
    <script src="https://unpkg.com/@fullcalendar/interaction@6.1.8/index.global.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Script Khusus Halaman Publik -->
    <script src="{{ asset('js/public-page.js') }}"></script>


</body>

</html>
