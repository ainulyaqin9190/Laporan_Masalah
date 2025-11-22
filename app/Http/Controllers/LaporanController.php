<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Laporan;
use App\Models\Mahasiswa;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $query = Laporan::with('mahasiswa')->latest();

        if ($request->filled('status') && in_array($request->status, ['baru','diproses','selesai'])) {
            $query->where('status', $request->status);
        }

        $laporans = $query->paginate(10)->withQueryString();
        return view('laporan.index', compact('laporans'));
    }

    public function create()
    {
        $mahasiswas = Mahasiswa::all();
        return view('laporan.create', compact('mahasiswas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => ['required','string','max:150'],
            'deskripsi' => ['required','string','max:2000'],
        ]);

        $nomorLaporan = $this->generateNomorLaporan();

        $laporan = \App\Models\Laporan::create([
            'judul' => $validated['judul'],
            'deskripsi' => $validated['deskripsi'],
            'nomor_laporan' => $nomorLaporan,
            'status' => 'baru',
            'mahasiswa_id' => auth()->id(), // otomatis ambil user login
        ]);

        return redirect()->route('laporan.show', $laporan)
            ->with('success','Laporan berhasil dibuat dengan nomor tiket: '.$nomorLaporan);
    }

     private function generateNomorLaporan(): string
    {
        // Format: LAP-YYYYMMDD-HHMMSS-AB12
        return 'LAP-'.now()->format('Ymd-His').'-'.Str::upper(Str::random(4));
    }

    public function show(Laporan $laporan)
    {
        return view('laporan.show', compact('laporan'));
    }

    public function edit(Laporan $laporan)
    {
        $mahasiswas = Mahasiswa::all();
        return view('laporan.edit', compact('laporan', 'mahasiswas'));
    }

    public function update(Request $request, Laporan $laporan)
    {
        $request->validate([
            'judul' => 'required|min:10',
            'deskripsi' => 'required|min:20',
            'status' => 'required|in:baru,diproses,selesai',
            'mahasiswa_id' => 'required|exists:mahasiswas,id',
        ]);

        $data = [
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'status' => $request->status,
            'mahasiswa_id' => $request->mahasiswa_id,
        ];

        if ($laporan->status !== $request->status) {
            $data['status_updated_at'] = now();
        }

        $laporan->update($data);

        return redirect()->route('laporan.index')->with('success', 'Laporan berhasil diperbarui.');
    }

    public function destroy(Laporan $laporan)
    {
        $laporan->delete();
        return redirect()->route('laporan.index')->with('success', 'Laporan berhasil dihapus.');
    }
}
