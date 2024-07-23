<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Wisata;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    public function index()
    {
        $kategori = Kategori::all();
        $wisata = Wisata::all();
        return view('welcome', compact('kategori', 'wisata'));
    }

    public function detail($id)
    {
        $wisata = Wisata::findOrFail($id);
        $rekomendasiWisata = Wisata::where('id', '!=', $id)->inRandomOrder()->limit(3)->get();
        return view('detail_wisata', compact('wisata', 'rekomendasiWisata'));
    }

    public function allWisata(){
        $wisata = Wisata::all();
        $kategori = Kategori::all();
        return view('semua_wisata', compact('wisata', 'kategori'));
    }
}
