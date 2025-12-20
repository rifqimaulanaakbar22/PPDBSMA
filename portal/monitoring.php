<?php
require_once '../core/config.php';
require_once '../core/functions.php';

// Fetch schools for monitoring
$query = "SELECT * FROM sekolah";
$result = mysqli_query($conn, $query);

$sekolah_list = [];
while ($row = mysqli_fetch_assoc($result)) {
    $sekolah_list[] = $row;
}

// Natural sort by name (SMAN 1, 2, 3... 10, 11 instead of SMAN 1, 10, 11...)
usort($sekolah_list, function($a, $b) {
    return strnatcasecmp($a['nama'], $b['nama']);
});
?>

<?php include '../includes/header.php'; ?>
<?php include '../includes/navbar.php'; ?>

<main class="py-5 bg-gov-light">
    <div class="container py-4">
        <!-- Header Section -->
        <div class="row mb-5 justify-content-center">
            <div class="col-lg-8 text-center">
                <div class="badge-ppdb bg-primary bg-opacity-10 text-primary mb-3">Monitoring Real-time</div>
                <h1 class="fw-bold text-dark mb-4">Statistik & Daya Tampung</h1>
                <div class="bg-primary mx-auto mb-4" style="width: 80px; height: 5px; border-radius: 2px;"></div>
                <p class="text-muted lead">Pantau kuota dan daya tampung seluruh SMA Negeri di Kota Padang secara transparan.</p>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm p-4 text-center">
                    <div class="feature-icon-wrapper bg-primary bg-opacity-10 mx-auto">
                        <i class="bi bi-building fs-3 text-primary"></i>
                    </div>
                    <h2 class="fw-bold mb-1"><?php echo count($sekolah_list); ?></h2>
                    <p class="text-muted mb-0">Total Sekolah</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm p-4 text-center">
                    <div class="feature-icon-wrapper bg-success bg-opacity-10 mx-auto">
                        <i class="bi bi-people fs-3 text-success"></i>
                    </div>
                    <h2 class="fw-bold mb-1">
                        <?php 
                        $total_kuota = array_sum(array_column($sekolah_list, 'kuota'));
                        echo number_format($total_kuota); 
                        ?>
                    </h2>
                    <p class="text-muted mb-0">Total Daya Tampung</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm p-4 text-center">
                    <div class="feature-icon-wrapper bg-info bg-opacity-10 mx-auto">
                        <i class="bi bi-calendar-check fs-3 text-info"></i>
                    </div>
                    <h2 class="fw-bold mb-1">2025</h2>
                    <p class="text-muted mb-0">Tahun Ajaran</p>
                </div>
            </div>
        </div>

        <!-- Table Section -->
        <div class="card border-0 shadow-lg p-0 overflow-hidden" style="border-radius: 20px;">
            <div class="card-header bg-white border-bottom p-4">
                <div class="row align-items-center">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <h5 class="fw-bold mb-0">Daftar Sekolah & Kuota</h5>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-text bg-light border-0"><i class="bi bi-search"></i></span>
                            <input type="text" class="form-control bg-light border-0" id="filterSekolah" placeholder="Cari nama sekolah...">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" id="monitoringTable">
                        <thead class="bg-light">
                            <tr>
                                <th class="ps-4 py-3">NPSN</th>
                                <th class="py-3">Nama Sekolah</th>
                                <th class="py-3">Kecamatan</th>
                                <th class="py-3 text-center">Daya Tampung</th>
                                <th class="py-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($sekolah_list as $s ): ?>
                            <tr>
                                <td class="ps-4">
                                    <span class="badge bg-light text-dark fw-normal"><?php echo $s['npsn']; ?></span>
                                </td>
                                <td>
                                    <div class="fw-bold text-dark"><?php echo $s['nama']; ?></div>
                                    <small class="text-muted"><?php echo $s['alamat']; ?></small>
                                </td>
                                <td><?php echo $s['kecamatan']; ?></td>
                                <td class="text-center">
                                    <span class="badge bg-primary rounded-pill px-3"><?php echo $s['kuota']; ?> Siswa</span>
                                </td>
                                <td class="text-center">
                                    <a href="detail.php?id=<?php echo $s['id']; ?>" class="btn btn-sm btn-outline-primary rounded-pill">Detail</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    document.getElementById('filterSekolah').addEventListener('keyup', function() {
        let val = this.value.toLowerCase();
        let rows = document.querySelectorAll('#monitoringTable tbody tr');
        rows.forEach(row => {
            let text = row.textContent.toLowerCase();
            row.style.display = text.includes(val) ? '' : 'none';
        });
    });
</script>

<?php include '../includes/footer.php'; ?>
