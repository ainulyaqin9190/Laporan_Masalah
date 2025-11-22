@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto p-6 bg-white rounded shadow">
    <h1 class="text-2xl font-bold mb-4">Tambah Dosen</h1>

    @if($errors->any())
        <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('dosen.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="nama" class="block font-medium mb-1">Nama</label>
            <input type="text" name="nama" id="nama" class="w-full border rounded px-3 py-2" value="{{ old('nama') }}">
        </div>

        <div class="mb-4">
            <label for="nidn" class="block font-medium mb-1">NIDN</label>
            <input type="text" name="nidn" id="nidn" class="w-full border rounded px-3 py-2" value="{{ old('nidn') }}">
        </div>

        <div class="mb-4">
            <label for="email" class="block font-medium mb-1">Email</label>
            <input type="email" name="email" id="email" class="w-full border rounded px-3 py-2" value="{{ old('email') }}">
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Simpan</button>
        <a href="{{ route('dosen.index') }}" class="ml-2 text-gray-700 hover:underline">Batal</a>
    </form>
</div>
@endsection
