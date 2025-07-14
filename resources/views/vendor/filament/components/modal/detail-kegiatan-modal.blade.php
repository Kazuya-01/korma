<x-filament::modal id="detail-kegiatan-modal">
    <x-slot name="title">
        {{ $get('title') ?? 'Detail Kegiatan' }}
    </x-slot>

    <div class="space-y-2">
        <p><strong>Kategori:</strong> {{ $get('data.kategori') }}</p>
        <p><strong>Lokasi:</strong> {{ $get('data.lokasi') }}</p>
        <p><strong>Waktu:</strong> {{ $get('data.waktu') }}</p>
        <p><strong>Status:</strong> {{ $get('data.status') }}</p>
    </div>
</x-filament::modal>
