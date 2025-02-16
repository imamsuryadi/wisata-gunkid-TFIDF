<?php

namespace App\Http\Controllers;
Use App\Models\User;
use App\Models\Wisata;
Use App\Models\Kategori;
Use App\Models\Artikel;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $jumlahWisatawan = User::count(); 
        $jumlahWisata = Wisata::count();
        $jumlahKategori = Kategori::count();
        $jumlahArtikel = Artikel::count();

        $kategoriCounts = Kategori::withCount('wisata')->get();
        
        $dataGrafik = User::selectRaw('YEAR(created_at) as tahun, COUNT(*) as jumlah')
        ->groupBy('tahun')
        ->orderBy('tahun')
        ->pluck('jumlah', 'tahun')
        ->toArray();
        
        return view('home', compact('jumlahWisatawan', 'jumlahWisata', 'jumlahKategori', 'jumlahArtikel', 'dataGrafik', 'kategoriCounts'));
    }
}