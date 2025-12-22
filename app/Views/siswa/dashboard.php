<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - <?php echo APP_NAME; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo asset('css/style.css'); ?>">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg sticky-top bg-white border-bottom">
    <div class="container">
        <a class="navbar-brand fw-bold d-flex align-items-center" href="<?php echo url('/'); ?>">
            <img src="<?php echo asset('img/tutwurinobg.png'); ?>" alt="Logo" width="40" height="40" class="me-2">
            PPDB SMA Padang
        </a>
        <div class="ms-auto d-flex align-items-center">
            <div class="dropdown">
                <a class="nav-link dropdown-toggle d-flex align-items-center gap-2" href="#" data-bs-toggle="dropdown">
                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;">
                        <i class="bi bi-person"></i>
                    </div>
                    <span class="fw-semibold d-none d-md-inline"><?php echo e($username); ?></span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                    <li><a class="dropdown-item" href="#"><i class="bi bi-person-gear me-2"></i>Profil</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item text-danger" href="<?php echo url('/logout'); ?>"><i class="bi bi-box-arrow-right me-2"></i>Keluar</a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<div class="container py-5">
    <!-- Welcome -->
    <div class="card border-0 shadow-sm p-4 bg-primary text-white mb-5" style="border-radius: 20px;">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h2 class="fw-bold mb-2">Halo, <?php echo e($username); ?>! 👋</h2>
                <p class="mb-0 opacity-75">Selamat datang di portal pendaftaran PPDB SMA Negeri Kota Padang.</p>
            </div>
            <div class="col-md-4 text-md-end mt-3 mt-md-0">
                <span class="badge bg-white text-primary px-3 py-2 rounded-pill">Status: Belum Terdaftar</span>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <!-- Forms -->
        <div class="col-lg-8">
            <h5 class="fw-bold mb-4">Pilih Jalur Pendaftaran</h5>
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body p-4">
                            <div class="bg-primary bg-opacity-10 rounded-circle p-3 mb-3" style="width: fit-content;">
                                <i class="bi bi-geo-alt fs-3 text-primary"></i>
                            </div>
                            <h5 class="fw-bold">Jalur Zonasi</h5>
                            <p class="small text-muted">Berdasarkan jarak domisili ke sekolah tujuan. Kuota terbesar (50%).</p>
                            <a href="<?php echo url('/daftar/zonasi'); ?>" class="btn btn-outline-primary btn-sm rounded-pill px-4">Daftar Sekarang</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body p-4">
                            <div class="bg-success bg-opacity-10 rounded-circle p-3 mb-3" style="width: fit-content;">
                                <i class="bi bi-heart fs-3 text-success"></i>
                            </div>
                            <h5 class="fw-bold">Jalur Afirmasi</h5>
                            <p class="small text-muted">Siswa dari keluarga tidak mampu & disabilitas. Kuota (15%).</p>
                            <a href="<?php echo url('/daftar/afirmasi'); ?>" class="btn btn-outline-success btn-sm rounded-pill px-4">Daftar Sekarang</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body p-4">
                            <div class="bg-warning bg-opacity-10 rounded-circle p-3 mb-3" style="width: fit-content;">
                                <i class="bi bi-trophy fs-3 text-warning"></i>
                            </div>
                            <h5 class="fw-bold">Jalur Prestasi</h5>
                            <p class="small text-muted">Prestasi akademik & non-akademik. Kuota (30%).</p>
                            <a href="<?php echo url('/daftar/prestasi'); ?>" class="btn btn-outline-warning btn-sm rounded-pill px-4">Daftar Sekarang</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body p-4">
                            <div class="bg-danger bg-opacity-10 rounded-circle p-3 mb-3" style="width: fit-content;">
                                <i class="bi bi-arrow-left-right fs-3 text-danger"></i>
                            </div>
                            <h5 class="fw-bold">Jalur Perpindahan</h5>
                            <p class="small text-muted">Perpindahan tugas orang tua/wali. Kuota (5%).</p>
                            <a href="<?php echo url('/daftar/mutasi'); ?>" class="btn btn-outline-danger btn-sm rounded-pill px-4">Daftar Sekarang</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Cetak Bukti -->
            <div class="card border-0 shadow-sm mb-4" style="border-radius: 16px;">
                <div class="card-body p-4">
                    <h6 class="fw-bold mb-3"><i class="bi bi-printer me-2"></i>Cetak Bukti</h6>
                    <p class="small text-muted mb-3">Cetak dokumen sesuai status pendaftaran Anda.</p>
                    <div class="d-grid gap-2">
                        <?php 
                        // Get pendaftaran status
                        $pendaftaran = new Pendaftaran();
                        $dataPendaftaran = $pendaftaran->findByUserId(userId());
                        $status = $dataPendaftaran['status'] ?? null;
                        $sudahDaftar = !empty($dataPendaftaran);
                        ?>
                        
                        <!-- Bukti Pendaftaran - Available if registered -->
                        <?php if ($sudahDaftar): ?>
                        <a href="<?php echo url('/cetak/pendaftaran'); ?>" class="btn btn-outline-primary rounded-pill" target="_blank">
                            <i class="bi bi-file-earmark-text me-2"></i>Bukti Pendaftaran
                        </a>
                        <?php else: ?>
                        <button class="btn btn-outline-secondary rounded-pill" disabled title="Anda belum melakukan pendaftaran">
                            <i class="bi bi-file-earmark-text me-2"></i>Bukti Pendaftaran
                        </button>
                        <?php endif; ?>
                        
                        <!-- Bukti Diterima - Available if status = diterima -->
                        <?php if ($status === 'diterima' || $status === 'daftar_ulang'): ?>
                        <a href="<?php echo url('/cetak/diterima'); ?>" class="btn btn-outline-success rounded-pill" target="_blank">
                            <i class="bi bi-check-circle me-2"></i>Bukti Diterima
                        </a>
                        <?php else: ?>
                        <button class="btn btn-outline-secondary rounded-pill" disabled title="Anda belum dinyatakan diterima">
                            <i class="bi bi-check-circle me-2"></i>Bukti Diterima
                        </button>
                        <?php endif; ?>
                        
                        <!-- Bukti Daftar Ulang - Available if status = daftar_ulang -->
                        <?php if ($status === 'daftar_ulang'): ?>
                        <a href="<?php echo url('/cetak/daftar-ulang'); ?>" class="btn btn-outline-purple rounded-pill" target="_blank" style="border-color: #6f42c1; color: #6f42c1;">
                            <i class="bi bi-patch-check me-2"></i>Bukti Daftar Ulang
                        </a>
                        <?php else: ?>
                        <button class="btn btn-outline-secondary rounded-pill" disabled title="Anda belum melakukan daftar ulang">
                            <i class="bi bi-patch-check me-2"></i>Bukti Daftar Ulang
                        </button>
                        <?php endif; ?>
                    </div>
                    
                    <?php if ($sudahDaftar): ?>
                    <div class="mt-3 p-2 bg-light rounded text-center">
                        <small class="text-muted">Status: </small>
                        <?php
                        $badgeClass = 'bg-warning text-dark';
                        $statusText = 'Pending';
                        if ($status === 'terverifikasi') { $badgeClass = 'bg-info'; $statusText = 'Terverifikasi'; }
                        if ($status === 'diterima') { $badgeClass = 'bg-success'; $statusText = 'Diterima'; }
                        if ($status === 'ditolak') { $badgeClass = 'bg-danger'; $statusText = 'Ditolak'; }
                        if ($status === 'daftar_ulang') { $badgeClass = 'bg-primary'; $statusText = 'Daftar Ulang'; }
                        ?>
                        <span class="badge <?php echo $badgeClass; ?>"><?php echo $statusText; ?></span>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Help -->
            <div class="card border-0 shadow-sm bg-dark text-white p-4" style="border-radius: 16px;">
                <h6 class="fw-bold mb-3">Butuh Bantuan?</h6>
                <p class="small opacity-75 mb-4">Tim helpdesk kami siap membantu jika Anda mengalami kesulitan.</p>
                <a href="#" class="btn btn-light w-100 rounded-pill fw-bold small">Hubungi WhatsApp</a>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
