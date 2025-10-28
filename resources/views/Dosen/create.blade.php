@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-xl font-semibold mb-4">Tambah Dosen</h2>

    <form action="{{ route('dosen.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="block">Nama</label>
            <input type="text" name="nama" class="w-full border px-3 py-2 rounded" required>
        </div>

        <div class="mb-3">
            <label class="block">NIDN</label>
            <input type="text" name="nidn" class="w-full border px-3 py-2 rounded" required>
        </div>

        <div class="mb-3">
            <label class="block">Email</label>
            <input type="email" name="email" class="w-full border px-3 py-2 rounded" required>
        </div>

        <button class="bg-blue-600 text-white px-4 py-2 rounded">
            Simpan
        </button>
    </form>
</div>
@endsection
