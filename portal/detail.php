<?php
require_once '../core/config.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$query = "SELECT * FROM sekolah WHERE id = $id";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) == 0) {
    header('Location: ../index.php');
    exit;
}

$sekolah = mysqli_fetch_assoc($result);
?>
<?php include '../includes/header.php'; ?>
<?php include '../includes/navbar.php'; ?>

<style>
    .card { border-radius: 12px; border: none; }
    .card-header { border-radius: 12px 12px 0 0 !important; }
    .foto-sekolah { width: 100%; border-radius: 12px; max-height: 300px; object-fit: cover; }
    #map { height: 350px; border-radius: 12px; }
    .card.shadow-sm { box-shadow: 0 4px 15px rgba(0,0,0,0.08) !important; }
    .card-header.bg-secondary { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important; }
    .card-header.bg-primary { background: linear-gradient(135deg, #0d6efd 0%, #0099ff 100%) !important; }
    .btn-primary { border-radius: 50px; padding: 10px 25px; }
    li i { margin-right: 8px; }
</style>

    <div class="container my-5">
        <div class="row">
            <!-- Kolom Kiri: Foto dan Peta -->
            <div class="col-lg-8">
                <!-- Card 1: Nama dan Foto Sekolah -->
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <!-- NAMA SEKOLAH -->
                        <h2 class="mb-4"><?php echo $sekolah['nama']; ?></h2>

                        <!-- FOTO SEKOLAH -->
                        <?php if (!empty($sekolah['foto']) && file_exists('../uploads/sekolah/' . $sekolah['foto'])): ?>
                            <img src="../uploads/sekolah/<?php echo $sekolah['foto']; ?>" 
                                 class="foto-sekolah" alt="<?php echo $sekolah['nama']; ?>">
                        <?php else: ?>
                            <div class="alert alert-secondary text-center mb-0">
                                <i class="bi bi-image fs-1"></i>
                                <p class="mb-0">Foto belum tersedia</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Card 2: Lokasi di Peta -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="bi bi-geo-alt me-2"></i>Lokasi di Peta</h5>
                    </div>
                    <div class="card-body">
                        <div id="map" class="mb-3"></div>

                        <a href="../index.php" class="btn btn-primary">
                            <i class="bi bi-arrow-left"></i> Kembali ke Daftar
                        </a>
                    </div>
                </div>
            </div>

            <!-- Kolom Kanan: Info Zonasi dan Info Sekolah -->
            <div class="col-lg-4">
                <!-- Info Sekolah -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="mb-0">Info Sekolah</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2">
                                <i class="bi bi-hash text-secondary"></i>
                                <strong>NPSN:</strong> <?php echo $sekolah['npsn']; ?>
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-geo-alt text-secondary"></i>
                                <strong>Alamat:</strong><br>
                                <span class="text-muted"><?php echo $sekolah['alamat']; ?></span>
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-pin-map text-secondary"></i>
                                <strong>Kecamatan:</strong> <?php echo $sekolah['kecamatan']; ?>
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-person text-secondary"></i>
                                <strong>Kepala Sekolah:</strong> <?php echo $sekolah['kepala_sekolah']; ?>
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-envelope text-secondary"></i>
                                <strong>Email:</strong><br>
                                <span class="text-muted"><?php echo $sekolah['email_sekolah']; ?></span>
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-telephone text-secondary"></i>
                                <strong>Telepon:</strong> <?php echo $sekolah['telepon']; ?>
                            </li>
                            <li class="mb-0">
                                <i class="bi bi-person-badge text-secondary"></i>
                                <strong>Operator:</strong> <?php echo $sekolah['operator']; ?>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Info Zonasi -->
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Info Zonasi</h5>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-info">
                            <i class="bi bi-info-circle"></i>
                            <strong>Sistem Zonasi</strong>
                            <p class="small mb-0 mt-2">
                                Calon siswa yang bertempat tinggal dalam radius 
                                <strong><?php echo $sekolah['radius']/1000; ?> km</strong> 
                                dari sekolah ini termasuk dalam zona prioritas.
                            </p>
                        </div>

                        <h6>Data Zonasi:</h6>
                        <ul class="list-unstyled">
                            <li class="mb-2">
                                <i class="bi bi-award text-primary"></i> 
                                Akreditasi <strong><?php echo $sekolah['akreditasi']; ?></strong>
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-people text-primary"></i> 
                                Kuota <strong><?php echo $sekolah['kuota']; ?></strong> siswa
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-geo-alt text-primary"></i> 
                                Zona radius <strong><?php echo $sekolah['radius']/1000; ?> km</strong>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const lat = <?php echo $sekolah['latitude']; ?>;
            const lng = <?php echo $sekolah['longitude']; ?>;
            const radius = <?php echo $sekolah['radius']; ?>;

            if (typeof L !== 'undefined') {
                const map = L.map('map').setView([lat, lng], 15);
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

                L.circle([lat, lng], {
                    color: '#0d6efd',
                    fillColor: '#0d6efd',
                    fillOpacity: 0.2,
                    radius: radius
                }).addTo(map);

                L.marker([lat, lng]).addTo(map)
                    .bindPopup('<b><?php echo $sekolah['nama']; ?></b>').openPopup();
            }
        });
    </script>
<?php include '../includes/footer.php'; ?>