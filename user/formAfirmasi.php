<?php
require_once '../core/config.php';
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
    <title>Formulir Jalur Afirmasi - <?php echo APP_NAME; ?></title>
    
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
                <div class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill mb-3">JALUR AFIRMASI</div>
                <h2 class="fw-bold">Formulir Pendaftaran</h2>
                <p class="text-muted">Jalur khusus untuk siswa keluarga tidak mampu dan/atau penyandang disabilitas.</p>
            </div>

            <form action="#" method="POST" class="animate-fade-in" enctype="multipart/form-data">
                <!-- Data Siswa (Same as Zonasi but simplified) -->
                <div class="form-section">
                    <h5 class="fw-bold mb-4 d-flex align-items-center">
                        <i class="bi bi-person text-success me-2"></i> Identitas Calon Siswa
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

                <!-- Bagian Afirmasi -->
                <div class="form-section">
                    <h5 class="fw-bold mb-4 d-flex align-items-center">
                        <i class="bi bi-shield-lock text-success me-2"></i> Dokumen Pendukung Afirmasi
                    </h5>
                    <div class="mb-4">
                        <label class="form-label d-block">Jenis Afirmasi</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jenis_afirmasi" id="ekonomi" value="ekonomi" checked>
                            <label class="form-check-label" for="ekonomi">Keluarga Tidak Mampu</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jenis_afirmasi" id="disabilitas" value="disabilitas">
                            <label class="form-check-label" for="disabilitas">Penyandang Disabilitas</label>
                        </div>
                    </div>

                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label">Nomor Kartu (PIP / KKS / PKH)</label>
                            <input type="text" class="form-control" name="nomor_kartu" placeholder="Masukkan nomor bantuan pemerintah">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Unggah Foto Kartu / Surat Keterangan (PDF/JPG)</label>
                            <input type="file" class="form-control" name="file_kartu">
                        </div>
                    </div>
                </div>

                <!-- Pemilihan Sekolah -->
                <div class="form-section">
                    <h5 class="fw-bold mb-4 d-flex align-items-center">
                        <i class="bi bi-building text-success me-2"></i> Pilihan Sekolah
                    </h5>
                    <div class="row g-4">
                        <div class="col-12">
                            <label class="form-label">Pilih SMA Tujuan</label>
                            <select class="form-select" name="pilihan_1" required>
                                <option value="">Cari dan Pilih Sekolah...</option>
                                <option>SMA Negeri 1 Padang</option>
                                <option>SMA Negeri 2 Padang</option>
                                <option>SMA Negeri 3 Padang</option>
                                <option>SMA Negeri 4 Padang</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-success btn-lg rounded-pill px-5 fw-bold shadow-sm">
                        Simpan Pendaftaran <i class="bi bi-check-circle ms-2"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
</body>
</html>
