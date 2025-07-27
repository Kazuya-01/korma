@extends('layouts.public')

@section('content')

    <!-- HERO SECTION / HOME -->
    <section id="home" class="text-white d-flex align-items-center justify-content-center text-center"
        style="
        background: url('/images/bg.jpg') no-repeat center center;
        background-size: cover;
        min-height: 100vh;
        padding: 100px 20px;
        position: relative;
    ">
        <!-- Overlay gelap agar teks lebih terbaca -->
        <div
            style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1;">
        </div>

        <div class="container position-relative" style="z-index: 2;">
            <h1 class="display-4 fw-bold text-white">Selamat Datang di</h1>
            <h2 class="fw-bold" style="color: #fdd835;">KORMA Al Manshuriyah</h2>
            <p class="lead text-white mt-3">
                Organisasi Remaja Masjid yang aktif dalam kegiatan sosial, keagamaan, dan pengembangan pemuda.
            </p>
        </div>
    </section>

    <!-- TENTANG -->
    <section id="tentang" class="py-5"
        style="background: url('/images/pattern1.png') repeat; background-color: ##f1f8f4;">
        <div class="container">
            <h2 class="text-success text-center mb-4">Tentang Kami</h2>

            <p class="mx-auto"
                style="max-width: 850px; text-align: justify; line-height: 1.8; font-size: 1.05rem; margin-bottom: 50px;">
                KORMA (Komunitas Remaja Masjid Al Manshuriyah) adalah sebuah organisasi kepemudaan yang berada di bawah
                naungan Masjid Al Manshuriyah. Komunitas ini dibentuk sebagai wadah untuk menyalurkan semangat, kreativitas,
                serta potensi remaja dalam berbagai kegiatan yang bersifat positif, konstruktif, dan bermanfaat bagi
                masyarakat. Fokus utama KORMA mencakup pengembangan kegiatan keagamaan seperti pengajian, kajian Islam, dan
                pelatihan keagamaan; kegiatan sosial seperti bakti sosial, santunan anak yatim, dan gotong royong
                lingkungan; serta kegiatan pemberdayaan remaja melalui pelatihan keterampilan, seminar motivasi, dan
                kegiatan edukatif lainnya.

                Melalui kegiatan-kegiatan tersebut, KORMA berkomitmen untuk menciptakan generasi muda yang tidak hanya aktif
                secara spiritual, tetapi juga memiliki kepedulian sosial yang tinggi, mampu bekerja sama dalam tim, dan siap
                menjadi pemimpin masa depan yang berakhlak mulia. Keberadaan KORMA juga diharapkan mampu menjadi jembatan
                yang menghubungkan masjid dengan para remaja, agar mereka lebih dekat dengan lingkungan masjid dan
                menjadikan masjid sebagai pusat kegiatan yang menyenangkan, produktif, dan inspiratif.
            </p>

            <!-- Galeri Auto Geser -->
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

    <!-- KEGIATAN -->
    <section id="kegiatan" class="py-5"
        style="background: url('/images/pattern2.png') repeat; background-color: #f1f8f4;">
        <div class="container">
            <h2 class="text-success text-center mb-4">Daftar Kegiatan</h2>

            {{-- Filter --}}
            <form method="GET" class="row justify-content-center g-2 mb-4">
                <div class="col-md-3 col-12">
                    <select name="bulan" class="form-select shadow-sm rounded">
                        <option value="">-- Pilih Bulan --</option>
                        @for ($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}" {{ request('bulan') == $i ? 'selected' : '' }}>
                                {{ DateTime::createFromFormat('!m', $i)->format('F') }}
                            </option>
                        @endfor
                    </select>
                </div>
                <div class="col-md-3 col-12">
                    <select name="tahun" class="form-select shadow-sm rounded">
                        <option value="">-- Pilih Tahun --</option>
                        @for ($y = date('Y'); $y >= 2020; $y--)
                            <option value="{{ $y }}" {{ request('tahun') == $y ? 'selected' : '' }}>
                                {{ $y }}
                            </option>
                        @endfor
                    </select>
                </div>
                <div class="col-md-2 col-12">
                    <button type="submit" class="btn btn-success w-100 shadow-sm">
                        <i class="bi bi-funnel-fill me-1"></i> Filter
                    </button>
                </div>
            </form>

            {{-- Tabel Kegiatan --}}
            @if ($kegiatan->count())
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover align-middle shadow-sm">
                        <thead class="table-success text-center">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Tanggal</th>
                                <th>Waktu</th>
                                <th>Lokasi</th>
                                <th>Status</th>
                                <th>Foto</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kegiatan as $index => $item)
                                <tr>
                                    <td class="text-center">
                                        {{ ($kegiatan->currentPage() - 1) * $kegiatan->perPage() + $loop->iteration }}
                                    </td>
                                    <td>{{ $item->nama_kegiatan }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->waktu)->format('H:i') }}</td>
                                    <td>{{ $item->lokasi }}</td>
                                    <td class="text-center">
                                        @if ($item->terlaksana)
                                            <span class="badge bg-success px-3 py-2 rounded-pill">Terlaksana</span>
                                        @else
                                            <span class="badge bg-danger px-3 py-2 rounded-pill">Belum</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if ($item->foto)
                                            <img src="{{ asset('storage/' . $item->foto) }}" alt="Foto"
                                                class="img-thumbnail mb-2"
                                                style="width: 70px; height: 70px; object-fit: cover; border-radius: 0.5rem;">
                                            <br>
                                            <a href="{{ asset('storage/' . $item->foto) }}"
                                                class="btn btn-sm btn-outline-primary rounded-pill" download>
                                                <i class="bi bi-download"></i> Unduh
                                            </a>
                                        @else
                                            <span class="text-muted">Tidak Ada</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div class="mt-4 d-flex justify-content-center">
                    {{ $kegiatan->links('pagination::bootstrap-5') }}
                </div>
            @else
                <div class="alert alert-info text-center shadow-sm">
                    Tidak ada kegiatan untuk filter yang dipilih.
                </div>
            @endif
        </div>
    </section>

    {{-- Form Usulan Kegiatan --}}
    <section id="usulan" class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-5 fw-bold">📝 Usulkan Kegiatan</h2>

            {{-- Notifikasi --}}
            @if (session('success'))
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: '{{ session('success') }}',
                            confirmButtonColor: '#28a745',
                            timer: 3000,
                            showConfirmButton: false
                        });
                    });
                </script>
            @endif

            <div class="row justify-content-center">
                <div class="col-lg-10 col-xl-8">
                    <div class="card shadow border-0 rounded-4">
                        <div class="card-body p-4">
                            <form method="POST" action="{{ url('/usulan') }}" class="row g-4">
                                @csrf

                                <div class="col-md-6">
                                    <label for="pengusul" class="form-label fw-semibold">Nama Pengusul</label>
                                    <input type="text" name="pengusul" id="pengusul"
                                        class="form-control @error('pengusul') is-invalid @enderror"
                                        value="{{ old('pengusul') }}" required>
                                    @error('pengusul')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="nomor_anggota" class="form-label fw-semibold">Nomor Anggota</label>
                                    <input type="text" name="nomor_anggota" id="nomor_anggota"
                                        class="form-control @error('nomor_anggota') is-invalid @enderror"
                                        value="{{ old('nomor_anggota') }}" required>
                                    @error('nomor_anggota')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="nama_kegiatan" class="form-label fw-semibold">Nama Kegiatan</label>
                                    <input type="text" name="nama_kegiatan" id="nama_kegiatan"
                                        class="form-control @error('nama_kegiatan') is-invalid @enderror"
                                        value="{{ old('nama_kegiatan') }}" required>
                                    @error('nama_kegiatan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="tanggal" class="form-label fw-semibold">Tanggal Usulan</label>
                                    <input type="date" name="tanggal" id="tanggal"
                                        class="form-control @error('tanggal') is-invalid @enderror"
                                        value="{{ old('tanggal') }}" required>
                                    @error('tanggal')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="waktu" class="form-label fw-semibold">Waktu Kegiatan</label>
                                    <input type="time" name="waktu" id="waktu"
                                        class="form-control @error('waktu') is-invalid @enderror"
                                        value="{{ old('waktu') }}" required>
                                    @error('waktu')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="lokasi" class="form-label fw-semibold">Lokasi</label>
                                    <input type="text" name="lokasi" id="lokasi"
                                        class="form-control @error('lokasi') is-invalid @enderror"
                                        value="{{ old('lokasi') }}">
                                    @error('lokasi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="kategori" class="form-label fw-semibold">Kategori</label>
                                    <select name="kategori" id="kategori"
                                        class="form-select @error('kategori') is-invalid @enderror" required>
                                        <option value="">-- Pilih Kategori --</option>
                                        <option value="kajian" {{ old('kategori') == 'kajian' ? 'selected' : '' }}>Kajian
                                        </option>
                                        <option value="rapat" {{ old('kategori') == 'rapat' ? 'selected' : '' }}>Rapat
                                        </option>
                                        <option value="lomba" {{ old('kategori') == 'lomba' ? 'selected' : '' }}>Lomba
                                        </option>
                                        <option value="sosial" {{ old('kategori') == 'sosial' ? 'selected' : '' }}>Sosial
                                        </option>
                                        <option value="lainnya" {{ old('kategori') == 'lainnya' ? 'selected' : '' }}>
                                            Lainnya</option>
                                    </select>
                                    @error('kategori')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label for="deskripsi" class="form-label fw-semibold">Deskripsi (Opsional)</label>
                                    <textarea name="deskripsi" id="deskripsi" rows="4"
                                        class="form-control @error('deskripsi') is-invalid @enderror"
                                        placeholder="Tuliskan informasi tambahan jika ada...">{{ old('deskripsi') }}</textarea>
                                    @error('deskripsi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12 text-center mt-3">
                                    <button type="submit" class="btn btn-success btn-lg rounded-pill px-5 shadow-sm">
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

    {{-- Auto-close notifikasi --}}
    <script>
        const alertBox = document.querySelector('.alert');
        if (alertBox) {
            setTimeout(() => {
                alertBox.classList.remove('show');
                alertBox.classList.add('d-none');
            }, 5000);
        }
    </script>
    <script>
        const form = document.querySelector('form');
        if (form) {
            form.addEventListener('submit', () => {
                const submitButton = form.querySelector('[type="submit"]');
                submitButton.disabled = true;
                submitButton.innerHTML = '<i class="bi bi-send-check"></i> Mengirim...';
            });
        }
    </script>
    @if ($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops!',
                    html: `{!! implode('<br>', $errors->all()) !!}`,
                    confirmButtonColor: '#dc3545'
                });
            });
        </script>
    @endif

    <!-- KONTAK KAMI -->
    <section id="kontak" class="py-5" style="background: linear-gradient(to right, #f1f8f4;);">
        <div class="container">
            <!-- Judul -->
            <div class="row justify-content-center text-center mb-5">
                <div class="col-lg-8">
                    <h2 class="text-success fw-bold">Kontak Kami</h2>
                    <p class="text-muted">Hubungi kami melalui media sosial atau datang langsung ke lokasi kami.</p>
                    <hr class="w-25 mx-auto">
                </div>
            </div>

            <!-- Info Kontak -->
            <div class="row g-4 justify-content-center text-center">
                <div class="col-md-4">
                    <div class="bg-white rounded shadow-sm p-4 h-100 border border-success-subtle">
                        <i class="bi bi-envelope-fill text-success fs-1 mb-3"></i>
                        <h5>Email</h5>
                        <p><a href="mailto:kontak@korma.or.id" class="text-decoration-none">kontak@korma.or.id</a></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="bg-white rounded shadow-sm p-4 h-100 border border-success-subtle">
                        <i class="bi bi-instagram text-danger fs-1 mb-3"></i>
                        <h5>Instagram</h5>
                        <p><a href="https://instagram.com/korma.manshuriyah" target="_blank"
                                class="text-decoration-none">@korma.manshuriyah</a></p>
                    </div>
                </div>
            </div>

            <!-- YouTube Embed -->
            <div class="row mt-5 justify-content-center">
                <div class="col-lg-10">
                    <h5 class="text-success mb-3 text-center">Kegiatan Kami di YouTube</h5>
                    <div class="ratio ratio-16x9 shadow-sm rounded border border-success-subtle">
                        <iframe src="https://www.youtube.com/embed/YOUTUBE_VIDEO_ID" title="YouTube video"
                            frameborder="0" allowfullscreen
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture">
                        </iframe>
                    </div>
                </div>
            </div>

            <!-- Google Maps Embed -->
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

@endsection
