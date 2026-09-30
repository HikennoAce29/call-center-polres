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
    Schema::create('laporans', function (Blueprint $table) {
        $table->id();
        $table->string('nomor_tiket')->unique(); // Nomor unik buat warga ngecek laporannya
        $table->string('nama_pelapor');
        $table->string('no_telepon');
        $table->string('jenis_laporan'); // Contoh: Kehilangan, Tindak Pidana, Bencana, dll
        $table->text('lokasi_kejadian');
        $table->text('deskripsi');
        $table->enum('status', ['Masuk', 'Diproses', 'Selesai'])->default('Masuk'); // Status default
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporans');
    }
};
