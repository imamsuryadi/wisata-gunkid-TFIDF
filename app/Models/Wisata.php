<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wisata extends Model
{
    use HasFactory;

    protected $table = 'wisata';

    protected $fillable = [
        'nama', 
        'deskripsi', 
        'gambar', 
        'kategori_id', 
        'harga_tiket_masuk', 
        'jam_buka', 
        'jam_tutup', 
        'longitude', 
        'latitude'
    ];

    protected $casts = [
        'gambar' => 'array',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function getFormattedHargaTiketMasukAttribute()
    {
        return 'Rp ' . number_format($this->harga_tiket_masuk, 0, ',', '.');
    }
}
