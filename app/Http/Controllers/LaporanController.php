<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;

class LaporanController extends Controller
{
    // Menampilkan form untuk masyarakat
    public function index()
    {
        return view('laporan.index');
    }

    // Menyimpan laporan dan membuat nomor tiket otomatis
    public function store(Request $request)
    {
        // 1. Logika Membuat Nomor Tiket Otomatis
        $tanggalSekarang = date('Ymd'); // Contoh hasil: 20260916
        
        // Cek laporan terakhir di hari ini untuk bikin nomor urut
        $laporanTerakhir = Laporan::whereDate('created_at', date('Y-m-d'))
                                  ->orderBy('id', 'desc')
                                  ->first();

        if ($laporanTerakhir) {
            // Jika sudah ada laporan hari ini, ambil 3 angka terakhir dan tambah 1
            $nomorUrut = (int) substr($laporanTerakhir->nomor_tiket, -3);
            $nomorUrut++;
        } else {
            // Jika belum ada laporan hari ini, mulai dari 1
            $nomorUrut = 1;
        }

        // Gabungkan jadi format LAP-20260916-001
        // str_pad berfungsi mengubah angka 1 menjadi 001
        $nomorTiket = 'LAP-' . $tanggalSekarang . '-' . str_pad($nomorUrut, 3, '0', STR_PAD_LEFT);

        // 2. Menyimpan data ke database
        $laporan = new Laporan();
        $laporan->nomor_tiket = $nomorTiket;
        $laporan->nama_pelapor = $request->nama_pelapor;
        $laporan->no_telepon = $request->no_telepon;
        $laporan->jenis_laporan = $request->jenis_laporan;
        $laporan->lokasi_kejadian = $request->lokasi_kejadian;
        $laporan->deskripsi = $request->deskripsi;
        // Kolom status otomatis 'Masuk' sesuai aturan di database tadi
        $laporan->save();

        // 3. Setelah nyimpen, kembalikan ke halaman form sambil bawa nomor tiketnya
        return redirect('/lapor')->with('sukses', 'Laporan berhasil dikirim! Nomor Tiket Anda: ' . $nomorTiket);
    }
    // FUNGSI BARU 1: Menampilkan tabel laporan khusus untuk petugas
    public function petugasIndex()
    {
        // Mengambil semua laporan dari yang paling baru
        $semua_laporan = Laporan::orderBy('id', 'desc')->get();
        return view('laporan.admin', compact('semua_laporan'));
    }

    // FUNGSI BARU 2: Mengubah status laporan (Masuk -> Diproses -> Selesai)
    public function updateStatus(Request $request, $id)
    {
        $laporan = Laporan::find($id);
        $laporan->status = $request->status; // Mengambil status baru dari dropdown
        $laporan->save();

        return redirect('/laporan-masuk')->with('pesan', 'Status laporan berhasil diubah!');
    }

    // Menampilkan halaman cek laporan
    public function cekLaporan()
    {
        return view('laporan.cek');
    }

    // Memproses pencarian berdasarkan nomor tiket
    public function cariLaporan(Request $request)
    {
        $request->validate([
            'nomor_tiket' => 'required'
        ]);

        $laporan = Laporan::where('nomor_tiket', $request->nomor_tiket)->first();

        if ($laporan) {
            return view('laporan.cek', compact('laporan'));
        } else {
            return redirect('/cek-laporan')->with('error', 'Nomor tiket tidak valid atau tidak ditemukan.');
        }
    }
}
