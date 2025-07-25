@extends('layouts.public')

@section('content')

    <!-- HERO SECTION / HOME -->
    <section id="beranda" class="text-white"
        style="
    background: url('/images/bg.jpg') no-repeat center center;
    background-size: cover;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 100px 20px;
">
        <div class="container text-center">
            <h1 class="display-4 fw-bold">Selamat Datang di KORMA Al Manshuriyah</h1>
            <p class="lead">Organisasi Remaja Masjid yang aktif dalam kegiatan sosial, keagamaan, dan pengembangan pemuda.
            </p>
        </div>
    </section>

    <!-- TENTANG -->
    <section id="tentang" class="py-5" style="background: url('/images/pattern1.png') repeat; background-color: #e8f5e9;">
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
            <form method="GET" class="row justify-content-center mb-4">
                <div class="col-md-3 mb-2">
                    <select name="bulan" class="form-select">
                        <option value="">-- Pilih Bulan --</option>
                        @for ($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}" {{ request('bulan') == $i ? 'selected' : '' }}>
                                {{ DateTime::createFromFormat('!m', $i)->format('F') }}
                            </option>
                        @endfor
                    </select>
                </div>
                <div class="col-md-3 mb-2">
                    <select name="tahun" class="form-select">
                        <option value="">-- Pilih Tahun --</option>
                        @for ($y = date('Y'); $y >= 2020; $y--)
                            <option value="{{ $y }}" {{ request('tahun') == $y ? 'selected' : '' }}>
                                {{ $y }}</option>
                        @endfor
                    </select>
                </div>
                <div class="col-md-2 mb-2">
                    <button type="submit" class="btn btn-success w-100">
                        <i class="bi bi-funnel-fill"></i> Filter
                    </button>
                </div>
            </form>
            {{-- Tabel Kegiatan --}}
            @if ($kegiatan->count())
                <div class="table-responsive">
                    <table class="table table-bordered align-middle table-hover">
                        <thead class="table-success">
                            <tr class="text-center">
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
                                        {{ ($kegiatan->currentPage() - 1) * $kegiatan->perPage() + $loop->iteration }}</td>
                                    <td>{{ $item->nama_kegiatan }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->waktu)->format('H:i') }}</td>
                                    <td>{{ $item->lokasi }}</td>
                                    <td class="text-center">
                                        @if ($item->terlaksana)
                                            <span class="badge bg-success">Terlaksana</span>
                                        @else
                                            <span class="badge bg-danger">Belum</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if ($item->foto)
                                            <img src="{{ asset('storage/' . $item->foto) }}" alt="Foto"
                                                style="width: 60px; border-radius: 6px;"><br>
                                            <a href="{{ asset('storage/' . $item->foto) }}"
                                                class="btn btn-sm btn-primary mt-1" download>
                                                <i class="bi bi-download"></i>
                                            </a>
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div class="mt-3 d-flex justify-content-center">
                    {{ $kegiatan->links('pagination::bootstrap-5') }}
                </div>
            @else
                <div class="alert alert-info text-center">
                    Tidak ada kegiatan untuk filter yang dipilih.
                </div>
            @endif
        </div>
    </section>

    {{-- Form Usulan Kegiatan --}}
    <section id="usulan" class="py-5 bg-white">
        <div class="container">
            <h2 class="text-center mb-4">Usulkan Kegiatan</h2>

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
                <div class="col-lg-8">
                    <div class="card shadow-sm border-0">
                        <div class="card-body p-4">
                            <form method="POST" action="{{ url('/usulan') }}" class="row g-3">
                                @csrf

                                <div class="col-md-6">
                                    <label for="pengusul" class="form-label">Nama Pengusul</label>
                                    <input type="text" name="pengusul" id="pengusul"
                                        class="form-control @error('pengusul') is-invalid @enderror"
                                        value="{{ old('pengusul') }}" required>
                                    @error('pengusul')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="nomor_anggota" class="form-label">Nomor Anggota</label>
                                    <input type="text" name="nomor_anggota" id="nomor_anggota"
                                        class="form-control @error('nomor_anggota') is-invalid @enderror"
                                        value="{{ old('nomor_anggota') }}" required>
                                    @error('nomor_anggota')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="nama_kegiatan" class="form-label">Nama Kegiatan</label>
                                    <input type="text" name="nama_kegiatan" id="nama_kegiatan"
                                        class="form-control @error('nama_kegiatan') is-invalid @enderror"
                                        value="{{ old('nama_kegiatan') }}" required>
                                    @error('nama_kegiatan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="tanggal" class="form-label">Tanggal Usulan</label>
                                    <input type="date" name="tanggal" id="tanggal"
                                        class="form-control @error('tanggal') is-invalid @enderror"
                                        value="{{ old('tanggal') }}" required>
                                    @error('tanggal')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="waktu" class="form-label">Waktu Kegiatan</label>
                                    <input type="time" name="waktu" id="waktu"
                                        class="form-control @error('waktu') is-invalid @enderror"
                                        value="{{ old('waktu') }}" required>
                                    @error('waktu')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="lokasi" class="form-label">Lokasi</label>
                                    <input type="text" name="lokasi" id="lokasi"
                                        class="form-control @error('lokasi') is-invalid @enderror"
                                        value="{{ old('lokasi') }}">
                                    @error('lokasi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="kategori" class="form-label">Kategori</label>
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
                                    <label for="deskripsi" class="form-label">Deskripsi (Opsional)</label>
                                    <textarea name="deskripsi" id="deskripsi" rows="4"
                                        class="form-control @error('deskripsi') is-invalid @enderror">{{ old('deskripsi') }}</textarea>
                                    @error('deskripsi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-success px-4">
                                        <i class="bi bi-send-check"></i> Kirim Usulan
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

    <!-- KONTAK -->
    <section id="kontak" class="py-5"
        style="background: url('/images/pattern4.png') repeat; background-color: #f1f9f1;">
        <div class="container text-center">
            <h2 class="text-success mb-4">Kontak Kami</h2>
            <p>Email: <a href="mailto:kontak@korma.or.id">kontak@korma.or.id</a></p>
            <p>Instagram: <a href="https://instagram.com/korma.manshuriyah" target="_blank">@korma.manshuriyah</a></p>
        </div>
    </section>

@endsection
