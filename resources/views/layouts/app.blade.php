<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Sistem Kos')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @stack('styles')
</head>
<body class="bg-gray-100 min-h-screen">

    <!-- Navbar -->
    <nav class="bg-blue-600 text-white shadow">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <h1 class="text-lg font-semibold flex items-center gap-2">
                🏠 Sistem Penghuni Kos
            </h1>
            <div class="space-x-4">
                <a href="{{ route('beranda') }}"
                class="bg-white text-blue-600 font-medium px-4 py-2 rounded hover:bg-blue-100 transition duration-200">
                Beranda
                </a>
                <a href="{{ route('penghuni.index') }}"
                class="bg-white text-blue-600 font-medium px-4 py-2 rounded hover:bg-blue-100 transition duration-200">
                Kelola
                </a>
            </div>
        </div>
    </nav>


    <!-- Content -->
    <main class="py-8 px-4 md:px-8">
        <div class="max-w-6xl mx-auto">
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-blue-600 text-white text-center py-4 mt-10 shadow-inner">
        <p>&copy; {{ date('Y') }} Sistem Kos Asri Punya Dhiraaa</p>
    </footer>

    @stack('scripts')
</body>
</html>
