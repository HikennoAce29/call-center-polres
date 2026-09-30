<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Layanan Pelaporan Masyarakat - Polres</title>
    <!-- Memanggil CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                
                <div class="text-center mb-4">
                    <h2 class="fw-bold text-primary">Layanan Pelaporan Masyarakat</h2>
                    <p class="text-muted">Polres - Cepat, Tepat, dan Transparan</p>
                </div>

                <!-- Blok Notifikasi: Akan muncul otomatis kalau ada pesan 'sukses' dari Controller -->
                @if(session('sukses'))
                    <div class="alert alert-success alert-dismissible fade show shadow-sm border-0" role="alert">
                        <h4 class="alert-heading fw-bold">Laporan Terkirim!</h4>
                        <p class="mb-0 fs-5">{{ session('sukses') }}</p>
                        <hr>
                        <p class="mb-0 small">Harap catat atau *screenshot* nomor tiket ini untuk mengecek status tindak lanjut laporan Anda nantinya.</p>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="card shadow border-0">
                    <div class="card-header bg-primary text-white py-3">
                        <h5 class="mb-0">Formulir Laporan Baru</h5>
                    </div>
                    <div class="card-body p-4">
                        <!-- Mengarah ke Route POST /lapor -->
                        <form action="/lapor" method="POST">
                            @csrf
                            
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Nama Lengkap:</label>
                                    <input type="text" name="nama_pelapor" class="form-control" placeholder="Sesuai KTP" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">No. Telepon / WhatsApp:</label>
                                    <input type="text" name="no_telepon" class="form-control" placeholder="Contoh: 08123456789" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Jenis Laporan:</label>
                                <select name="jenis_laporan" class="form-select" required>
                                    <option value="" selected disabled>-- Pilih Jenis Laporan --</option>
                                    <option value="Kehilangan">Kehilangan Barang / Dokumen</option>
                                    <option value="Tindak Pidana">Tindak Pidana (Pencurian, Penipuan, dll)</option>
                                    <option value="Kecelakaan">Kecelakaan Lalu Lintas</option>
                                    <option value="Gangguan Kamtibmas">Gangguan Kamtibmas / Keributan</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Lokasi Kejadian:</label>
                                <input type="text" name="lokasi_kejadian" class="form-control" placeholder="Alamat lengkap atau patokan lokasi" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Deskripsi Kejadian:</label>
                                <textarea name="deskripsi" class="form-control" rows="4" placeholder="Ceritakan kronologi singkat kejadian..." required></textarea>
                            </div>

                            <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-primary btn-lg">Kirim Laporan</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Memanggil JS Bootstrap (wajib supaya tombol silang di notifikasi bisa diklik) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>