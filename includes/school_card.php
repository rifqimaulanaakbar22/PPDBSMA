<div class="school-card mb-3" 
     data-id="<?php echo $sekolah['id']; ?>"
     onclick="selectSchool(<?php echo $sekolah['id']; ?>)">
    <div class="card-body p-3">
        <div class="d-flex align-items-start">
            
            <!-- Foto Sekolah -->
            <?php if (!empty($sekolah['foto']) && file_exists('uploads/sekolah/' . $sekolah['foto'])): ?>
                <img src="uploads/sekolah/<?php echo htmlspecialchars($sekolah['foto']); ?>" 
                     alt="<?php echo htmlspecialchars($sekolah['nama']); ?>"
                     class="school-img me-3">
            <?php else: ?>
                <div class="school-img-placeholder me-3">
                    <i class="bi bi-building"></i>
                </div>
            <?php endif; ?>
            
            <!-- Info Sekolah -->
            <div class="flex-fill">
                <h6 class="mb-1 fw-bold">
                    <?php echo htmlspecialchars($sekolah['nama']); ?>
                </h6>
                <p class="text-muted small mb-2">
                    <i class="bi bi-geo-alt"></i> 
                    <?php echo htmlspecialchars($sekolah['kecamatan']); ?>
                </p>
                <div class="d-flex justify-content-between align-items-center">
                    <span class="badge bg-primary">
                        <i class="bi bi-award"></i> 
                        <?php echo $sekolah['akreditasi']; ?>
                    </span>
                    <small class="text-muted">
                        <i class="bi bi-people"></i> 
                        <?php echo $sekolah['kuota']; ?> siswa
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>
