<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KORMA Al-Manshuriyah</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.4.1/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 text-gray-800">

    <!-- Navbar -->
    <nav class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <a href="{{ route('home') }}" class="text-xl font-bold text-green-700">KORMA</a>
            <ul class="flex space-x-4 text-sm">
                <li><a href="{{ route('home') }}" class="hover:underline">Home</a></li>
                <li><a href="{{ route('tentang') }}" class="hover:underline">Tentang</a></li>
                <li><a href="{{ route('kegiatan') }}" class="hover:underline">Kegiatan</a></li>
                <li><a href="{{ route('usulan') }}" class="hover:underline">Usulan</a></li>
                <li><a href="{{ route('kontak') }}" class="hover:underline">Kontak</a></li>
            </ul>
        </div>
    </nav>

    <!-- Konten -->
    <main class="py-8 px-4">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white text-center py-4 shadow-inner">
        <p class="text-xs text-gray-500">© {{ date('Y') }} KORMA Al-Manshuriyah</p>
    </footer>

</body>
</html>
