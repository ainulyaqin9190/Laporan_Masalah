@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">{{ $laporan->judul }}</h1>
    <p class="mb-2"><strong>Mahasiswa:</strong> {{ $laporan->mahasiswa->nama }}</p>
    <p class="mb-2"><strong>Status:</strong> {{ ucfirst($laporan->status) }}</p>
    <p class="mb-4">{{ $laporan->deskripsi }}</p>

    {{-- Tombol Salin Nomor Tiket --}}
    <button 
        onclick="navigator.clipboard.writeText('{{ $laporan->id }}')" 
        class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
        Salin Nomor Tiket
    </button>

    <a href="{{ route('laporan.index') }}" class="ml-4 text-blue-500">Kembali</a>
</div>
@endsection
