@extends('layouts.app')

@section('title', 'Beranda - Kos Asri')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-10">
    <!-- Judul & Header Gambar -->
    <div class="mb-8">
        <h1 class="text-4xl font-extrabold text-center text-blue-700 mb-6">Selamat Datang di Kos Asri</h1>
        <div class="rounded-2xl overflow-hidden shadow-xl">
            <img src="{{ asset('images/kos-asri.jpg') }}" alt="Kos Asri" class="w-full h-72 object-cover">
        </div>
    </div>

    <!-- Grid: Total Penghuni & Aksi -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Total Penghuni Aktif -->
        <div class="bg-blue-100 border border-blue-300 text-blue-900 rounded-xl p-6 shadow-md text-center">
            <h2 class="text-xl font-semibold mb-2">Total Penghuni Aktif</h2>
            <p class="text-5xl font-bold">{{ $totalPenghuni }}</p>
        </div>

        <!-- Kelola Data -->
        <div class="bg-white shadow-md rounded-xl p-6 flex flex-col justify-between">
            <div>
                <h2 class="text-xl font-semibold mb-3">Kelola Data Penghuni Kos</h2>
                <p class="text-gray-600 mb-6">Klik tombol di bawah ini untuk melihat dan mengelola data penghuni kos Anda secara lengkap dan efisien.</p>
            </div>
            <a href="{{ route('penghuni.index') }}"
               class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold text-center py-2 px-4 rounded-lg transition duration-200">
                Kelola Data Penghuni
            </a>
        </div>
    </div>
</div>
@endsection
