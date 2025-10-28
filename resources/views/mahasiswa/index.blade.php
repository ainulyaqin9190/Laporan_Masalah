@extends('layouts.app')

@section('content')
<style>
    body { background-color: #f4f7fc; }
    .card-custom {
        background: white;
        border-radius: 12px;
        padding: 25px;
        border: none;
        box-shadow: 0 6px 20px rgba(0,0,0,0.06);
    }
    .table-hover tbody tr:hover {
        background-color: #eef6ff;
        transition: 0.2s;
    }
    .table th {
        background-color: #0d6efd !important;
        color: white;
        text-align: center;
    }
    .btn-primary, .btn-success, .btn-warning, .btn-danger {
        border-radius: 8px;
        font-weight: 600;
    }
</style>

<div class="container mt-5">
    <div class="card-custom mb-4">
        <h3 class="fw-bold text-center mb-4 text-primary">
            Data Mahasiswa
        </h3>

        {{-- Alert success --}}
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        {{-- Search & Button Row --}}
        <div class="row mb-4 align-items-center">
            <div class="col-md-8">
                <form action="{{ route('mahasiswa.index') }}" method="GET" style="display: flex; gap: 10px; margin-bottom: 15px;">
                  <input type="text" name="nama" placeholder="Cari berdasarkan Nama..."
                  value="{{ request('nama') }}"
                  style="border: 1px solid #ccc; padding: 8px; border-radius: 6px; width: 220px;">

                  <input type="text" name="nim" placeholder="Cari berdasarkan NIM..."
                  value="{{ request('nim') }}"
                  style="border: 1px solid #ccc; padding: 8px; border-radius: 6px; width: 200px;">

                  <button type="submit"
                  style="background: #2563eb; color: #fff; padding: 8px 16px; border-radius: 6px;">
                  Cari
              </button>
              </form>
            </div>
            <div class="col-md-4 text-end">
                <a href="{{ route('mahasiswa.create') }}" class="btn btn-success px-3">
                    + Tambah Data
                </a>
            </div>
        </div>

        {{-- Table --}}
        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle shadow-sm">
                <thead>
                    <tr>
                        <th style="width: 60px;">No</th>
                        <th>Nama</th>
                        <th>NIM</th>
                        <th>Email</th>
                        <th style="width: 150px;">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @forelse($mahasiswa as $index => $mhs)
                    <tr>
                        <td>{{ $mahasiswa->firstItem() + $index }}</td>
                        <td class="text-start">{{ $mhs->nama }}</td>
                        <td>{{ $mhs->nim }}</td>
                        <td>{{ $mhs->email }}</td>
                        <td>
                            <a href="{{ route('mahasiswa.edit', $mhs->id) }}" 
                               class="btn btn-warning btn-sm mb-1">Edit</a>

                            <form action="{{ route('mahasiswa.destroy', $mhs->id) }}" 
                                  method="POST" class="d-inline"
                                  onsubmit="return confirm('Hapus data ini?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5">Tidak ada data ditemukan</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="d-flex justify-content-center mt-3">
            {{ $mahasiswa->links() }}
        </div>
    </div>
</div>
@endsection