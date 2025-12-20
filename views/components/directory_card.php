<div class="col-md-6 col-lg-4 directory-item" 
     data-nama="<?php echo strtolower($sekolah['nama']); ?>" 
     data-kecamatan="<?php echo strtolower($sekolah['kecamatan']); ?>">
    <div class="card h-100 directory-card border-0 shadow-sm overflow-hidden animate-fade-in">
        <!-- School Image / Placeholder -->
        <div class="position-relative">
            <?php if (!empty($sekolah['foto']) && file_exists(dirname(dirname(__DIR__)) . '/uploads/sekolah/' . $sekolah['foto'])): ?>
                <img src="<?php echo BASE_URL; ?>uploads/sekolah/<?php echo htmlspecialchars($sekolah['foto']); ?>" 
                     alt="<?php echo htmlspecialchars($sekolah['nama']); ?>"
                     class="directory-img w-100" style="height: 180px; object-fit: cover;">
            <?php else: ?>
                <div class="bg-primary bg-opacity-10 d-flex align-items-center justify-content-center" style="height: 180px;">
                    <i class="bi bi-building fs-1 text-primary opacity-50"></i>
                </div>
            <?php endif; ?>
            
            <!-- Badges Over Image -->
            <div class="position-absolute top-0 end-0 p-3 d-flex flex-column gap-2">
                <span class="badge bg-white text-primary shadow-sm rounded-pill px-3 py-2">
                    <i class="bi bi-award-fill me-1 text-warning"></i> Akreditasi <?php echo $sekolah['akreditasi']; ?>
                </span>
            </div>
        </div>

        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-start mb-2">
                <h5 class="fw-bold text-dark mb-0"><?php echo htmlspecialchars($sekolah['nama']); ?></h5>
            </div>
            <p class="small text-muted mb-3">
                <i class="bi bi-card-text me-1"></i> NPSN: <?php echo $sekolah['npsn']; ?>
            </p>
            
            <div class="d-flex flex-wrap gap-2 mb-4">
                <div class="badge-ppdb bg-success bg-opacity-10 text-success small">
                    <i class="bi bi-people me-1"></i> Kuota: <?php echo $sekolah['kuota']; ?>
                </div>
                <div class="badge-ppdb bg-info bg-opacity-10 text-info small">
                    <i class="bi bi-geo-alt me-1"></i> <?php echo htmlspecialchars($sekolah['kecamatan']); ?>
                </div>
            </div>

            <div class="pt-3 border-top d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center text-muted small">
                    <i class="bi bi-map me-1"></i>
                    <span>Zonasi Utama</span>
                </div>
                <a href="<?php echo BASE_URL; ?>portal/detail.php?id=<?php echo $sekolah['id']; ?>" class="btn btn-primary btn-sm rounded-pill px-4 fw-bold">
                    Lihat Detail
                </a>
            </div>
        </div>
    </div>
</div>
