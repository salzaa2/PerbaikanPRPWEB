@extends('layouts.app')

@section('title', 'Data Penghuni Kos')

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        loadData();

        document.getElementById('search').addEventListener('input', function () {
            loadData(this.value);
        });
    });

    function loadData(search = '', url = `/index?search=${search}`) {
        fetch(url, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(res => res.text())
        .then(html => {
            document.getElementById('data-penghuni').innerHTML = html;
            attachPaginationListeners(); // Pastikan pagination tetap aktif setelah render
        });
    }

    function attachPaginationListeners() {
        const paginationLinks = document.querySelectorAll('#data-penghuni .pagination a');
        paginationLinks.forEach(link => {
            link.removeEventListener('click', handlePaginationClick);
            link.addEventListener('click', handlePaginationClick);
        });
    }

    function handlePaginationClick(event) {
        event.preventDefault();
        const pageUrl = this.getAttribute('href');
        const currentSearchTerm = document.getElementById('search').value;

        // Ambil hanya query ?page=x dari URL
        const url = new URL(pageUrl);
        const page = url.searchParams.get('page');
        loadData(currentSearchTerm, `/index?page=${page}&search=${currentSearchTerm}`);
    }

    function editData(id) {
        fetch(`/edit/${id}`)
            .then(res => res.json())
            .then(data => {
                document.getElementById('id').value = data.id;
                document.getElementById('nama').value = data.nama;
                document.getElementById('no_kamar').value = data.no_kamar;
                document.getElementById('tanggal_masuk').value = data.tanggal_masuk;
                document.getElementById('status').value = data.status;
            });
    }

    function saveData() {
        const id = document.getElementById('id').value;
        const url = id ? `/update/${id}` : '/store';
        const method = 'POST';
        const formData = new FormData(document.getElementById('form'));

        fetch(url, { method: method, body: formData })
            .then(() => {
                loadData();
                document.getElementById('form').reset();
                document.getElementById('id').value = '';
            });
    }

    function deleteData(id) {
        fetch(`/delete/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        }).then(() => loadData());
    }
</script>
@endpush

@section('content')
    <h2 class="text-2xl font-bold text-blue-700 mb-6">📋 Pengelolaan Data Penghuni Kos</h2>

    <div class="bg-white rounded-xl shadow p-6 mb-6">
        <form id="form" onsubmit="event.preventDefault(); saveData();" class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @csrf
            <input type="hidden" id="id" name="id">
            <input type="text" name="nama" id="nama" placeholder="Nama" class="border rounded p-2 w-full" required>
            <input type="text" name="no_kamar" id="no_kamar" placeholder="No. Kamar" class="border rounded p-2 w-full" required>
            <input type="date" name="tanggal_masuk" id="tanggal_masuk" class="border rounded p-2 w-full" required>
            <select name="status" id="status" class="border rounded p-2 w-full" required>
                <option value="">-- Pilih Status --</option>
                <option value="Aktif">Aktif</option>
                <option value="Keluar">Keluar</option>
            </select>
            <div class="col-span-1 md:col-span-2 text-center">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition duration-200">💾 Simpan</button>
            </div>
        </form>
    </div>

    <div class="mb-6">
        <input type="text" id="search" placeholder="🔍 Cari nama / no. kamar..." class="border border-blue-300 rounded p-2 w-full focus:ring focus:ring-blue-200 focus:outline-none">
    </div>

    <div id="data-penghuni" class="bg-white rounded-xl shadow-md overflow-hidden"></div>
@endsection
