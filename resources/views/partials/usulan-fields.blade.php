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
        <option value="kajian" {{ old('kategori') == 'kajian' ? 'selected' : '' }}>Kajian</option>
        <option value="rapat" {{ old('kategori') == 'rapat' ? 'selected' : '' }}>Rapat</option>
        <option value="lomba" {{ old('kategori') == 'lomba' ? 'selected' : '' }}>Lomba</option>
        <option value="sosial" {{ old('kategori') == 'sosial' ? 'selected' : '' }}>Sosial</option>
        <option value="lainnya" {{ old('kategori') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
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
