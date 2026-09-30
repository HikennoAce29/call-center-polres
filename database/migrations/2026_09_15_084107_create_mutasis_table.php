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
    Schema::create('mutasis', function (Blueprint $table) {
        $table->id();
        $table->date('tanggal');
        $table->time('waktu');
        $table->string('petugas'); // Nama petugas piket
        $table->string('kejadian'); // Judul kejadian/kegiatan
        $table->text('keterangan')->nullable(); // Penjelasan detail, boleh kosong
        $table->softDeletes(); // Ini fitur keamanan data (Soft Deletes) yang gw saranin tadi
        $table->timestamps(); // Otomatis mencatat kapan data dibuat (anti-manipulasi waktu)
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mutasis');
    }
};
