@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto p-6 bg-white rounded shadow">
    <h1 class="text-2xl font-bold mb-4">Detail Dosen</h1>

    <div class="mb-4">
        <p><span class="font-medium">Nama:</span> {{ $dosen->nama }}</p>
        <p><span class="font-medium">NIDN:</span> {{ $dosen->nidn }}</p>
        <p><span class="font-medium">Email:</span> {{ $dosen->email }}</p>
    </div>

    <div class="flex space-x-2">
        <a href="{{ route('dosen.edit', $dosen->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Edit</a>

        <form action="{{ route('dosen.destroy', $dosen->id) }}" method="POST" onsubmit="return confirm('Apakah yakin ingin menghapus?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Hapus</button>
        </form>

        <a href="{{ route('dosen.index') }}" class="text-gray-700 px-4 py-2 rounded hover:underline">Kembali</a>
    </div>
</div>
@endsection
