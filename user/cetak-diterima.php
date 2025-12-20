<?php
require_once '../core/config.php';
session_start();

// Redirect if not logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];

// Get pendaftaran data with status diterima
$query = "SELECT p.*, s.nama as nama_siswa, s.nisn, s.nik, s.tempat_lahir, s.tanggal_lahir, 
                 s.jenis_kelamin, s.alamat, s.kecamatan, s.sekolah_asal, s.foto,
                 sk.nama as nama_sekolah, sk.alamat as alamat_sekolah, sk.kecamatan as kecamatan_sekolah
          FROM pendaftaran p
          JOIN siswa s ON p.siswa_id = s.id
          JOIN sekolah sk ON p.sekolah_id = sk.id
          WHERE s.user_id = ? AND p.status = 'diterima'
          ORDER BY p.tanggal_daftar DESC
          LIMIT 1";

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

// If not accepted, show message
if (!$data) {
    echo '<script>alert("Anda belum dinyatakan diterima."); window.location.href="dashboard.php";</script>';
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bukti Diterima - PPDB SMA Negeri Kota Padang</title>
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
            border-bottom: 3px solid #198754;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .header-print img {
            width: 80px;
            margin-bottom: 10px;
        }
        .header-print h4 {
            margin: 0;
            color: #198754;
            font-weight: bold;
        }
        .header-print p {
            margin: 5px 0 0;
            font-size: 14px;
            color: #666;
        }
        .congratulations {
            background: linear-gradient(135deg, #198754, #0f5132);
            color: white;
            padding: 25px;
            border-radius: 15px;
            text-align: center;
            margin-bottom: 30px;
        }
        .congratulations h2 {
            margin: 0 0 10px;
            font-size: 28px;
        }
        .congratulations p {
            margin: 0;
            font-size: 16px;
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
            background: #198754;
            color: white;
            padding: 8px 15px;
            font-weight: bold;
            margin: 25px 0 15px;
            border-radius: 5px;
        }
        .school-card {
            background: #d1e7dd;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 25px;
        }
        .school-card h5 {
            color: #0f5132;
            margin: 0 0 10px;
            font-weight: bold;
        }
        .school-card p {
            margin: 0;
            color: #0f5132;
        }
        .instructions {
            background: #fff3cd;
            border: 1px solid #ffecb5;
            padding: 20px;
            border-radius: 10px;
            margin-top: 30px;
        }
        .instructions h6 {
            color: #664d03;
            font-weight: bold;
            margin-bottom: 15px;
        }
        .instructions ol {
            margin: 0;
            padding-left: 20px;
            color: #664d03;
        }
        .instructions li {
            margin-bottom: 8px;
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
        .footer-print {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px dashed #ccc;
            text-align: center;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>
<body>
    <!-- Print Button -->
    <div class="text-center py-3 no-print">
        <button onclick="window.print()" class="btn btn-success btn-lg">
            <i class="bi bi-printer me-2"></i>Cetak Bukti Diterima
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
            <h4>SURAT KETERANGAN DITERIMA</h4>
            <p>Penerimaan Peserta Didik Baru SMA Negeri Kota Padang</p>
            <p>Tahun Pelajaran 2024/2025</p>
        </div>

        <!-- Congratulations -->
        <div class="congratulations">
            <h2><i class="bi bi-check-circle-fill me-2"></i>SELAMAT!</h2>
            <p>Anda dinyatakan <strong>DITERIMA</strong> sebagai Peserta Didik Baru</p>
        </div>

        <!-- School Info -->
        <div class="school-card">
            <h5><i class="bi bi-building me-2"></i><?php echo htmlspecialchars($data['nama_sekolah']); ?></h5>
            <p><i class="bi bi-geo-alt me-1"></i><?php echo htmlspecialchars($data['alamat_sekolah']); ?>, <?php echo htmlspecialchars($data['kecamatan_sekolah']); ?></p>
        </div>

        <!-- Data Siswa -->
        <div class="section-title">
            <i class="bi bi-person-fill me-2"></i>Data Peserta Didik
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
        <div class="info-row">
            <div class="info-label">Jalur Penerimaan</div>
            <div class="info-value">: <span class="badge bg-success"><?php echo ucfirst($data['jalur']); ?></span></div>
        </div>

        <!-- Instructions -->
        <div class="instructions">
            <h6><i class="bi bi-info-circle-fill me-2"></i>Langkah Selanjutnya - Daftar Ulang</h6>
            <ol>
                <li>Cetak bukti penerimaan ini dan simpan dengan baik.</li>
                <li>Siapkan dokumen asli: Ijazah/SKL, Kartu Keluarga, Akta Kelahiran, dan Pas Foto.</li>
                <li>Datang ke sekolah tujuan sesuai jadwal daftar ulang yang telah ditentukan.</li>
                <li>Lakukan verifikasi dokumen dan penyelesaian administrasi.</li>
                <li>Setelah daftar ulang, Anda resmi menjadi siswa baru!</li>
            </ol>
        </div>

        <!-- Signature Area -->
        <div class="signature-area">
            <div class="signature-box">
                <p>Mengetahui,</p>
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
            <p><strong>Dokumen ini merupakan bukti sah penerimaan peserta didik baru.</strong></p>
            <p>Harap membawa dokumen ini saat melakukan daftar ulang.</p>
            <p>Dicetak pada: <?php echo date('d F Y, H:i:s'); ?> WIB</p>
        </div>
    </div>
</body>
</html>
