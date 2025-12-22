<div class="bg-gov-light py-5">
    <div class="container py-4">
        <div class="mb-4">
            <a href="<?php echo url('/kuota'); ?>" class="btn btn-outline-primary rounded-pill px-4">
                <i class="bi bi-arrow-left me-2"></i>Kembali
            </a>
        </div>

        <div class="row g-4">
            <div class="col-lg-8">
                <!-- School Info Card -->
                <div class="card border-0 shadow-sm mb-4" style="border-radius: 20px; overflow: hidden;">
                    <div class="bg-primary text-white p-4">
                        <h3 class="fw-bold mb-2"><?php echo e($sekolah['nama']); ?></h3>
                        <p class="mb-0 opacity-75"><i class="bi bi-geo-alt me-2"></i><?php echo e($sekolah['alamat']); ?></p>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <div class="d-flex align-items-center">
                                    <div class="bg-primary bg-opacity-10 rounded-3 p-2 me-3">
                                        <i class="bi bi-geo text-primary"></i>
                                    </div>
                                    <div>
                                        <small class="text-muted">Kecamatan</small>
                                        <div class="fw-semibold"><?php echo e($sekolah['kecamatan']); ?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-center">
                                    <div class="bg-success bg-opacity-10 rounded-3 p-2 me-3">
                                        <i class="bi bi-people text-success"></i>
                                    </div>
                                    <div>
                                        <small class="text-muted">Daya Tampung</small>
                                        <div class="fw-semibold"><?php echo $sekolah['kuota'] ?? 0; ?> Siswa</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Kuota Per Jalur -->
                        <h6 class="fw-bold mb-3">Kuota Per Jalur</h6>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="border rounded-3 p-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <i class="bi bi-geo-alt text-primary me-2"></i>
                                            <span class="fw-semibold">Domisili</span>
                                        </div>
                                        <span class="badge bg-primary"><?php echo $sekolah['kuota_domisili'] ?? 0; ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="border rounded-3 p-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <i class="bi bi-heart text-success me-2"></i>
                                            <span class="fw-semibold">Afirmasi</span>
                                        </div>
                                        <span class="badge bg-success"><?php echo $sekolah['kuota_afirmasi'] ?? 0; ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="border rounded-3 p-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <i class="bi bi-trophy text-warning me-2"></i>
                                            <span class="fw-semibold">Prestasi</span>
                                        </div>
                                        <span class="badge bg-warning"><?php echo ($sekolah['kuota_prestasi_akademik'] ?? 0) + ($sekolah['kuota_prestasi_nonakademik'] ?? 0); ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="border rounded-3 p-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <i class="bi bi-arrow-left-right text-danger me-2"></i>
                                            <span class="fw-semibold">Mutasi</span>
                                        </div>
                                        <span class="badge bg-danger"><?php echo $sekolah['kuota_mutasi'] ?? 0; ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <!-- Map -->
                <?php if ($sekolah['latitude'] && $sekolah['longitude']): ?>
                <div class="card border-0 shadow-sm mb-4" style="border-radius: 16px; overflow: hidden; height: 100%; min-height: 300px;">
                    <div id="map" style="width: 100%; height: 100%;"></div>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Foto Sekolah -->
        <?php 
        $fotoPath = !empty($sekolah['foto']) ? '/uploads/sekolah/' . $sekolah['foto'] : '/uploads/sekolah/default.jpg';
        ?>
        <div class="card border-0 shadow-sm mb-4" style="border-radius: 16px; overflow: hidden; aspect-ratio: 18/9;">
            <img src="<?php echo url($fotoPath); ?>" alt="<?php echo e($sekolah['nama']); ?>" class="w-100 h-100" style="object-fit: cover;">
        </div>
    </div>
</div>

<?php if ($sekolah['latitude'] && $sekolah['longitude']): ?>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
var map = L.map('map').setView([<?php echo $sekolah['latitude']; ?>, <?php echo $sekolah['longitude']; ?>], 15);
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
L.marker([<?php echo $sekolah['latitude']; ?>, <?php echo $sekolah['longitude']; ?>]).addTo(map)
    .bindPopup('<?php echo e($sekolah['nama']); ?>').openPopup();
</script>
<?php endif; ?>
