<?php
require_once '../core/config.php';
session_start();

// Redirect if already logged in
if (isset($_SESSION['user_id'])) {
    header('Location: dashboard.php');
    exit;
}

$error = '';
$action = isset($_GET['action']) ? $_GET['action'] : 'login';

// Simple mockup logic for login/register for demonstration
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // This is where database logic would go
    // For now, let's just simulate a successful login
    $_SESSION['user_id'] = 1;
    $_SESSION['username'] = isset($_POST['nik']) ? $_POST['nik'] : (isset($_POST['username']) ? $_POST['username'] : 'User');
    header('Location: dashboard.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo ($action == 'register') ? 'Pendaftaran Akun' : 'Masuk'; ?> - <?php echo APP_NAME; ?></title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    
    <style>
        :root {
            --spmb-blue: #1e3a8a;
            --spmb-yellow: #f59e0b;
            --spmb-yellow-hover: #d97706;
        }
        body {
            background-color: var(--spmb-blue);
            font-family: 'Outfit', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
            position: relative;
        }
        .btn-back-home {
            position: absolute;
            top: 30px;
            left: 30px;
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 10px;
            font-weight: 500;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
            z-index: 100;
        }
        .btn-back-home:hover {
            background: rgba(255, 255, 255, 0.2);
            color: white;
        }
        .login-card {
            background: white;
            border-radius: 30px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            width: 100%;
            max-width: 500px;
            padding: 50px;
            text-align: center;
        }
        .spmb-logo-title {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 30px;
        }
        .spmb-logo-title img {
            height: 80px;
            margin-bottom: 20px;
        }
        .spmb-logo-title .brand-accent {
            color: #0c4da2;
            font-weight: 700;
            font-size: 2.5rem;
            letter-spacing: -1px;
            line-height:1;
        }
        .spmb-logo-title .brand-sub {
            color: #f39200;
            font-size: 0.8rem;
            font-weight: 600;
            margin-top: -5px;
        }
        .welcome-title {
            color: var(--spmb-blue);
            font-weight: 800;
            font-size: 1.8rem;
            margin-bottom: 10px;
        }
        .welcome-subtitle {
            color: #64748b;
            font-size: 1rem;
            margin-bottom: 40px;
            line-height: 1.5;
        }
        .form-label {
            display: block;
            text-align: left;
            font-weight: 600;
            color: #334155;
            margin-bottom: 8px;
            font-size: 0.95rem;
        }
        .form-control {
            border-radius: 12px;
            padding: 15px 20px;
            border: 1px solid #e2e8f0;
            background-color: #f8fafc;
            color: #1e293b;
            font-size: 1rem;
            transition: all 0.3s ease;
        }
        .form-control:focus {
            box-shadow: 0 0 0 4px rgba(30, 58, 138, 0.1);
            border-color: var(--spmb-blue);
            background-color: white;
        }
        .btn-portal {
            background-color: #ff9800;
            background: linear-gradient(180deg, #ffb74d 0%, #f57c00 100%);
            color: #1e3a8a;
            border: none;
            border-radius: 12px;
            padding: 18px;
            font-weight: 800;
            font-size: 1.1rem;
            width: 100%;
            margin-top: 20px;
            margin-bottom: 25px;
            box-shadow: 0 10px 15px -3px rgba(245, 158, 11, 0.3);
            transition: all 0.3s ease;
            text-transform: uppercase;
        }
        .btn-portal:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 20px -3px rgba(245, 158, 11, 0.4);
            color: #1e3a8a;
            background: linear-gradient(180deg, #ffcc80 0%, #ef6c00 100%);
        }
        .footer-links {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            color: #64748b;
            font-size: 0.9rem;
        }
        .footer-links a {
            color: var(--spmb-blue);
            text-decoration: none;
            font-weight: 600;
        }
        .footer-links a:hover {
            text-decoration: underline;
        }
        .footer-links .separator {
            width: 4px;
            height: 4px;
            background: #cbd5e1;
            border-radius: 50%;
        }
        
        @media (max-width: 576px) {
            .login-card {
                padding: 30px 20px;
            }
            .btn-back-home {
                top: 15px;
                left: 15px;
                padding: 8px 15px;
                font-size: 0.85rem;
            }
        }
    </style>
</head>
<body>

<a href="../index.php" class="btn-back-home">
    <i class="bi bi-house"></i>
    <span>Kembali ke Beranda</span>
</a>

<div class="login-card animate-fade-in shadow-lg">
    <div class="spmb-logo-title">
        <img src="../assets/img/logo_kemdikbud.png" alt="SPMB Logo">
        <!-- Text fallback if logo not found -->
    </div>
    
    <h1 class="welcome-title"><?php echo ($action == 'register') ? 'PENDAFTARAN AKUN' : 'SELAMAT DATANG!'; ?></h1>
    <p class="welcome-subtitle">
        <?php echo ($action == 'register') ? 'Lengkapi data Anda untuk mendapatkan akses ke Portal Pendaftaran.' : 'Silakan masuk ke Portal Pendaftaran Calon Siswa Baru.'; ?>
    </p>

    <?php if ($error): ?>
        <div class="alert alert-danger border-0 small rounded-3 mb-4"><?php echo $error; ?></div>
    <?php endif; ?>

    <form action="login.php<?php echo ($action == 'register') ? '?action=register' : ''; ?>" method="post">
        <?php if ($action == 'register'): ?>
        <div class="mb-3">
            <label class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control" name="nama" placeholder="Masukkan nama sesuai ijazah" required>
        </div>
        <div class="mb-3">
            <label class="form-label">NISN</label>
            <input type="text" class="form-control" name="nisn" placeholder="Nomor Induk Siswa Nasional" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Nomor Induk Kependudukan (NIK)</label>
            <input type="text" class="form-control" name="nik" placeholder="Masukkan 16 Digit NIK Anda" required>
        </div>
        <?php else: ?>
        <div class="mb-4">
            <label class="form-label text-start">Nomor Induk Kependudukan (NIK)</label>
            <input type="text" class="form-control" name="nik" placeholder="Masukkan 16 Digit NIK Anda" required>
        </div>
        <div class="mb-4">
            <label class="form-label">Kata Sandi</label>
            <input type="password" class="form-control" name="password" placeholder="Masukkan Kata Sandi Anda" required>
        </div>
        <?php endif; ?>

        <?php if ($action == 'register'): ?>
        <div class="mb-4">
            <label class="form-label">Kata Sandi Baru</label>
            <input type="password" class="form-control" name="password" placeholder="Buat Kata Sandi Kuat" required>
        </div>
        <?php endif; ?>

        <button type="submit" class="btn btn-portal shadow">
            <?php echo ($action == 'register') ? 'DAFTAR SEKARANG' : 'MASUK KE PORTAL'; ?>
        </button>

        <div class="footer-links">
            <?php if ($action == 'login'): ?>
                <a href="#">Lupa Kata Sandi?</a>
                <span class="separator"></span>
                <span class="text-muted">Belum Punya Akun?</span>
                <a href="login.php?action=register">Daftar Sekarang</a>
            <?php else: ?>
                <span class="text-muted">Sudah Punya Akun?</span>
                <a href="login.php?action=login">Masuk di sini</a>
            <?php endif; ?>
        </div>
    </form>
</div>

</body>
</html>
