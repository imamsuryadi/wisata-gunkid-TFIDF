<?php

namespace App\Http\Controllers;

use App\Models\Wisata;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WisataController extends Controller
{
    public function index()
    {
        $wisatas = Wisata::all();
        $kategoris = Kategori::all();
        return view('admin.wisata.index', compact('wisatas', 'kategoris'));
    }
    public function filter($kategoriId)
    {
        try {
            $wisata = Wisata::where('kategori_id', $kategoriId)->get();
            return response()->json($wisata);
           
        } catch (\Exception $e) {
            return response()->json(['error' => 'Data not found'], 404);
        }
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('wisata.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required',
            'gambar.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'kategori_id' => 'required|exists:kategori,id',
            'harga_tiket_masuk' => 'required|numeric',
            'jam_buka' => 'required',
            'jam_tutup' => 'required',
            'longitude' => 'required|numeric',
            'latitude' => 'required|numeric',
        ]);

        $gambarPaths = [];
        if ($request->hasFile('gambar')) {
            foreach ($request->file('gambar') as $gambar) {
                $path = $gambar->store('public/wisata');
                $gambarPaths[] = Storage::url($path);
            }
        }

        Wisata::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'gambar' => json_encode($gambarPaths),
            'kategori_id' => $request->kategori_id,
            'harga_tiket_masuk' => $request->harga_tiket_masuk,
            'jam_buka' => $request->jam_buka,
            'jam_tutup' => $request->jam_tutup,
            'longitude' => $request->longitude,
            'latitude' => $request->latitude,
        ]);

        return redirect()->route('wisata.index')->with('success', 'Wisata created successfully.');
    }

    public function show(Wisata $wisatum)
    {
        return view('wisata.show', compact('wisatum'));
    }

    public function edit(Wisata $wisatum)
    {
        $kategoris = Kategori::all();
        return view('wisata.edit', compact('wisatum', 'kategoris'));
    }

    public function update(Request $request, Wisata $wisatum)
    {
        // Validasi data
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required',
            'gambar.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'kategori_id' => 'required|exists:kategori,id',
            'harga_tiket_masuk' => 'required|numeric',
            'jam_buka' => 'required',
            'jam_tutup' => 'required',
            'longitude' => 'required|numeric',
            'latitude' => 'required|numeric',
        ]);

        // Ambil gambar lama
        $gambarPaths = json_decode($wisatum->gambar, true) ?? [];

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama dari penyimpanan
            foreach ($gambarPaths as $gambar) {
                $filePath = public_path(str_replace('/storage', 'storage', $gambar));
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }

            // Simpan gambar baru
            $gambarPaths = []; // Reset array gambarPaths untuk gambar baru
            foreach ($request->file('gambar') as $gambar) {
                $path = $gambar->store('public/wisata');
                $gambarPaths[] = Storage::url($path);
            }
        }

        // Update data wisata
        $wisatum->update([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'gambar' => json_encode($gambarPaths),
            'kategori_id' => $request->kategori_id,
            'harga_tiket_masuk' => $request->harga_tiket_masuk,
            'jam_buka' => $request->jam_buka,
            'jam_tutup' => $request->jam_tutup,
            'longitude' => $request->longitude,
            'latitude' => $request->latitude,
        ]);

        return redirect()->route('wisata.index')->with('success', 'Wisata updated successfully.');
    }

    public function destroy(Wisata $wisatum)
    {
        $gambarPaths = json_decode($wisatum->gambar, true);
        if ($gambarPaths) {
            foreach ($gambarPaths as $path) {
                Storage::delete($path);
            }
        }

        $wisatum->delete();

        return redirect()->route('wisata.index')->with('success', 'Wisata deleted successfully.');
    }
}
