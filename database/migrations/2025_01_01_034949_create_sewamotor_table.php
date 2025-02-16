<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sewamotor', function (Blueprint $table) {
            $table->id();
            $table->string('nama'); // Nama penyewaan motor
            $table->text('lokasi'); // Alamat atau lokasi Google Maps
            $table->text('deskripsi'); // Alamat atau lokasi Google Maps
            $table->foreignId('wisata_id') // Relasi ke tabel wisata
                ->constrained('wisata')
                ->onDelete('cascade'); // Menghapus data sewamotor jika wisata terkait dihapus
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sewamotor');
    }
};
