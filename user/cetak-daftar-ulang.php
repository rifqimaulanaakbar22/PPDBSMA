<?php
require_once '../core/config.php';
session_start();

// Redirect if not logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];

// Get pendaftaran data with status daftar_ulang
$query = "SELECT p.*, s.nama as nama_siswa, s.nisn, s.nik, s.tempat_lahir, s.tanggal_lahir, 
                 s.jenis_kelamin, s.alamat, s.kecamatan, s.sekolah_asal, s.no_kk,
                 s.nama_ayah, s.nama_ibu, s.no_hp_ortu,
                 sk.nama as nama_sekolah, sk.alamat as alamat_sekolah, sk.kecamatan as kecamatan_sekolah
          FROM pendaftaran p
          JOIN siswa s ON p.siswa_id = s.id
          JOIN sekolah sk ON p.sekolah_id = sk.id
          WHERE s.user_id = ? AND p.status = 'daftar_ulang'
          ORDER BY p.tanggal_daftar DESC
          LIMIT 1";

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

// If not completed re-registration, show message
if (!$data) {
    echo '<script>alert("Anda belum melakukan daftar ulang."); window.location.href="dashboard.php";</script>';
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bukti Daftar Ulang - PPDB SMA Negeri Kota Padang</title>
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
            border-bottom: 3px solid #6f42c1;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .header-print img {
            width: 80px;
            margin-bottom: 10px;
        }
        .header-print h4 {
            margin: 0;
            color: #6f42c1;
            font-weight: bold;
        }
        .header-print p {
            margin: 5px 0 0;
            font-size: 14px;
            color: #666;
        }
        .status-banner {
            background: linear-gradient(135deg, #6f42c1, #5a32a3);
            color: white;
            padding: 25px;
            border-radius: 15px;
            text-align: center;
            margin-bottom: 30px;
        }
        .status-banner h2 {
            margin: 0 0 10px;
            font-size: 24px;
        }
        .status-banner p {
            margin: 0;
            font-size: 14px;
            opacity: 0.9;
        }
        .info-row {
            display: flex;
            margin-bottom: 10px;
            padding: 8px 0;
            border-bottom: 1px dotted #eee;
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
            background: #6f42c1;
            color: white;
            padding: 8px 15px;
            font-weight: bold;
            margin: 25px 0 15px;
            border-radius: 5px;
        }
        .school-card {
            background: #e2d9f3;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 25px;
        }
        .school-card h5 {
            color: #5a32a3;
            margin: 0 0 10px;
            font-weight: bold;
        }
        .school-card p {
            margin: 0;
            color: #5a32a3;
        }
        .document-checklist {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
        }
        .document-checklist h6 {
            font-weight: bold;
            margin-bottom: 15px;
        }
        .check-item {
            display: flex;
            align-items: center;
            margin-bottom: 8px;
        }
        .check-item i {
            color: #198754;
            margin-right: 10px;
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
        .stamp-area {
            text-align: center;
            width: 150px;
        }
        .stamp-placeholder {
            width: 100px;
            height: 100px;
            border: 2px dashed #ccc;
            border-radius: 50%;
            margin: 0 auto 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ccc;
            font-size: 12px;
        }
        .footer-print {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px dashed #ccc;
            text-align: center;
            font-size: 12px;
            color: #666;
        }
        .official-text {
            background: #d1e7dd;
            border: 2px solid #198754;
            padding: 15px;
            border-radius: 10px;
            text-align: center;
            margin-top: 30px;
        }
        .official-text h5 {
            color: #0f5132;
            margin: 0;
        }
    </style>
</head>
<body>
    <!-- Print Button -->
    <div class="text-center py-3 no-print">
        <button onclick="window.print()" class="btn btn-purple btn-lg" style="background: #6f42c1; color: white;">
            <i class="bi bi-printer me-2"></i>Cetak Bukti Daftar Ulang
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
            <h4>BUKTI DAFTAR ULANG</h4>
            <p>Penerimaan Peserta Didik Baru SMA Negeri Kota Padang</p>
            <p>Tahun Pelajaran 2024/2025</p>
        </div>

        <!-- Status Banner -->
        <div class="status-banner">
            <h2><i class="bi bi-patch-check-fill me-2"></i>DAFTAR ULANG BERHASIL</h2>
            <p>Anda telah resmi terdaftar sebagai siswa baru</p>
        </div>

        <!-- School Info -->
        <div class="school-card">
            <h5><i class="bi bi-building me-2"></i><?php echo htmlspecialchars($data['nama_sekolah']); ?></h5>
            <p><i class="bi bi-geo-alt me-1"></i><?php echo htmlspecialchars($data['alamat_sekolah']); ?>, <?php echo htmlspecialchars($data['kecamatan_sekolah']); ?></p>
        </div>

        <!-- Data Siswa -->
        <div class="section-title">
            <i class="bi bi-person-fill me-2"></i>Data Siswa Baru
        </div>
        <div class="info-row">
            <div class="info-label">No. Pendaftaran</div>
            <div class="info-value">: <strong><?php echo htmlspecialchars($data['no_pendaftaran']); ?></strong></div>
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
            <div class="info-label">No. Kartu Keluarga</div>
            <div class="info-value">: <?php echo htmlspecialchars($data['no_kk'] ?? '-'); ?></div>
        </div>
        <div class="info-row">
            <div class="info-label">Nama Ayah</div>
            <div class="info-value">: <?php echo htmlspecialchars($data['nama_ayah'] ?? '-'); ?></div>
        </div>
        <div class="info-row">
            <div class="info-label">Nama Ibu</div>
            <div class="info-value">: <?php echo htmlspecialchars($data['nama_ibu'] ?? '-'); ?></div>
        </div>
        <div class="info-row">
            <div class="info-label">No. HP Orang Tua</div>
            <div class="info-value">: <?php echo htmlspecialchars($data['no_hp_ortu'] ?? '-'); ?></div>
        </div>

        <!-- Document Checklist -->
        <div class="document-checklist">
            <h6><i class="bi bi-folder-check me-2"></i>Dokumen yang Telah Diverifikasi</h6>
            <div class="check-item">
                <i class="bi bi-check-circle-fill"></i>
                <span>Kartu Keluarga (KK) Asli</span>
            </div>
            <div class="check-item">
                <i class="bi bi-check-circle-fill"></i>
                <span>Akta Kelahiran Asli</span>
            </div>
            <div class="check-item">
                <i class="bi bi-check-circle-fill"></i>
                <span>Ijazah/Surat Keterangan Lulus (SKL)</span>
            </div>
            <div class="check-item">
                <i class="bi bi-check-circle-fill"></i>
                <span>Pas Foto 3x4 (4 Lembar)</span>
            </div>
        </div>

        <!-- Official Text -->
        <div class="official-text">
            <h5><i class="bi bi-award-fill me-2"></i>SELAMAT BERGABUNG DI <?php echo htmlspecialchars($data['nama_sekolah']); ?>!</h5>
        </div>

        <!-- Signature Area -->
        <div class="signature-area">
            <div class="signature-box">
                <p>Orang Tua/Wali</p>
                <div class="signature-line"></div>
                <p>( ............................ )</p>
            </div>
            <div class="stamp-area">
                <div class="stamp-placeholder">Stempel<br>Sekolah</div>
            </div>
            <div class="signature-box">
                <p>Padang, <?php echo date('d F Y'); ?></p>
                <p>Petugas Daftar Ulang</p>
                <div class="signature-line"></div>
                <p>( ............................ )</p>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer-print">
            <p><strong>Dokumen ini merupakan bukti sah bahwa siswa telah melakukan daftar ulang.</strong></p>
            <p>Simpan dokumen ini dengan baik sebagai arsip.</p>
            <p>Dicetak pada: <?php echo date('d F Y, H:i:s'); ?> WIB</p>
        </div>
    </div>
</body>
</html>
