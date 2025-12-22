<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Sekolah - <?php echo APP_NAME; ?></title>
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
        .school-thumb { width: 60px; height: 60px; object-fit: cover; border-radius: 8px; }
        .school-thumb-placeholder { width: 60px; height: 60px; border-radius: 8px; background: #e2e8f0; display: flex; align-items: center; justify-content: center; color: #94a3b8; }
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
            <li class="nav-item mt-auto"><a class="nav-link text-danger mt-5" href="<?php echo url('/logout'); ?>"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
        </ul>
    </nav>

    <!-- Main Content -->
    <main id="main-content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold mb-1">Data Sekolah</h4>
                <p class="text-muted small mb-0">Kelola data SMA Negeri Kota Padang</p>
            </div>
            <a href="<?php echo url('/admin/sekolah/tambah'); ?>" class="btn btn-primary rounded-3">
                <i class="bi bi-plus-lg me-2"></i>Tambah Sekolah
            </a>
        </div>

        <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success border-0 bg-success bg-opacity-10 text-success d-flex align-items-center mb-4">
            <i class="bi bi-check-circle-fill me-2"></i>
            <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
        </div>
        <?php endif; ?>

        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="px-4 py-3 text-secondary small text-uppercase">Foto</th>
                            <th class="px-4 py-3 text-secondary small text-uppercase">Nama Sekolah</th>
                            <th class="px-4 py-3 text-secondary small text-uppercase">NPSN</th>
                            <th class="px-4 py-3 text-secondary small text-uppercase">Kecamatan</th>
                            <th class="px-4 py-3 text-secondary small text-uppercase">Kuota</th>
                            <th class="px-4 py-3 text-secondary small text-uppercase">Akreditasi</th>
                            <th class="px-4 py-3 text-secondary small text-uppercase text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($sekolah_list as $s): ?>
                        <tr>
                            <td class="px-4">
                                <?php if (!empty($s['foto']) && file_exists(ROOT_PATH . 'public/uploads/sekolah/' . $s['foto'])): ?>
                                    <img src="<?php echo url('uploads/sekolah/' . $s['foto']); ?>" class="school-thumb">
                                <?php else: ?>
                                    <div class="school-thumb-placeholder"><i class="bi bi-building"></i></div>
                                <?php endif; ?>
                            </td>
                            <td class="px-4 fw-semibold"><?php echo htmlspecialchars($s['nama']); ?></td>
                            <td class="px-4 text-muted"><?php echo $s['npsn']; ?></td>
                            <td class="px-4"><?php echo htmlspecialchars($s['kecamatan']); ?></td>
                            <td class="px-4"><span class="badge bg-success bg-opacity-10 text-success"><?php echo $s['kuota']; ?></span></td>
                            <td class="px-4"><span class="badge bg-warning bg-opacity-10 text-warning"><?php echo $s['akreditasi']; ?></span></td>
                            <td class="px-4 text-end">
                                <div class="d-flex gap-2 justify-content-end">
                                    <a href="<?php echo url('/admin/sekolah/edit/' . $s['id']); ?>" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                        <i class="bi bi-pencil me-1"></i>Edit
                                    </a>
                                    <button type="button" class="btn btn-sm btn-outline-danger rounded-pill px-3" 
                                            data-bs-toggle="modal" data-bs-target="#deleteModal" 
                                            data-id="<?php echo $s['id']; ?>" 
                                            data-nama="<?php echo htmlspecialchars($s['nama']); ?>">
                                        <i class="bi bi-trash me-1"></i>Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-4">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold text-danger"><i class="bi bi-exclamation-triangle me-2"></i>Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-0">Apakah Anda yakin ingin menghapus <strong id="deleteSchoolName"></strong>?</p>
                    <p class="text-muted small mb-0">Tindakan ini tidak dapat dibatalkan.</p>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary rounded-3" data-bs-dismiss="modal">Batal</button>
                    <a href="#" id="deleteLink" class="btn btn-danger rounded-3">
                        <i class="bi bi-trash me-1"></i>Ya, Hapus
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('deleteModal').addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var id = button.getAttribute('data-id');
            var nama = button.getAttribute('data-nama');
            document.getElementById('deleteSchoolName').textContent = nama;
            document.getElementById('deleteLink').href = '<?php echo url('/admin/sekolah/hapus/'); ?>' + id;
        });
    </script>
</body>
</html>
