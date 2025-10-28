<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index(Request $request)
    {
    $search = $request->search;

    $mahasiswa = Mahasiswa::when($search, function ($query) use ($search) {
        return $query->where('nama', 'like', "%$search%")
                     ->orWhere('nim', 'like', "%$search%");
    })
    ->orderBy('nama')
    ->paginate(10)
    ->withQueryString(); // Biar pagination tetap membawa parameter search

    return view('mahasiswa.index', compact('mahasiswa'));
    }

    public function create()
    {
        return view('mahasiswa.create');
    }

    public function store(Request $request)
    {
    $validated = $request->validate([
        'nama' => 'required|string|max:100',
        'nim' => 'required|string|max:20|unique:mahasiswa,nim',
        'email' => 'required|email|max:100|unique:mahasiswa,email',
    ]);

        Mahasiswa::create($validated);
        return redirect()->route('mahasiswa.index')
        ->with('success', 'Data mahasiswa berhasil ditambahkan.');
    }

    public function show(Mahasiswa $mahasiswa)
    {
        return view('mahasiswa.show', compact('mahasiswa'));
    }

    public function edit(Mahasiswa $mahasiswa)
    {
        return view('mahasiswa.edit', compact('mahasiswa'));
    }

    public function update(Request $request, Mahasiswa $mahasiswa)
    {
    $validated = $request->validate([
        'nama' => 'required|string|max:100',
        'nim' => 'required|string|max:20|unique:mahasiswa,nim,' . $mahasiswa->id,
        'email' => 'required|email|max:100|unique:mahasiswa,email,' . $mahasiswa->id,
    ]);

        $mahasiswa->update($validated);
        return redirect()->route('mahasiswa.index')
        ->with('success','Data mahasiswa berhasil diperbarui.');
    }
    public function destroy(Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();
        return redirect()->route('mahasiswa.index')->with('success','Data mahasiswa berhasil dihapus.');
    }
}
