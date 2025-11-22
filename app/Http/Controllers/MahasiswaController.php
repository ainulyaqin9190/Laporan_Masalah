<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\mahasiswa;

class MahasiswaController extends Controller
{
    // Tampilkan daftar mahasiswa
    public function index()
    {
        $mahasiswas = \App\Models\Mahasiswa::orderBy('nama')->paginate(10);
        return view('mahasiswa.index', compact('mahasiswas'));
    }

    // Tampilkan form tambah mahasiswa
    public function create()
    {
        return view('mahasiswa.create');
    }
    // Simpan mahasiswa baru
    public function store(\Illuminate\Http\Request $request)
    {
        $validated = $request->validate([
            'nama' => ['required','string','max:100'],
            'nim'  => ['required','string','max:20','unique:mahasiswas,nim'],
            'email'=> ['required','email','max:100','unique:mahasiswas,email'],
        ]);

        \App\Models\Mahasiswa::create($validated);

        return redirect()->route('mahasiswa.index')->with('success','Data mahasiswa berhasil ditambahkan.');
    }

    // Tampilkan form edit mahasiswa
    public function edit(\App\Models\Mahasiswa $mahasiswa)
    {
        return view('mahasiswa.edit', compact('mahasiswa'));
    }

    // Update mahasiswa
    public function update(\Illuminate\Http\Request $request, \App\Models\Mahasiswa $mahasiswa)
    {
        $validated = $request->validate([
            'nama' => ['required','string','max:100'],
            'nim'  => ['required','string','max:20','unique:mahasiswas,nim,'.$mahasiswa->id],
            'email'=> ['required','email','max:100','unique:mahasiswas,email,'.$mahasiswa->id],
        ]);

        $mahasiswa->update($validated);

        return redirect()->route('mahasiswa.index')->with('success','Data mahasiswa berhasil diperbarui.');
    }

    // melihat mahasiswa
    public function show(\App\Models\Mahasiswa $mahasiswa)
    {
        return view('mahasiswa.show', compact('mahasiswa'));
    }

    // Hapus mahasiswa
    public function destroy(\App\Models\Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();
        return redirect()->route('mahasiswa.index')->with('success','Data mahasiswa berhasil dihapus.');
    }
}
