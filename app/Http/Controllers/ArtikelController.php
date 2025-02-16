<?php

namespace App\Http\Controllers;

use App\Models\Artikel; // Pastikan menggunakan huruf kapital pada Models
use Illuminate\Support\Facades\Storage; // Perbaiki penulisan Storage
use Illuminate\Http\Request;

class ArtikelController extends Controller
{
    public function index()
    {
        $artikels = Artikel::all();
        return view('admin.artikel.index', compact('artikels'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'konten' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $gambar = null;
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar')->store('artikel', 'public');
        }

        Artikel::create([
            'judul' => $request->judul,
            'konten' => $request->konten,
            'gambar' => $gambar,
        ]);

        return redirect()->route('artikels.index');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required',
            'konten' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $artikel = Artikel::find($id);

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($artikel->gambar) {
                Storage::disk('public')->delete($artikel->gambar);
            }
            // Simpan gambar baru
            $artikel->gambar = $request->file('gambar')->store('artikel', 'public');
        }

        $artikel->update([
            'judul' => $request->judul,
            'konten' => $request->konten,
            'gambar' => $artikel->gambar,
        ]);

        return redirect()->route('artikels.index');
    }

    public function destroy($id)
    {
        $artikel = Artikel::find($id);
        if ($artikel->gambar) {
            Storage::disk('public')->delete($artikel->gambar); // Pastikan Storage digunakan dengan benar
        }
        $artikel->delete();
        return redirect()->route('artikels.index');
    }
}
