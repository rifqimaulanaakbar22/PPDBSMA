<?php
require_once '../core/config.php';
session_start();

// Redirect if not logged in
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
    <title>Dashboard Siswa - <?php echo APP_NAME; ?></title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="bg-gov-light">

<!-- Navbar Dashboard -->
<nav class="navbar navbar-expand-lg sticky-top border-bottom">
    <div class="container">
        <a class="navbar-brand fw-bold d-flex align-items-center" href="../index.php">
            <img src="../tutwurinobg.png" alt="Logo" width="40" height="40" class="me-2">
            <span class="d-none d-sm-inline">PPDB SMA Padang</span>
        </a>
        <div class="ms-auto d-flex align-items-center">
            <div class="dropdown">
                <a class="nav-link dropdown-toggle d-flex align-items-center gap-2" href="#" role="button" data-bs-toggle="dropdown">
                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;">
                        <i class="bi bi-person"></i>
                    </div>
                    <span class="fw-semibold d-none d-md-inline"><?php echo $username; ?></span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                    <li><a class="dropdown-item" href="#"><i class="bi bi-person-gear me-2"></i> Profil Saya</a></li>
                    <li><a class="dropdown-item" href="#"><i class="bi bi-file-earmark-text me-2"></i> Berkas Saya</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item text-danger" href="logout.php"><i class="bi bi-box-arrow-right me-2"></i> Keluar</a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<div class="container py-5">
    <!-- Welcome Header -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="card border-0 shadow-sm p-4 bg-primary text-white" style="border-radius: 20px;">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h2 class="fw-bold mb-2">Halo, <?php echo $username; ?>! 👋</h2>
                        <p class="mb-0 opacity-75">Selamat datang di portal pendaftaran PPDB SMA Negeri Kota Padang. Silakan pilih jalur pendaftaran yang sesuai dengan kondisi Anda.</p>
                    </div>
                    <div class="col-md-4 text-md-end mt-3 mt-md-0">
                        <div class="badge bg-white text-primary px-3 py-2 rounded-pill fw-bold">Status: Belum Terdaftar</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="row g-4">
        <!-- Left Column: Forms -->
        <div class="col-lg-8">
            <h5 class="fw-bold mb-4">Pendaftaran Jalur Tersedia</h5>
            <div class="row g-3">
                <!-- Jalur Zonasi -->
                <div class="col-md-6">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body p-4">
                            <div class="feature-icon-wrapper bg-primary bg-opacity-10 mb-3">
                                <i class="bi bi-geo-alt fs-3 text-primary"></i>
                            </div>
                            <h5 class="fw-bold">Jalur Zonasi</h5>
                            <p class="small text-muted">Berdasarkan jarak domisili ke sekolah tujuan. Kuota terbesar (50%).</p>
                            <a href="formZonasi.php" class="btn btn-outline-primary btn-sm rounded-pill px-4 mt-2">Daftar Sekarang</a>
                        </div>
                    </div>
                </div>
                <!-- Jalur Afirmasi -->
                <div class="col-md-6">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body p-4">
                            <div class="feature-icon-wrapper bg-success bg-opacity-10 mb-3">
                                <i class="bi bi-heart fs-3 text-success"></i>
                            </div>
                            <h5 class="fw-bold">Jalur Afirmasi</h5>
                            <p class="small text-muted">Siswa dari keluarga tidak mampu & disabilitas. Kuota (15%).</p>
                            <a href="formAfirmasi.php" class="btn btn-outline-success btn-sm rounded-pill px-4 mt-2">Daftar Sekarang</a>
                        </div>
                    </div>
                </div>
                <!-- Jalur Prestasi -->
                <div class="col-md-6">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body p-4">
                            <div class="feature-icon-wrapper bg-warning bg-opacity-10 mb-3">
                                <i class="bi bi-trophy fs-3 text-warning"></i>
                            </div>
                            <h5 class="fw-bold">Jalur Prestasi</h5>
                            <p class="small text-muted">Prestasi akademik & non-akademik. Kuota (30%).</p>
                            <a href="formPrestasi.php" class="btn btn-outline-warning btn-sm rounded-pill px-4 mt-2">Daftar Sekarang</a>
                        </div>
                    </div>
                </div>
                <!-- Jalur Mutasi -->
                <div class="col-md-6">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body p-4">
                            <div class="feature-icon-wrapper bg-danger bg-opacity-10 mb-3">
                                <i class="bi bi-arrow-left-right fs-3 text-danger"></i>
                            </div>
                            <h5 class="fw-bold">Jalur Perpindahan</h5>
                            <p class="small text-muted">Perpindahan tugas orang tua/wali atau anak GTK. Kuota (5%).</p>
                            <a href="formMutasi.php" class="btn btn-outline-danger btn-sm rounded-pill px-4 mt-2">Daftar Sekarang</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column: Info & Status -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm mb-4" style="border-radius: 16px;">
                <div class="card-body p-4">
                    <h6 class="fw-bold mb-4">Informasi Penting</h6>
                    <div class="d-flex mb-3">
                        <div class="bg-primary bg-opacity-10 text-primary rounded p-2 me-3" style="height: fit-content;">
                            <i class="bi bi-info-circle"></i>
                        </div>
                        <div>
                            <p class="small fw-bold mb-1">Cek NISN</p>
                            <p class="small text-muted mb-0">Pastikan NISN Anda terdaftar di Dapodik sebelum mengisi formulir.</p>
                        </div>
                    </div>
                    <div class="d-flex mb-3">
                        <div class="bg-warning bg-opacity-10 text-warning rounded p-2 me-3" style="height: fit-content;">
                            <i class="bi bi-exclamation-triangle"></i>
                        </div>
                        <div>
                            <p class="small fw-bold mb-1">Satu Jalur Saja</p>
                            <p class="small text-muted mb-0">Setiap siswa hanya boleh memilih satu jalur pendaftaran.</p>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="bg-success bg-opacity-10 text-success rounded p-2 me-3" style="height: fit-content;">
                            <i class="bi bi-shield-check"></i>
                        </div>
                        <div>
                            <p class="small fw-bold mb-1">Verifikasi Pangkalan</p>
                            <p class="small text-muted mb-0">Data Anda akan diverifikasi langsung oleh operator sekolah asal.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm bg-dark text-white p-4" style="border-radius: 16px;">
                <h6 class="fw-bold mb-3">Butuh Bantuan?</h6>
                <p class="small opacity-75 mb-4">Tim helpdesk kami siap membantu jika Anda mengalami kesulitan dalam proses pendaftaran.</p>
                <a href="#" class="btn btn-light w-100 rounded-pill fw-bold small">Hubungi WhatsApp</a>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
