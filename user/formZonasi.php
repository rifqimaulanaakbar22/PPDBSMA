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
    <title>Formulir Jalur Zonasi - <?php echo APP_NAME; ?></title>
    
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
        .form-control:focus {
            background-color: white;
            box-shadow: 0 0 0 4px rgba(12, 77, 162, 0.1);
        }
        .step-indicator {
            display: flex;
            justify-content: space-between;
            margin-bottom: 3rem;
            position: relative;
        }
        .step-indicator::after {
            content: '';
            position: absolute;
            top: 20px;
            left: 0;
            right: 0;
            height: 2px;
            background: #e2e8f0;
            z-index: 1;
        }
        .step-circle {
            width: 40px;
            height: 40px;
            background: white;
            border: 2px solid #e2e8f0;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            z-index: 2;
            color: #94a3b8;
        }
        .step-circle.active {
            border-color: var(--primary-color);
            color: var(--primary-color);
            background: var(--accent-color);
        }
        .step-circle.completed {
            background: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
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
                <div class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill mb-3">JALUR ZONASI</div>
                <h2 class="fw-bold">Formulir Pendaftaran</h2>
                <p class="text-muted">Lengkapi data pendaftaran Anda dengan benar sesuai dokumen asli.</p>
            </div>

            <!-- Step Indicator -->
            <div class="step-indicator">
                <div class="d-flex flex-column align-items-center">
                    <div class="step-circle active">1</div>
                    <span class="small mt-2 fw-semibold">Biodata</span>
                </div>
                <div class="d-flex flex-column align-items-center">
                    <div class="step-circle">2</div>
                    <span class="small mt-2 fw-semibold">Alamat & Lokasi</span>
                </div>
                <div class="d-flex flex-column align-items-center">
                    <div class="step-circle">3</div>
                    <span class="small mt-2 fw-semibold">Pilih Sekolah</span>
                </div>
                <div class="d-flex flex-column align-items-center">
                    <div class="step-circle">4</div>
                    <span class="small mt-2 fw-semibold">Berkas</span>
                </div>
            </div>

            <form action="#" method="POST" class="animate-fade-in">
                <!-- Section 1: Biodata -->
                <div class="form-section">
                    <h5 class="fw-bold mb-4 d-flex align-items-center">
                        <i class="bi bi-person-vcard text-primary me-2"></i> Data Identitas Diri
                    </h5>
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label">NISN (10 Digit)</label>
                            <input type="text" class="form-control" name="nisn" placeholder="Contoh: 0123456789" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Nama Lengkap Siswa</label>
                            <input type="text" class="form-control" name="nama" placeholder="Sesuai Ijazah / Akta Lahir" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">NIK (Sesuai Kartu Keluarga)</label>
                            <input type="text" class="form-control" name="nik" placeholder="Kependudukan 16 Digit" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Sekolah Asal (SMP/MTs)</label>
                            <input type="text" class="form-control" name="sekolah_asal" placeholder="Nama Sekolah Asal" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Tempat Lahir</label>
                            <input type="text" class="form-control" name="tempat_lahir" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control" name="tanggal_lahir" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Jenis Kelamin</label>
                            <select class="form-select" name="jk" required>
                                <option value="">Pilih...</option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Section 2: Alamat (Zonasi) -->
                <div class="form-section">
                    <h5 class="fw-bold mb-4 d-flex align-items-center">
                        <i class="bi bi-geo-alt text-primary me-2"></i> Alamat & Titik Koordinat (Peta)
                    </h5>
                    <p class="small text-muted mb-4">Pastikan alamat sesuai dengan Kartu Keluarga yang diterbitkan minimal 1 tahun sebelum pendaftaran.</p>
                    
                    <div class="row g-4 mb-4">
                        <div class="col-md-8">
                            <label class="form-label">Alamat Lengkap (Jl, No, RT/RW)</label>
                            <textarea class="form-control" rows="3" name="alamat" required></textarea>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Kecamatan</label>
                            <select class="form-select" name="kecamatan" required>
                                <option value="">Pilih Kecamatan...</option>
                                <option>Lubuk Begalung</option>
                                <option>Kuranji</option>
                                <option>Padang Barat</option>
                                <option>Bungus Teluk Kabung</option>
                            </select>
                        </div>
                    </div>

                    <!-- Placeholder for Map -->
                    <div class="bg-light rounded-4 p-5 text-center border border-dashed mb-4" style="min-height: 250px; display: flex; flex-direction: column; align-items: center; justify-content: center;">
                        <i class="bi bi-map display-4 text-muted mb-3"></i>
                        <h6 class="fw-bold">Peta Lokasi Domisili</h6>
                        <p class="small text-muted">Klik pada peta untuk menentukan titik koordinat tempat tinggal Anda sesuai KK.</p>
                        <button type="button" class="btn btn-primary rounded-pill btn-sm mt-3 px-4">Buka Peta & Pin Lokasi</button>
                    </div>

                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label">Latitude</label>
                            <input type="text" class="form-control bg-white" name="lat" readonly placeholder="-0.923456">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Longitude</label>
                            <input type="text" class="form-control bg-white" name="lng" readonly placeholder="100.354678">
                        </div>
                    </div>
                </div>

                <!-- Form Submit -->
                <div class="d-flex justify-content-between align-items-center">
                    <p class="text-muted small mb-0"><i class="bi bi-shield-check me-1"></i> Data Anda aman dan hanya akan digunakan untuk keperluan seleksi PPDB.</p>
                    <button type="submit" class="btn btn-primary btn-lg rounded-pill px-5 fw-bold shadow-sm">
                        Simpan & Lanjutkan <i class="bi bi-chevron-right ms-2"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
</body>
</html>
