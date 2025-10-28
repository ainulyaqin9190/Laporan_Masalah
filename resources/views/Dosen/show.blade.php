@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-xl font-semibold mb-4">Detail Dosen</h2>

    <p><strong>Nama:</strong> {{ $dosen->nama }}</p>
    <p><strong>NIDN:</strong> {{ $dosen->nidn }}</p>
    <p><strong>Email:</strong> {{ $dosen->email }}</p>

    <div class="mt-4 flex gap-2">
        <a href="{{ route('dosen.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded">Kembali</a>
        <a href="{{ route('dosen.edit', $dosen) }}" class="bg-blue-600 text-white px-4 py-2 rounded">Edit</a>
    </div>
</div>
@endsection
