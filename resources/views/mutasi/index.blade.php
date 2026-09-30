<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buku Mutasi Digital - Call Center Polres</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2 class="mb-4 text-center fw-bold">Sistem Informasi Call Center Polres</h2>
        
        <div class="row">
            <div class="col-md-12">
                
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Form Input Buku Mutasi</h5>
                    </div>
                    <div class="card-body">
                        <form action="/mutasi" method="POST">
                            @csrf 
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Tanggal:</label>
                                    <input type="date" name="tanggal" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Waktu:</label>
                                    <input type="time" name="waktu" class="form-control" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Nama Petugas Piket:</label>
                                <input type="text" name="petugas" class="form-control" placeholder="Contoh: Brigadir Rezka" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Kejadian / Kegiatan:</label>
                                <input type="text" name="kejadian" class="form-control" placeholder="Contoh: Laporan Pencurian / Patroli Malam" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Keterangan Tambahan:</label>
                                <textarea name="keterangan" class="form-control" rows="3" placeholder="Detail kejadian..."></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary px-4">Simpan Mutasi</button>
                        </form>
                    </div>
                </div>

                <div class="card shadow-sm mb-5">
                    <div class="card-header bg-dark text-white">
                        <h5 class="mb-0">Daftar Mutasi Terkini</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover align-middle">
                                <thead class="table-secondary">
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Waktu</th>
                                        <th>Petugas Piket</th>
                                        <th>Kejadian / Kegiatan</th>
                                        <th>Keterangan</th>
                                        <th width="15%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($semua_mutasi as $data)
                                    <tr>
                                        <td>{{ $data->tanggal }}</td>
                                        <td>{{ $data->waktu }}</td>
                                        <td>{{ $data->petugas }}</td>
                                        <td>{{ $data->kejadian }}</td>
                                        <td>{{ $data->keterangan }}</td>
                                        <td>
                                            <div class="d-flex gap-1">
                                                <a href="/mutasi/{{ $data->id }}/edit" class="btn btn-warning btn-sm w-100">Edit</a>
                                                
                                                <form action="/mutasi/{{ $data->id }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?');" class="w-100">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm w-100">Hapus</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>  
</body>
</html>