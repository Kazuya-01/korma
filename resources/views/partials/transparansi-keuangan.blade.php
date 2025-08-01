<section id="keuangan" class="py-5 transparansi-keuangan">
    <div class="container">
        <h2 class="text-success text-center mb-4 fw-bold">Transparansi Keuangan</h2>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card transparansi-card shadow-lg border-0 rounded-4">
                    <div class="card-body p-4 text-center">

                        <!-- Saldo Kas -->
                        <h5 class="fw-bold mb-3">Saldo Kas Terakhir</h5>
                        <p class="display-6 fw-bold text-success mb-4">
                            Rp {{ number_format($saldoKas, 0, ',', '.') }}
                        </p>

                        <!-- Ringkasan Bulanan -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="ringkasan-box pemasukan">
                                    <h6>Pemasukan Bulan Ini</h6>
                                    <p>Rp {{ number_format($pemasukanBulanIni, 0, ',', '.') }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="ringkasan-box pengeluaran">
                                    <h6>Pengeluaran Bulan Ini</h6>
                                    <p>Rp {{ number_format($pengeluaranBulanIni, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Tombol Unduh PDF -->
                        <a href="{{ route('laporan.keuangan.pdf') }}"
                           class="btn btn-outline-success rounded-pill px-4 shadow-sm">
                            <i class="bi bi-file-earmark-pdf-fill me-2"></i> Unduh Laporan PDF
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
