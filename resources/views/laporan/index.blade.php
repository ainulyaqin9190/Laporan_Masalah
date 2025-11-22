@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Daftar Laporan</h1>
        <a href="{{ route('laporan.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Buat Laporan</a>
    </div>

    <!-- Filter Status -->
    <form method="GET" action="{{ route('laporan.index') }}" class="mb-4">
        <select name="status" onchange="this.form.submit()" class="border px-2 py-1 rounded">
            <option value="">Semua Status</option>
            <option value="baru" {{ request('status') === 'baru' ? 'selected' : '' }}>Baru</option>
            <option value="diproses" {{ request('status') === 'diproses' ? 'selected' : '' }}>Diproses</option>
            <option value="selesai" {{ request('status') === 'selesai' ? 'selected' : '' }}>Selesai</option>
        </select>
    </form>

    <table class="min-w-full border border-gray-200">
        <thead>
            <tr class="bg-gray-100">
                <th class="px-4 py-2 border">No</th>
                <th class="px-4 py-2 border">Judul</th>
                <th class="px-4 py-2 border">Pelapor</th>
                <th class="px-4 py-2 border">Status</th>
                <th class="px-4 py-2 border">Update Terakhir</th>
                <th class="px-4 py-2 border">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($laporans as $laporan)
            <tr>
                <td class="px-4 py-2 border">{{ $loop->iteration + ($laporans->currentPage()-1)*$laporans->perPage() }}</td>
                <td class="px-4 py-2 border">{{ $laporan->judul }}</td>
                <td class="px-4 py-2 border">{{ $laporan->mahasiswa->nama ?? '-' }}</td>
                <td class="px-4 py-2 border">
                    @php
                        $color = $laporan->status === 'selesai' ? 'green' : ($laporan->status === 'diproses' ? 'yellow' : 'red');
                    @endphp
                    <span class="px-2 py-1 rounded bg-{{ $color }}-100 text-{{ $color }}-800 border border-{{ $color }}-200 text-sm">
                        {{ ucfirst($laporan->status) }}
                    </span>
                </td>
                <td class="px-4 py-2 border">
                    {{ $laporan->status_updated_at ? \Carbon\Carbon::parse($laporan->status_updated_at)->format('d-m-Y H:i') : '-' }}
                </td>
                <td class="px-4 py-2 border">
                    <a href="{{ route('laporan.show', $laporan) }}" class="text-blue-700 hover:underline">Lihat</a>
                    <a href="{{ route('laporan.edit', $laporan) }}" class="ml-3 text-yellow-600 hover:underline">Edit</a>

                    <!-- Tombol Ubah Status Cepat -->
                    @if(in_array($laporan->status, ['baru', 'diproses']))
                    <form action="{{ route('laporan.update', $laporan) }}" method="POST" class="inline-block ml-3">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="judul" value="{{ $laporan->judul }}">
                        <input type="hidden" name="deskripsi" value="{{ $laporan->deskripsi }}">
                        <input type="hidden" name="mahasiswa_id" value="{{ $laporan->mahasiswa_id }}">
                        <input type="hidden" name="status" value="{{ $laporan->status === 'baru' ? 'diproses' : 'selesai' }}">
                        <button type="submit" class="text-green-600 hover:underline">
                            {{ $laporan->status === 'baru' ? 'Proses' : 'Selesaikan' }}
                        </button>
                    </form>
                    @endif

                    <!-- Hapus -->
                    <form action="{{ route('laporan.destroy', $laporan) }}" method="POST" class="inline-block ml-3" onsubmit="return confirm('Yakin hapus laporan?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $laporans->links() }}
    </div>
</div>
@endsection
