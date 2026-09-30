<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Status Laporan</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Form Cek Laporan -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Cek Status Laporan</h4>
                </div>
                <div class="card-body">
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('cek-laporan.cari') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nomor_tiket" class="form-label">Masukkan Nomor Tiket</label>
                            <input type="text" class="form-control @error('nomor_tiket') is-invalid @enderror" id="nomor_tiket" name="nomor_tiket" placeholder="Contoh: LAP-20260916-001" required>
                            @error('nomor_tiket')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Cek Laporan</button>
                    </form>
                </div>
            </div>

            <!-- Hasil Pencarian -->
            @if(isset($laporan))
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Hasil Pencarian Tiket: {{ $laporan->nomor_tiket }}</h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th width="30%">Nama Pelapor</th>
                            <td>{{ $laporan->nama_pelapor }}</td>
                        </tr>
                        <tr>
                            <th>No. Telepon</th>
                            <td>{{ $laporan->no_telepon }}</td>
                        </tr>
                        <tr>
                            <th>Jenis Laporan</th>
                            <td>{{ $laporan->jenis_laporan }}</td>
                        </tr>
                        <tr>
                            <th>Lokasi Kejadian</th>
                            <td>{{ $laporan->lokasi_kejadian }}</td>
                        </tr>
                        <tr>
                            <th>Deskripsi</th>
                            <td>{{ $laporan->deskripsi }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Dilaporkan</th>
                            <td>{{ $laporan->created_at->format('d M Y, H:i') }}</td>
                        </tr>
                        <tr>
                            <th>Status Saat Ini</th>
                            <td>
                                @if($laporan->status == 'Masuk')
                                    <span class="badge bg-danger">Masuk</span>
                                @elseif($laporan->status == 'Diproses')
                                    <span class="badge bg-warning text-dark">Diproses</span>
                                @elseif($laporan->status == 'Selesai')
                                    <span class="badge bg-success">Selesai</span>
                                @else
                                    <span class="badge bg-secondary">{{ $laporan->status }}</span>
                                @endif
                            </td>
                        </tr>
                    </table>
                    <div class="text-center mt-3">
                        <a href="{{ route('cek-laporan') }}" class="btn btn-outline-secondary">Cari Tiket Lain</a>
                    </div>
                </div>
            </div>
            @endif

        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
