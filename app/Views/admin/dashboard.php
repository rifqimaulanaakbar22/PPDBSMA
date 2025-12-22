<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - <?php echo APP_NAME; ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --sidebar-width: 260px;
            --primary-color: #4F46E5;
            --secondary-bg: #f3f4f6;
        }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: var(--secondary-bg); overflow-x: hidden; }
        
        /* Sidebar Styling */
        #sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            top: 0; left: 0;
            background: #ffffff;
            border-right: 1px solid rgba(0,0,0,0.05);
            z-index: 1000;
            padding: 20px;
            transition: all 0.3s;
        }
        .sidebar-brand {
            display: flex;
            align-items: center;
            padding: 10px 15px;
            margin-bottom: 30px;
            color: var(--primary-color);
            font-weight: 700;
            font-size: 1.25rem;
            text-decoration: none;
        }
        .nav-link {
            color: #64748b;
            padding: 12px 15px;
            border-radius: 10px;
            font-weight: 500;
            margin-bottom: 5px;
            transition: all 0.2s;
            display: flex;
            align-items: center;
        }
        .nav-link i { font-size: 1.25rem; margin-right: 12px; }
        .nav-link:hover { color: var(--primary-color); background: rgba(79, 70, 229, 0.05); }
        .nav-link.active { color: #fff; background: var(--primary-color); box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3); }
        
        /* Main Content */
        #main-content {
            margin-left: var(--sidebar-width);
            padding: 30px;
            min-height: 100vh;
        }
        
        /* Cards */
        .stat-card {
            background: #fff;
            border-radius: 16px;
            padding: 25px;
            border: none;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            transition: transform 0.2s;
        }
        .stat-card:hover { transform: translateY(-3px); }
        .icon-box {
            width: 50px; height: 50px;
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.5rem;
        }
        
        /* Navbar */
        .top-navbar {
            margin-bottom: 30px;
            display: flex; justify-content: space-between; align-items: center;
        }
        
        @media (max-width: 768px) {
            #sidebar { transform: translateX(-100%); }
            #main-content { margin-left: 0; }
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <nav id="sidebar">
        <a href="#" class="sidebar-brand">
            <i class="bi bi-hexagon-fill me-2"></i> Admin Panel
        </a>
        
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="<?php echo url('/admin'); ?>">
                    <i class="bi bi-grid"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <span class="text-uppercase small text-muted fw-bold px-3 mt-4 mb-2 d-block">Master Data</span>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo url('/admin/sekolah'); ?>">
                    <i class="bi bi-building"></i> Data Sekolah
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="bi bi-people"></i> Pendaftar
                </a>
            </li>
            <li class="nav-item">
                <span class="text-uppercase small text-muted fw-bold px-3 mt-4 mb-2 d-block">Pengaturan</span>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="bi bi-gear"></i> Konfigurasi
                </a>
            </li>
            <li class="nav-item mt-auto">
                <a class="nav-link text-danger mt-5" href="<?php echo url('/logout'); ?>">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </a>
            </li>
        </ul>
    </nav>

    <!-- Main Content -->
    <main id="main-content">
        <!-- Top Navbar -->
        <div class="top-navbar">
            <div>
                <h4 class="fw-bold mb-1">Selamat Datang, <?php echo htmlspecialchars($_SESSION['admin_name'] ?? 'Administrator'); ?> 👋</h4>
                <p class="text-muted small mb-0">Ini adalah ringkasan data PPDB hari ini.</p>
            </div>
            <div class="d-flex align-items-center">
                <div class="dropdown">
                    <button class="btn btn-white bg-white border shadow-sm dropdown-toggle rounded-pill px-3 py-2" type="button" data-bs-toggle="dropdown">
                        <i class="bi bi-person-circle me-2 text-secondary"></i> Account
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0">
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-danger" href="<?php echo url('/logout'); ?>">Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Stats Grid -->
        <div class="row g-4 mb-5">
            <div class="col-12 col-md-6 col-lg-3">
                <div class="stat-card">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <p class="text-muted small mb-1 fw-semibold text-uppercase">Total Sekolah</p>
                            <h3 class="fw-bold mb-0 text-dark"><?php echo $total_sekolah ?? 0; ?></h3>
                        </div>
                        <div class="icon-box bg-primary bg-opacity-10 text-primary">
                            <i class="bi bi-building"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="stat-card">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <p class="text-muted small mb-1 fw-semibold text-uppercase">Total Pendaftar</p>
                            <h3 class="fw-bold mb-0 text-dark"><?php echo $total_pendaftar ?? 0; ?></h3>
                        </div>
                        <div class="icon-box bg-success bg-opacity-10 text-success">
                            <i class="bi bi-people"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="stat-card">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <p class="text-muted small mb-1 fw-semibold text-uppercase">Menunggu Verifikasi</p>
                            <h3 class="fw-bold mb-0 text-dark"><?php echo $pendaftar_pending ?? 0; ?></h3>
                        </div>
                        <div class="icon-box bg-warning bg-opacity-10 text-warning">
                            <i class="bi bi-clock-history"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="stat-card">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <p class="text-muted small mb-1 fw-semibold text-uppercase">Diterima</p>
                            <h3 class="fw-bold mb-0 text-dark"><?php echo $pendaftar_diterima ?? 0; ?></h3>
                        </div>
                        <div class="icon-box bg-info bg-opacity-10 text-info">
                            <i class="bi bi-check-circle"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity Table Placeholder -->
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="card-header bg-white p-4 border-0 pb-0">
                <h6 class="fw-bold">Pendaftar Terbaru</h6>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" style="min-width: 600px;">
                        <thead class="bg-light">
                            <tr>
                                <th class="px-4 py-3 text-secondary small text-uppercase">Nama Siswa</th>
                                <th class="px-4 py-3 text-secondary small text-uppercase">NISN</th>
                                <th class="px-4 py-3 text-secondary small text-uppercase">Jalur</th>
                                <th class="px-4 py-3 text-secondary small text-uppercase">Tanggal</th>
                                <th class="px-4 py-3 text-secondary small text-uppercase">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">
                                    <i class="bi bi-inbox fs-1 d-block mb-3 opacity-25"></i>
                                    Belum ada data pendaftaran terbaru
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
