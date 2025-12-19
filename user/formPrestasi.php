<?php
require_once '../config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Jalur Prestasi - <?php echo APP_NAME; ?></title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        .form-section {
            background: white;
            border-radius: 16px;
            padding: 2.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        }
        .form-label {
            font-weight: 600;
            color: var(--text-dark);
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }
        .form-control, .form-select {
            border-radius: 10px;
            padding: 0.7rem 1rem;
            border: 1px solid #e2e8f0;
            background-color: #f8fafc;
        }
    </style>
</head>
<body class="bg-gov-light">

<nav class="navbar navbar-expand-lg sticky-top bg-white border-bottom">
    <div class="container">
        <a class="navbar-brand fw-bold d-flex align-items-center" href="dashboard.php">
            <i class="bi bi-arrow-left me-3 fs-4 text-primary"></i>
            <span class="fs-5">Kembali ke Dashboard</span>
        </a>
    </div>
</nav>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Header -->
            <div class="text-center mb-5">
                <div class="badge bg-warning bg-opacity-10 text-warning px-3 py-2 rounded-pill mb-3">JALUR PRESTASI</div>
                <h2 class="fw-bold">Formulir Pendaftaran</h2>
                <p class="text-muted">Jalur pendaftaran bagi siswa berprestasi akademik maupun non-akademik.</p>
            </div>

            <form action="#" method="POST" class="animate-fade-in" enctype="multipart/form-data">
                <!-- Identitas -->
                <div class="form-section">
                    <h5 class="fw-bold mb-4 d-flex align-items-center">
                        <i class="bi bi-person text-warning me-2"></i> Identitas Siswa
                    </h5>
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label">NISN</label>
                            <input type="text" class="form-control" name="nisn" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Nama Lengkap Siswa</label>
                            <input type="text" class="form-control" name="nama" required>
                        </div>
                    </div>
                </div>

                <!-- Nilai Rapor (Akademik) -->
                <div class="form-section">
                    <h5 class="fw-bold mb-4 d-flex align-items-center">
                        <i class="bi bi-journal-check text-warning me-2"></i> Nilai Rapor (Akademik)
                    </h5>
                    <p class="small text-muted mb-4">Input rata-rata nilai rapor mata pelajaran utama sesuai dengan dokumen rapor semester 1 - 5.</p>
                    <div class="row g-3">
                        <div class="col-md-2">
                            <label class="form-label">Sem 1</label>
                            <input type="number" step="0.01" class="form-control" name="rapor_1" placeholder="00.00" required>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Sem 2</label>
                            <input type="number" step="0.01" class="form-control" name="rapor_2" placeholder="00.00" required>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Sem 3</label>
                            <input type="number" step="0.01" class="form-control" name="rapor_3" placeholder="00.00" required>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Sem 4</label>
                            <input type="number" step="0.01" class="form-control" name="rapor_4" placeholder="00.00" required>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Sem 5</label>
                            <input type="number" step="0.01" class="form-control" name="rapor_5" placeholder="00.00" required>
                        </div>
                        <div class="col-md-2 text-primary">
                            <label class="form-label">Rata-rata</label>
                            <input type="text" class="form-control bg-white fw-bold" readonly placeholder="Total">
                        </div>
                    </div>
                </div>

                <!-- Piagam/Sertifikat (Non-Akademik) -->
                <div class="form-section">
                    <h5 class="fw-bold mb-4 d-flex align-items-center">
                        <i class="bi bi-patch-check text-warning me-2"></i> Piagam Penghargaan (Non-Akademik)
                    </h5>
                    <div class="mb-4">
                        <label class="form-label">Tingkat Prestasi Tertinggi</label>
                        <select class="form-select" name="tingkat_prestasi">
                            <option value="">Tidak ada piagam</option>
                            <option value="internasional">Internasional (Juara 1, 2, 3)</option>
                            <option value="nasional">Nasional (Juara 1, 2, 3)</option>
                            <option value="provinsi">Provinsi (Juara 1, 2, 3)</option>
                            <option value="kabkota">Kabupaten/Kota (Juara 1, 2, 3)</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Unggah Piagam (PDF / JPG - Maks 2MB)</label>
                        <input type="file" class="form-control" name="file_piagam">
                    </div>
                </div>

                <!-- Pilihan Sekolah -->
                <div class="form-section">
                    <h5 class="fw-bold mb-4 d-flex align-items-center">
                        <i class="bi bi-building text-warning me-2"></i> Pilihan Sekolah
                    </h5>
                    <div class="row g-4">
                        <div class="col-12">
                            <label class="form-label">Pilih SMA Tujuan</label>
                            <select class="form-select" name="pilihan_1" required>
                                <option value="">Cari dan Pilih Sekolah...</option>
                                <option>SMA Negeri 1 Padang</option>
                                <option>SMA Negeri 2 Padang</option>
                                <option>SMA Negeri 3 Padang</option>
                                <option>SMA Negeri 10 Padang</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-warning btn-lg rounded-pill px-5 fw-bold shadow-sm text-dark">
                        Simpan & Ajukan <i class="bi bi-send-fill ms-2"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
</body>
</html>
