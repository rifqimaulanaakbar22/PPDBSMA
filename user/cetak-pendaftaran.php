<?php
require_once '../core/config.php';
session_start();

// Redirect if not logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];

// Get pendaftaran data
$query = "SELECT p.*, s.nama as nama_siswa, s.nisn, s.nik, s.tempat_lahir, s.tanggal_lahir, 
                 s.jenis_kelamin, s.alamat, s.kecamatan, s.sekolah_asal,
                 sk.nama as nama_sekolah, sk.alamat as alamat_sekolah
          FROM pendaftaran p
          JOIN siswa s ON p.siswa_id = s.id
          JOIN sekolah sk ON p.sekolah_id = sk.id
          WHERE s.user_id = ?
          ORDER BY p.tanggal_daftar DESC
          LIMIT 1";

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

// If no registration found, show message
if (!$data) {
    echo '<script>alert("Anda belum memiliki data pendaftaran."); window.location.href="dashboard.php";</script>';
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bukti Pendaftaran - PPDB SMA Negeri Kota Padang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        @media print {
            .no-print { display: none !important; }
            body { padding: 0; margin: 0; }
            .print-area { 
                padding: 20px;
                border: none !important;
                box-shadow: none !important;
            }
        }
        body {
            background: #f5f5f5;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .print-area {
            max-width: 800px;
            margin: 30px auto;
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 5px 30px rgba(0,0,0,0.1);
        }
        .header-print {
            text-align: center;
            border-bottom: 3px solid #0d6efd;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .header-print img {
            width: 80px;
            margin-bottom: 10px;
        }
        .header-print h4 {
            margin: 0;
            color: #0d6efd;
            font-weight: bold;
        }
        .header-print p {
            margin: 5px 0 0;
            font-size: 14px;
            color: #666;
        }
        .info-row {
            display: flex;
            margin-bottom: 10px;
        }
        .info-label {
            width: 180px;
            font-weight: 600;
            color: #333;
        }
        .info-value {
            flex: 1;
        }
        .section-title {
            background: #0d6efd;
            color: white;
            padding: 8px 15px;
            font-weight: bold;
            margin: 25px 0 15px;
            border-radius: 5px;
        }
        .registration-number {
            background: linear-gradient(135deg, #0d6efd, #0b5ed7);
            color: white;
            padding: 15px;
            border-radius: 10px;
            text-align: center;
            margin-bottom: 25px;
        }
        .registration-number h5 {
            margin: 0 0 5px;
            font-size: 14px;
            opacity: 0.9;
        }
        .registration-number h3 {
            margin: 0;
            font-size: 24px;
            letter-spacing: 2px;
        }
        .jalur-badge {
            display: inline-block;
            padding: 8px 20px;
            border-radius: 20px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .jalur-zonasi { background: #cfe2ff; color: #084298; }
        .jalur-afirmasi { background: #d1e7dd; color: #0f5132; }
        .jalur-prestasi { background: #fff3cd; color: #664d03; }
        .jalur-mutasi { background: #f8d7da; color: #842029; }
        .footer-print {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px dashed #ccc;
            text-align: center;
            font-size: 12px;
            color: #666;
        }
        .signature-area {
            display: flex;
            justify-content: space-between;
            margin-top: 50px;
        }
        .signature-box {
            text-align: center;
            width: 200px;
        }
        .signature-line {
            border-bottom: 1px solid #333;
            height: 60px;
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
    <!-- Print Button -->
    <div class="text-center py-3 no-print">
        <button onclick="window.print()" class="btn btn-primary btn-lg">
            <i class="bi bi-printer me-2"></i>Cetak Bukti Pendaftaran
        </button>
        <a href="dashboard.php" class="btn btn-outline-secondary btn-lg ms-2">
            <i class="bi bi-arrow-left me-2"></i>Kembali
        </a>
    </div>

    <!-- Print Area -->
    <div class="print-area">
        <!-- Header -->
        <div class="header-print">
            <img src="../assets/img/logo_kemdikbud.png" alt="Logo">
            <h4>BUKTI PENDAFTARAN PPDB</h4>
            <p>SMA Negeri Kota Padang - Tahun Pelajaran 2024/2025</p>
        </div>

        <!-- Registration Number -->
        <div class="registration-number">
            <h5>Nomor Pendaftaran</h5>
            <h3><?php echo htmlspecialchars($data['no_pendaftaran']); ?></h3>
        </div>

        <!-- Jalur Badge -->
        <div class="text-center mb-4">
            <span class="jalur-badge jalur-<?php echo $data['jalur']; ?>">
                Jalur <?php echo ucfirst($data['jalur']); ?>
            </span>
        </div>

        <!-- Data Siswa -->
        <div class="section-title">
            <i class="bi bi-person-fill me-2"></i>Data Siswa
        </div>
        <div class="info-row">
            <div class="info-label">NISN</div>
            <div class="info-value">: <?php echo htmlspecialchars($data['nisn']); ?></div>
        </div>
        <div class="info-row">
            <div class="info-label">NIK</div>
            <div class="info-value">: <?php echo htmlspecialchars($data['nik']); ?></div>
        </div>
        <div class="info-row">
            <div class="info-label">Nama Lengkap</div>
            <div class="info-value">: <?php echo htmlspecialchars($data['nama_siswa']); ?></div>
        </div>
        <div class="info-row">
            <div class="info-label">Tempat, Tanggal Lahir</div>
            <div class="info-value">: <?php echo htmlspecialchars($data['tempat_lahir']); ?>, <?php echo date('d F Y', strtotime($data['tanggal_lahir'])); ?></div>
        </div>
        <div class="info-row">
            <div class="info-label">Jenis Kelamin</div>
            <div class="info-value">: <?php echo $data['jenis_kelamin'] == 'L' ? 'Laki-laki' : 'Perempuan'; ?></div>
        </div>
        <div class="info-row">
            <div class="info-label">Alamat</div>
            <div class="info-value">: <?php echo htmlspecialchars($data['alamat']); ?></div>
        </div>
        <div class="info-row">
            <div class="info-label">Sekolah Asal</div>
            <div class="info-value">: <?php echo htmlspecialchars($data['sekolah_asal']); ?></div>
        </div>

        <!-- Data Pendaftaran -->
        <div class="section-title">
            <i class="bi bi-building me-2"></i>Data Pendaftaran
        </div>
        <div class="info-row">
            <div class="info-label">Sekolah Pilihan</div>
            <div class="info-value">: <?php echo htmlspecialchars($data['nama_sekolah']); ?></div>
        </div>
        <div class="info-row">
            <div class="info-label">Alamat Sekolah</div>
            <div class="info-value">: <?php echo htmlspecialchars($data['alamat_sekolah']); ?></div>
        </div>
        <div class="info-row">
            <div class="info-label">Tanggal Daftar</div>
            <div class="info-value">: <?php echo date('d F Y, H:i', strtotime($data['tanggal_daftar'])); ?> WIB</div>
        </div>
        <div class="info-row">
            <div class="info-label">Status</div>
            <div class="info-value">: <span class="badge bg-warning text-dark"><?php echo ucfirst(str_replace('_', ' ', $data['status'])); ?></span></div>
        </div>
        <?php if ($data['jarak']): ?>
        <div class="info-row">
            <div class="info-label">Jarak ke Sekolah</div>
            <div class="info-value">: <?php echo number_format($data['jarak'], 2); ?> km</div>
        </div>
        <?php endif; ?>

        <!-- Signature Area -->
        <div class="signature-area">
            <div class="signature-box">
                <p>Orang Tua/Wali</p>
                <div class="signature-line"></div>
                <p>( ............................ )</p>
            </div>
            <div class="signature-box">
                <p>Padang, <?php echo date('d F Y'); ?></p>
                <p>Peserta Didik</p>
                <div class="signature-line"></div>
                <p>( <?php echo htmlspecialchars($data['nama_siswa']); ?> )</p>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer-print">
            <p><strong>Catatan:</strong></p>
            <p>Bukti pendaftaran ini merupakan dokumen sah yang harus disimpan dan dibawa saat verifikasi dokumen.</p>
            <p>Dicetak pada: <?php echo date('d F Y, H:i:s'); ?> WIB</p>
        </div>
    </div>
</body>
</html>
