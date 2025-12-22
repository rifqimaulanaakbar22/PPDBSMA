<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bukti Pendaftaran - <?php echo APP_NAME; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        @media print {
            .no-print { display: none !important; }
            body { -webkit-print-color-adjust: exact; print-color-adjust: exact; }
            .print-container { box-shadow: none !important; margin: 0 !important; }
        }
        body { background: #f0f2f5; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .print-container { 
            max-width: 800px; 
            margin: 20px auto; 
            background: white; 
            padding: 40px; 
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            border-radius: 10px;
        }
        .header-logo { height: 70px; }
        .kop-surat { border-bottom: 3px solid #0d6efd; padding-bottom: 15px; margin-bottom: 25px; }
        .kop-surat h4 { color: #0d6efd; font-weight: 700; margin-bottom: 0; }
        .kop-surat p { margin-bottom: 0; font-size: 14px; }
        .title-box { background: linear-gradient(135deg, #0d6efd, #0056b3); color: white; padding: 15px; border-radius: 8px; text-align: center; margin-bottom: 25px; }
        .title-box h5 { margin: 0; font-weight: 600; letter-spacing: 1px; }
        .info-box { background: #f8f9fa; border-radius: 8px; padding: 20px; margin-bottom: 20px; }
        .info-row { display: flex; margin-bottom: 8px; }
        .info-label { width: 160px; color: #6c757d; font-size: 14px; }
        .info-value { flex: 1; font-weight: 500; }
        .status-badge { font-size: 16px; padding: 8px 20px; }
        .status-pending { background: #ffc107; color: #000; }
        .status-terverifikasi { background: #198754; color: #fff; }
        .status-diterima { background: #0d6efd; color: #fff; }
        .status-ditolak { background: #dc3545; color: #fff; }
        .section-title { font-size: 14px; font-weight: 600; color: #0d6efd; margin-bottom: 15px; border-left: 4px solid #0d6efd; padding-left: 10px; }
        .data-table { width: 100%; }
        .data-table td { padding: 10px 15px; border: 1px solid #dee2e6; }
        .data-table td:first-child { background: #f8f9fa; width: 180px; font-weight: 500; color: #495057; }
        .qr-code { width: 100px; height: 100px; background: #f0f0f0; display: flex; align-items: center; justify-content: center; border: 1px dashed #ccc; }
        .signature-area { text-align: center; margin-top: 40px; }
        .signature-line { border-bottom: 1px solid #000; width: 200px; margin: 60px auto 5px; }
        .footer-note { background: #fff3cd; border-left: 4px solid #ffc107; padding: 15px; margin-top: 25px; font-size: 13px; }
        .no-pendaftaran { font-size: 24px; font-weight: 700; color: #0d6efd; letter-spacing: 2px; }
    </style>
</head>
<body>
    <div class="no-print bg-primary py-3 sticky-top">
        <div class="container">
            <div class="d-flex justify-content-center gap-3">
                <button onclick="window.print()" class="btn btn-light">
                    <i class="bi bi-printer me-2"></i>Cetak
                </button>
                <a href="<?php echo url('/dashboard'); ?>" class="btn btn-outline-light">
                    <i class="bi bi-arrow-left me-2"></i>Kembali
                </a>
            </div>
        </div>
    </div>

    <div class="print-container">
        <!-- Kop Surat -->
        <div class="kop-surat text-center">
            <div class="d-flex justify-content-center align-items-center gap-3">
                <img src="<?php echo asset('images/logo-padang.png'); ?>" alt="Logo" class="header-logo" onerror="this.style.display='none'">
                <div>
                    <p class="text-muted mb-1">PEMERINTAH KOTA PADANG</p>
                    <h4>DINAS PENDIDIKAN</h4>
                    <p class="text-muted">Jl. Bagindo Aziz Chan No. 8, Padang - Sumatera Barat</p>
                </div>
            </div>
        </div>

        <!-- Title -->
        <div class="title-box">
            <h5><i class="bi bi-file-earmark-text me-2"></i>BUKTI PENDAFTARAN PPDB</h5>
            <small>Tahun Pelajaran 2024/2025</small>
        </div>

        <!-- Info Pendaftaran -->
        <div class="row mb-4">
            <div class="col-md-8">
                <div class="info-box">
                    <div class="info-row">
                        <span class="info-label">No. Pendaftaran</span>
                        <span class="no-pendaftaran"><?php echo e($data['no_pendaftaran'] ?? '-'); ?></span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Jalur Pendaftaran</span>
                        <span class="info-value">
                            <span class="badge bg-primary"><?php echo strtoupper($data['jalur'] ?? '-'); ?></span>
                        </span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Tanggal Daftar</span>
                        <span class="info-value"><?php echo date('d F Y, H:i', strtotime($data['tanggal_daftar'] ?? 'now')); ?> WIB</span>
                    </div>
                    <?php if (!empty($data['jarak'])): ?>
                    <div class="info-row">
                        <span class="info-label">Jarak ke Sekolah</span>
                        <span class="info-value"><?php echo number_format($data['jarak'] / 1000, 2); ?> km</span>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="info-box text-center h-100 d-flex flex-column justify-content-center">
                    <small class="text-muted mb-2">STATUS PENDAFTARAN</small>
                    <?php
                    $status = strtolower($data['status'] ?? 'pending');
                    $statusClass = 'status-pending';
                    if ($status == 'terverifikasi') $statusClass = 'status-terverifikasi';
                    if ($status == 'diterima') $statusClass = 'status-diterima';
                    if ($status == 'ditolak') $statusClass = 'status-ditolak';
                    ?>
                    <span class="badge status-badge <?php echo $statusClass; ?>">
                        <?php echo strtoupper($data['status'] ?? 'PENDING'); ?>
                    </span>
                </div>
            </div>
        </div>

        <!-- Data Siswa -->
        <div class="section-title">DATA CALON PESERTA DIDIK</div>
        <table class="data-table mb-4">
            <tr>
                <td>NISN</td>
                <td><?php echo e($data['nisn'] ?? '-'); ?></td>
            </tr>
            <tr>
                <td>Nama Lengkap</td>
                <td><strong><?php echo e($data['nama_siswa'] ?? '-'); ?></strong></td>
            </tr>
            <tr>
                <td>NIK</td>
                <td><?php echo e($data['nik'] ?? '-'); ?></td>
            </tr>
            <tr>
                <td>Tempat, Tgl Lahir</td>
                <td><?php echo e($data['tempat_lahir'] ?? '-'); ?>, <?php echo date('d F Y', strtotime($data['tanggal_lahir'] ?? 'now')); ?></td>
            </tr>
            <tr>
                <td>Jenis Kelamin</td>
                <td><?php echo ($data['jenis_kelamin'] ?? 'L') == 'L' ? 'Laki-laki' : 'Perempuan'; ?></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td><?php echo e($data['alamat'] ?? '-'); ?></td>
            </tr>
            <tr>
                <td>Kecamatan</td>
                <td><?php echo e($data['kecamatan'] ?? '-'); ?></td>
            </tr>
            <tr>
                <td>Sekolah Asal</td>
                <td><?php echo e($data['sekolah_asal'] ?? '-'); ?></td>
            </tr>
        </table>

        <!-- Sekolah Tujuan -->
        <div class="section-title">SEKOLAH TUJUAN</div>
        <table class="data-table mb-4">
            <tr>
                <td>Nama Sekolah</td>
                <td><strong><?php echo e($data['nama_sekolah'] ?? '-'); ?></strong></td>
            </tr>
            <tr>
                <td>Alamat Sekolah</td>
                <td><?php echo e($data['alamat_sekolah'] ?? '-'); ?></td>
            </tr>
        </table>

        <!-- Catatan -->
        <div class="footer-note">
            <strong><i class="bi bi-info-circle me-2"></i>Catatan Penting:</strong>
            <ul class="mb-0 mt-2">
                <li>Simpan bukti pendaftaran ini dengan baik sebagai bukti sah pendaftaran.</li>
                <li>Pantau status pendaftaran secara berkala melalui website atau dashboard.</li>
                <li>Siapkan dokumen asli untuk verifikasi jika diperlukan.</li>
                <li>Hubungi panitia PPDB jika ada pertanyaan atau kendala.</li>
            </ul>
        </div>

        <!-- Tanda Tangan -->
        <div class="row mt-5">
            <div class="col-6"></div>
            <div class="col-6">
                <div class="signature-area">
                    <p class="mb-0">Padang, <?php 
                        $bulan = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
                        echo date('d') . ' ' . $bulan[date('n')-1] . ' ' . date('Y');
                    ?></p>
                    <p class="mb-0">Calon Peserta Didik,</p>
                    <div class="signature-line"></div>
                    <p class="fw-bold mb-0"><?php echo e($data['nama_siswa'] ?? '-'); ?></p>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="text-center mt-4 text-muted" style="font-size: 12px;">
            <hr>
            <p class="mb-0">Dokumen ini dicetak secara otomatis dari sistem <?php echo APP_NAME; ?></p>
            <p class="mb-0">Dicetak pada: <?php echo date('d/m/Y H:i:s'); ?> WIB</p>
        </div>
    </div>
</body>
</html>
