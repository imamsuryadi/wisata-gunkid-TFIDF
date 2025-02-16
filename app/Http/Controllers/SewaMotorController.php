<?php

namespace App\Http\Controllers;

use App\Models\SewaMotor;
use App\Models\Wisata;
use Illuminate\Http\Request;

class SewaMotorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $sewaMotors = SewaMotor::with('wisata')->get();
    $wisatas = Wisata::all(); // Ambil data wisata dari tabel wisata
    return view('admin.sewaMotor.index', compact('sewaMotors', 'wisatas'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $wisatas = Wisata::all();
        return view('admin.sewaMotor.create', compact('wisatas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'string|max:255',
            'lokasi' => 'required|url',
            'wisata_id' => 'required|exists:wisata,id',
        ]);

        SewaMotor::create($request->all());

        return redirect()->route('sewaMotor.index')->with('success', 'Sewa Motor berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $sewaMotor = SewaMotor::findOrFail($id);
        $wisatas = Wisata::all();
        return view('admin.sewaMotor.edit', compact('sewaMotor', 'wisatas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'lokasi' => 'required|url',
            'wisata_id' => 'required|exists:wisata,id',
        ]);

        $sewaMotor = SewaMotor::findOrFail($id);
        $sewaMotor->update($request->all());

        return redirect()->route('sewaMotor.index')->with('success', 'Sewa Motor berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $sewaMotor = SewaMotor::findOrFail($id);
        $sewaMotor->delete();

        return redirect()->route('sewaMotor.index')->with('success', 'Sewa Motor berhasil dihapus.');
    }
}
