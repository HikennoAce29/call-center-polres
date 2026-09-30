<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Laporan Masuk - Petugas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <!-- Navbar Sederhana -->
    <nav class="navbar navbar-dark bg-dark mb-4">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1">Dashboard Petugas - Polres</span>
            <a href="/mutasi" class="btn btn-outline-light btn-sm">Ke Buku Mutasi</a>
        </div>
    </nav>

    <div class="container-fluid px-4">
        <h3 class="mb-4 fw-bold">Daftar Laporan Masyarakat</h3>

        @if(session('pesan'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('pesan') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover align-middle">
                        <thead class="table-primary text-center">
                            <tr>
                                <th>No. Tiket</th>
                                <th>Waktu Lapor</th>
                                <th>Pelapor (No. HP)</th>
                                <th>Jenis & Lokasi</th>
                                <th>Deskripsi Kejadian</th>
                                <th>Status Saat Ini</th>
                                <th width="15%">Aksi / Proses</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($semua_laporan as $data)
                            <tr>
                                <td class="text-center fw-bold text-primary">{{ $data->nomor_tiket }}</td>
                                <td>{{ $data->created_at }}</td>
                                <td>
                                    <strong>{{ $data->nama_pelapor }}</strong><br>
                                    <span class="text-muted">{{ $data->no_telepon }}</span>
                                </td>
                                <td>
                                    <span class="badge bg-secondary mb-1">{{ $data->jenis_laporan }}</span><br>
                                    {{ $data->lokasi_kejadian }}
                                </td>
                                <td>{{ $data->deskripsi }}</td>
                                
                                <!-- Menampilkan badge warna-warni berdasarkan status -->
                                <td class="text-center">
                                    @if($data->status == 'Masuk')
                                        <span class="badge bg-danger fs-6">Masuk</span>
                                    @elseif($data->status == 'Diproses')
                                        <span class="badge bg-warning text-dark fs-6">Diproses</span>
                                    @else
                                        <span class="badge bg-success fs-6">Selesai</span>
                                    @endif
                                </td>

                                <!-- Form untuk mengubah status -->
                                <td>
                                    <form action="/laporan-masuk/{{ $data->id }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="input-group input-group-sm">
                                            <select name="status" class="form-select">
                                                <option value="Masuk" {{ $data->status == 'Masuk' ? 'selected' : '' }}>Masuk</option>
                                                <option value="Diproses" {{ $data->status == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                                                <option value="Selesai" {{ $data->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                            </select>
                                            <button class="btn btn-success" type="submit">Ubah</button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>