<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Sekolah - <?php echo APP_NAME; ?></title>
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
        .preview-img { max-width: 200px; max-height: 150px; object-fit: cover; border-radius: 12px; border: 2px solid #e2e8f0; }
        .upload-zone { border: 2px dashed #cbd5e1; border-radius: 12px; padding: 30px; text-align: center; cursor: pointer; transition: all 0.2s; }
        .upload-zone:hover { border-color: var(--primary-color); background: rgba(79, 70, 229, 0.02); }
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
                        <h5 class="fw-bold mb-4">Edit: <?php echo htmlspecialchars($sekolah['nama']); ?></h5>
                        
                        <form action="<?php echo url('/admin/sekolah/update/' . $sekolah['id']); ?>" method="POST" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            
                            <!-- School Photo Section -->
                            <div class="mb-4 p-4 bg-light rounded-4">
                                <label class="form-label fw-semibold">Foto Sekolah</label>
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <?php if (!empty($sekolah['foto']) && file_exists(ROOT_PATH . 'public/uploads/sekolah/' . $sekolah['foto'])): ?>
                                            <img src="<?php echo url('uploads/sekolah/' . $sekolah['foto']); ?>" class="preview-img" id="previewImg">
                                        <?php else: ?>
                                            <div class="preview-img bg-secondary bg-opacity-10 d-flex align-items-center justify-content-center" id="previewPlaceholder" style="width:200px;height:150px;">
                                                <i class="bi bi-image fs-1 text-muted"></i>
                                            </div>
                                            <img src="" class="preview-img d-none" id="previewImg">
                                        <?php endif; ?>
                                    </div>
                                    <div class="col">
                                        <input type="file" name="foto" id="fotoInput" class="form-control" accept="image/*">
                                        <small class="text-muted">Format: JPG, PNG. Max 2MB</small>
                                    </div>
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Nama Sekolah</label>
                                    <input type="text" name="nama" class="form-control" value="<?php echo htmlspecialchars($sekolah['nama']); ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">NPSN</label>
                                    <input type="text" name="npsn" class="form-control" value="<?php echo $sekolah['npsn']; ?>" required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-semibold">Alamat</label>
                                    <input type="text" name="alamat" class="form-control" value="<?php echo htmlspecialchars($sekolah['alamat'] ?? ''); ?>">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Kecamatan</label>
                                    <input type="text" name="kecamatan" class="form-control" value="<?php echo htmlspecialchars($sekolah['kecamatan']); ?>">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label fw-semibold">Total Kuota</label>
                                    <input type="number" name="kuota" id="totalKuota" class="form-control" value="<?php echo $sekolah['kuota']; ?>">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label fw-semibold">Akreditasi</label>
                                    <select name="akreditasi" class="form-select">
                                        <option value="A" <?php echo $sekolah['akreditasi'] == 'A' ? 'selected' : ''; ?>>A</option>
                                        <option value="B" <?php echo $sekolah['akreditasi'] == 'B' ? 'selected' : ''; ?>>B</option>
                                        <option value="C" <?php echo $sekolah['akreditasi'] == 'C' ? 'selected' : ''; ?>>C</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Latitude</label>
                                    <input type="text" name="latitude" class="form-control" value="<?php echo $sekolah['latitude'] ?? ''; ?>">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Longitude</label>
                                    <input type="text" name="longitude" class="form-control" value="<?php echo $sekolah['longitude'] ?? ''; ?>">
                                </div>
                            </div>

                            <!-- Kuota Per Jalur Section -->
                            <div class="mt-4 p-4 bg-light rounded-4">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <label class="form-label fw-semibold mb-0"><i class="bi bi-pie-chart me-2"></i>Kuota Per Jalur</label>
                                    <button type="button" id="autoCalculate" class="btn btn-sm btn-outline-primary rounded-pill">
                                        <i class="bi bi-calculator me-1"></i>Hitung Otomatis
                                    </button>
                                </div>
                                <div class="row g-3">
                                    <div class="col-md-4 col-6">
                                        <label class="form-label small text-success fw-semibold">Domisili (≥35%)</label>
                                        <input type="number" name="kuota_domisili" id="kuotaDomisili" class="form-control" value="<?php echo $sekolah['kuota_domisili'] ?? 0; ?>">
                                    </div>
                                    <div class="col-md-4 col-6">
                                        <label class="form-label small text-info fw-semibold">Afirmasi (≥30%)</label>
                                        <input type="number" name="kuota_afirmasi" id="kuotaAfirmasi" class="form-control" value="<?php echo $sekolah['kuota_afirmasi'] ?? 0; ?>">
                                    </div>
                                    <div class="col-md-4 col-6">
                                        <label class="form-label small text-warning fw-semibold">Prestasi Akademik (≥15%)</label>
                                        <input type="number" name="kuota_prestasi_akademik" id="kuotaPA" class="form-control" value="<?php echo $sekolah['kuota_prestasi_akademik'] ?? 0; ?>">
                                    </div>
                                    <div class="col-md-4 col-6">
                                        <label class="form-label small fw-semibold" style="color:#8B5CF6;">Prestasi Non-Akademik (≥15%)</label>
                                        <input type="number" name="kuota_prestasi_nonakademik" id="kuotaPN" class="form-control" value="<?php echo $sekolah['kuota_prestasi_nonakademik'] ?? 0; ?>">
                                    </div>
                                    <div class="col-md-4 col-6">
                                        <label class="form-label small text-danger fw-semibold">Mutasi (≤5%)</label>
                                        <input type="number" name="kuota_mutasi" id="kuotaMutasi" class="form-control" value="<?php echo $sekolah['kuota_mutasi'] ?? 0; ?>">
                                    </div>
                                    <div class="col-md-4 col-6 d-flex align-items-end">
                                        <div class="bg-white rounded-3 p-2 w-100 text-center">
                                            <small class="text-muted">Total Jalur:</small>
                                            <strong id="totalJalur" class="ms-1 text-primary">0</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4 pt-4 border-top d-flex gap-2">
                                <button type="submit" class="btn btn-primary px-4 rounded-3">
                                    <i class="bi bi-check-lg me-2"></i>Simpan Perubahan
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
    <script>
        // Photo preview
        document.getElementById('fotoInput').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.getElementById('previewImg');
                    const placeholder = document.getElementById('previewPlaceholder');
                    img.src = e.target.result;
                    img.classList.remove('d-none');
                    if (placeholder) placeholder.classList.add('d-none');
                }
                reader.readAsDataURL(file);
            }
        });

        // Auto-calculate quota per jalur
        document.getElementById('autoCalculate').addEventListener('click', function() {
            const total = parseInt(document.getElementById('totalKuota').value) || 0;
            const domisili = Math.floor(total * 0.35);
            const afirmasi = Math.floor(total * 0.30);
            const akademik = Math.floor(total * 0.15);
            const nonakademik = Math.floor(total * 0.15);
            const mutasi = Math.floor(total * 0.05);
            
            // Adjust domisili for rounding
            const allocated = domisili + afirmasi + akademik + nonakademik + mutasi;
            const adjusted_domisili = domisili + (total - allocated);
            
            document.getElementById('kuotaDomisili').value = adjusted_domisili;
            document.getElementById('kuotaAfirmasi').value = afirmasi;
            document.getElementById('kuotaPA').value = akademik;
            document.getElementById('kuotaPN').value = nonakademik;
            document.getElementById('kuotaMutasi').value = mutasi;
            
            updateTotal();
        });

        // Update total jalur
        function updateTotal() {
            const d = parseInt(document.getElementById('kuotaDomisili').value) || 0;
            const a = parseInt(document.getElementById('kuotaAfirmasi').value) || 0;
            const pa = parseInt(document.getElementById('kuotaPA').value) || 0;
            const pn = parseInt(document.getElementById('kuotaPN').value) || 0;
            const m = parseInt(document.getElementById('kuotaMutasi').value) || 0;
            document.getElementById('totalJalur').textContent = d + a + pa + pn + m;
        }

        // Update total on input change
        ['kuotaDomisili', 'kuotaAfirmasi', 'kuotaPA', 'kuotaPN', 'kuotaMutasi'].forEach(id => {
            document.getElementById(id).addEventListener('input', updateTotal);
        });

        // Initial calculation
        updateTotal();
    </script>
</body>
</html>
