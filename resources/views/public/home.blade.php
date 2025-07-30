@extends('layouts.public')

@section('content')
    <!-- HERO SECTION / HOME -->
    <section id="home" class="text-white d-flex align-items-center justify-content-center text-center hero-section">
        <div class="hero-overlay"></div>

        <div class="container position-relative hero-text">
            <h1 class="display-4 fw-bold text-white">Selamat Datang di</h1>
            <h2 class="fw-bold text-highlight">KORMA Al Manshuriyah</h2>
            <p class="lead text-white mt-3">
                Organisasi Remaja Masjid yang aktif dalam kegiatan sosial, keagamaan, dan pengembangan pemuda.
            </p>
        </div>
    </section>

    <!-- TENTANG -->
    <section id="tentang" class="py-5 tentang-section">
        <div class="container">
            <h2 class="text-success text-center mb-5">Tentang Kami</h2>

            <div class="card shadow-lg border-0 mx-auto mb-5 tentang-card">
                <div class="card-body p-4 tentang-text">
                     <p>
                        <strong>KORMA (Komunitas Remaja Masjid Al Manshuriyah)</strong> adalah sebuah organisasi kepemudaan
                        yang berada di bawah naungan Masjid Al Manshuriyah. Komunitas ini dibentuk sebagai wadah untuk
                        menyalurkan semangat, kreativitas, serta potensi remaja dalam berbagai kegiatan yang bersifat
                        positif, konstruktif, dan bermanfaat bagi masyarakat. Fokus utama KORMA mencakup pengembangan
                        kegiatan keagamaan seperti pengajian, kajian Islam, dan pelatihan keagamaan; kegiatan sosial seperti
                        bakti sosial, santunan anak yatim, dan gotong royong lingkungan; serta kegiatan pemberdayaan remaja
                        melalui pelatihan keterampilan, seminar motivasi, dan kegiatan edukatif lainnya. Melalui
                        kegiatan-kegiatan tersebut, KORMA berkomitmen untuk menciptakan generasi muda yang tidak hanya aktif
                        secara spiritual, tetapi juga memiliki kepedulian sosial yang tinggi, mampu bekerja sama dalam tim,
                        dan siap menjadi pemimpin masa depan yang berakhlak mulia. Keberadaan KORMA juga diharapkan mampu
                        menjadi jembatan yang menghubungkan masjid dengan para remaja, agar mereka lebih dekat dengan
                        lingkungan masjid dan menjadikan masjid sebagai pusat kegiatan yang menyenangkan, produktif, dan
                        inspiratif.
                    </p>
                </div>
            </div>

            <div class="auto-scroll-wrapper">
                <div class="auto-scroll-track">
                    @for ($i = 0; $i < 2; $i++)
                        <img src="{{ asset('images/tentang1.jpg') }}" alt="Gambar 1" class="scroll-image">
                        <img src="{{ asset('images/tentang2.jpg') }}" alt="Gambar 2" class="scroll-image">
                        <img src="{{ asset('images/tentang3.jpg') }}" alt="Gambar 3" class="scroll-image">
                        <img src="{{ asset('images/tentang4.jpg') }}" alt="Gambar 4" class="scroll-image">
                        <img src="{{ asset('images/tentang5.jpg') }}" alt="Gambar 5" class="scroll-image">
                    @endfor
                </div>
            </div>
        </div>
    </section>


{{-- Kalender Kegiatan --}}
<section id="kegiatan" class="py-5 kegiatan-section">
    <div class="container mx-auto">
        <h2 class="text-2xl font-bold text-center text-green-600 mb-4">Kalender Kegiatan</h2>
        <div id="calendar"
             class="calendar-container"
             data-events='@json($events)'></div>
    </div>
</section>

    <!-- Usulan Kegiatan -->
    <section id="usulan" class="py-5 usulan-section">
        <div class="container">
            <h2 class="text-center mb-5 fw-bold">📝 Usulkan Kegiatan</h2>

            @if (session('success'))
                <div id="flash-success" data-message="{{ session('success') }}"></div>
            @endif

            @if ($errors->any())
                <div id="flash-errors" data-errors='@json($errors->all())'></div>
            @endif

            <div class="row justify-content-center">
                <div class="col-lg-10 col-xl-8">
                    <div class="card shadow border-0 rounded-4">
                        <div class="card-body p-4">
                            <form method="POST" action="{{ url('/usulan') }}" class="row g-4" id="usulanForm">
                                @csrf
                                <!-- Form Fields -->
                                @include('partials.usulan-fields')
                                <div class="col-12 text-center mt-3">
                                    <button type="submit" class="btn btn-success btn-lg rounded-pill px-5 shadow-sm"
                                        id="submitBtn">
                                        <i class="bi bi-send-check me-1"></i> Kirim Usulan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Kontak -->
    <section id="kontak" class="py-5 kontak-section">
        <div class="container">
            <div class="row justify-content-center text-center mb-5">
                <div class="col-lg-8">
                    <h2 class="text-success fw-bold">Kontak Kami</h2>
                    <p class="text-muted">Hubungi kami melalui media sosial atau datang langsung ke lokasi kami.</p>
                    <hr class="w-25 mx-auto">
                </div>
            </div>

            <div class="row g-4 justify-content-center text-center">
                <div class="col-md-4">
                    <div class="bg-white rounded shadow-sm p-4 h-100 border border-success-subtle">
                        <i class="bi bi-envelope-fill text-success fs-1 mb-3"></i>
                        <h5>Email</h5>
                        <p><a href="mailto:kontak@korma.or.id">kontak@korma.or.id</a></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="bg-white rounded shadow-sm p-4 h-100 border border-success-subtle">
                        <i class="bi bi-instagram text-danger fs-1 mb-3"></i>
                        <h5>Instagram</h5>
                        <p><a href="https://instagram.com/korma.manshuriyah" target="_blank">@korma.manshuriyah</a></p>
                    </div>
                </div>
            </div>

            <div class="row mt-5 justify-content-center">
                <div class="col-lg-10">
                    <h5 class="text-success mb-3 text-center">Kegiatan Kami di YouTube</h5>
                    <div class="ratio ratio-16x9 shadow-sm rounded border border-success-subtle youtube-embed">
                        <iframe src="https://www.youtube.com/embed/YOUTUBE_VIDEO_ID" allowfullscreen></iframe>
                    </div>
                </div>
            </div>

           <div class="row mt-5 justify-content-center">
                <div class="col-lg-10">
                    <h5 class="text-success mb-3 text-center">Lokasi Kami</h5>
                    <div class="ratio ratio-16x9 shadow-sm rounded border border-success-subtle">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1980.8902730566147!2d106.7574312704845!3d-6.796533990372944!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6833007af60f43%3A0x3f12dc595055420f!2sMasjid%20Almansyuriah!5e0!3m2!1sid!2sid!4v1753505234676!5m2!1sid!2sid"
                            style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Import JS -->
    <script src="{{ asset('js/public-page.js') }}"></script>

@endsection
