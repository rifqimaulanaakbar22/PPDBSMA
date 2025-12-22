<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Sekolah - <?php echo APP_NAME; ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root { --sidebar-width: 260px; --primary-color: #4F46E5; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f3f4f6; }
        #sidebar { width: var(--sidebar-width); height: 100vh; position: fixed; top: 0; left: 0; background: #fff; border-right: 1px solid rgba(0,0,0,0.05); z-index: 1000; padding: 20px; }
        .sidebar-brand { display: flex; align-items: center; padding: 10px 15px; margin-bottom: 30px; color: var(--primary-color); font-weight: 700; font-size: 1.25rem; text-decoration: none; }
        .nav-link { color: #64748b; padding: 12px 15px; border-radius: 10px; font-weight: 500; margin-bottom: 5px; display: flex; align-items: center; }
        .nav-link i { font-size: 1.25rem; margin-right: 12px; }
        .nav-link:hover { color: var(--primary-color); background: rgba(79, 70, 229, 0.05); }
        .nav-link.active { color: #fff; background: var(--primary-color); }
        #main-content { margin-left: var(--sidebar-width); padding: 30px; min-height: 100vh; }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <nav id="sidebar">
        <a href="#" class="sidebar-brand"><i class="bi bi-hexagon-fill me-2"></i> Admin Panel</a>
        <ul class="nav flex-column">
            <li class="nav-item"><a class="nav-link" href="<?php echo url('/admin'); ?>"><i class="bi bi-grid"></i> Dashboard</a></li>
            <li class="nav-item"><span class="text-uppercase small text-muted fw-bold px-3 mt-4 mb-2 d-block">Master Data</span></li>
            <li class="nav-item"><a class="nav-link active" href="<?php echo url('/admin/sekolah'); ?>"><i class="bi bi-building"></i> Data Sekolah</a></li>
            <li class="nav-item"><a class="nav-link" href="#"><i class="bi bi-people"></i> Pendaftar</a></li>
        </ul>
    </nav>

    <!-- Main Content -->
    <main id="main-content">
        <div class="mb-4">
            <a href="<?php echo url('/admin/sekolah'); ?>" class="text-muted text-decoration-none small">
                <i class="bi bi-arrow-left me-1"></i> Kembali ke Data Sekolah
            </a>
        </div>
        
        <div class="row">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-4"><i class="bi bi-plus-circle me-2 text-primary"></i>Tambah Sekolah Baru</h5>
                        
                        <form action="<?php echo url('/admin/sekolah/tambah'); ?>" method="POST" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            
                            <!-- School Photo Section -->
                            <div class="mb-4 p-4 bg-light rounded-4">
                                <label class="form-label fw-semibold">Foto Sekolah</label>
                                <input type="file" name="foto" class="form-control" accept="image/*">
                                <small class="text-muted">Format: JPG, PNG. Max 2MB (Opsional)</small>
                            </div>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Nama Sekolah <span class="text-danger">*</span></label>
                                    <input type="text" name="nama" class="form-control" placeholder="SMAN 1 Padang" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">NPSN <span class="text-danger">*</span></label>
                                    <input type="text" name="npsn" class="form-control" placeholder="10303496" required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-semibold">Alamat</label>
                                    <input type="text" name="alamat" class="form-control" placeholder="Jl. Contoh No. 123">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Kecamatan</label>
                                    <input type="text" name="kecamatan" class="form-control" placeholder="Padang Utara">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label fw-semibold">Kuota</label>
                                    <input type="number" name="kuota" class="form-control" placeholder="300" value="0">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label fw-semibold">Akreditasi</label>
                                    <select name="akreditasi" class="form-select">
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="C">C</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Latitude</label>
                                    <input type="text" name="latitude" class="form-control" placeholder="-0.923412">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Longitude</label>
                                    <input type="text" name="longitude" class="form-control" placeholder="100.355678">
                                </div>
                            </div>

                            <div class="mt-4 pt-4 border-top d-flex gap-2">
                                <button type="submit" class="btn btn-primary px-4 rounded-3">
                                    <i class="bi bi-plus-lg me-2"></i>Tambah Sekolah
                                </button>
                                <a href="<?php echo url('/admin/sekolah'); ?>" class="btn btn-outline-secondary rounded-3">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
