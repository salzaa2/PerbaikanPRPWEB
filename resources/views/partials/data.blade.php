<table class="w-full text-left">
    <thead class="bg-blue-600 text-white">
        <tr>
            <th class="p-3">Nama</th>
            <th class="p-3">No. Kamar</th>
            <th class="p-3">Tanggal Masuk</th>
            <th class="p-3">Status</th>
            <th class="p-3">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($penghunis as $p)
            <tr class="border-b hover:bg-gray-50">
                <td class="p-3">{{ $p->nama }}</td>
                <td class="p-3">{{ $p->no_kamar }}</td>
                <td class="p-3">{{ $p->tanggal_masuk }}</td>
                <td class="p-3">
                    <span class="px-2 py-1 text-sm rounded {{ $p->status == 'Aktif' ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800' }}">
                        {{ $p->status }}
                    </span>
                </td>
                <td class="p-3">
                    <button onclick="editData({{ $p->id }})" class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded mr-2">Edit</button>
                    <button onclick="deleteData({{ $p->id }})" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">Hapus</button>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="p-3 text-center text-gray-500">Tidak ada data penghuni.</td>
            </tr>
        @endforelse
    </tbody>
</table>
