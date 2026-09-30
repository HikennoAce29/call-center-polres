<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mutasi;

class MutasiController extends Controller
{
    public function index()
    {
        $semua_mutasi = Mutasi::orderBy('id', 'desc')->get();
        return view('mutasi.index', compact('semua_mutasi'));
    }

    public function store(Request $request)
    {
        $mutasi = new Mutasi();
        $mutasi->tanggal = $request->tanggal;
        $mutasi->waktu = $request->waktu;
        $mutasi->petugas = $request->petugas;
        $mutasi->kejadian = $request->kejadian;
        $mutasi->keterangan = $request->keterangan;
        $mutasi->save();

        return redirect('/mutasi');
    }

    // FUNGSI BARU: Mengambil data yang mau diedit lalu membuka halaman form edit
    public function edit($id)
    {
        $mutasi = Mutasi::find($id);
        return view('mutasi.edit', compact('mutasi'));
    }

    // FUNGSI BARU: Menyimpan perubahan data ke database
    public function update(Request $request, $id)
    {
        $mutasi = Mutasi::find($id);
        $mutasi->tanggal = $request->tanggal;
        $mutasi->waktu = $request->waktu;
        $mutasi->petugas = $request->petugas;
        $mutasi->kejadian = $request->kejadian;
        $mutasi->keterangan = $request->keterangan;
        $mutasi->save();

        return redirect('/mutasi');
    }

    public function destroy($id)
    {
        $mutasi = Mutasi::find($id);
        $mutasi->delete();

        return redirect('/mutasi');
    }
}