<?php
require_once 'config.php';
require_once 'includes/functions.php';

$sekolah_list = getAllSekolah($conn);
$statistik = getStatistikSekolah($sekolah_list);
?>

<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar.php'; ?>

<div class="bg-gov-light py-5">
    <div class="container py-4">
        <!-- Header Section -->
        <div class="row mb-5">
            <div class="col-lg-8">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-2">
                        <li class="breadcrumb-item"><a href="index.php" class="text-decoration-none">Beranda</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Kuota Pendaftaran</li>
                    </ol>
                </nav>
                <h1 class="fw-bold text-dark">Kuota Pendaftaran SMA Negeri</h1>
                <p class="text-muted lead">Informasi resmi rincian daya tampung penerimaan siswa baru TP 2024/2025 Kota Padang.</p>
            </div>
            <div class="col-lg-4 d-flex align-items-center justify-content-lg-end">
                <div class="bg-white p-3 rounded-4 shadow-sm border d-flex align-items-center">
                    <div class="bg-primary bg-opacity-10 p-3 rounded-3 me-3">
                        <i class="bi bi-info-circle text-primary fs-4"></i>
                    </div>
                    <div>
                        <small class="text-muted d-block">Tahun Pelajaran</small>
                        <span class="fw-bold">2024/2025</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter & Info Section -->
        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-body p-4">
                <div class="row g-3 align-items-center">
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-text bg-light border-0"><i class="bi bi-search text-primary"></i></span>
                            <input type="text" id="kuotaSearch" class="form-control border-0 bg-light shadow-none" placeholder="Cari nama sekolah...">
                        </div>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill">
                            Total Daya Tampung: <?php echo number_format($statistik['total_kuota']); ?> Siswa
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Table Section -->
        <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="table-responsive">
                <table class="table table-hover mb-0 align-middle text-center" id="kuotaTable">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th width="50">No</th>
                            <th class="text-start">Nama Sekolah</th>
                            <th width="80">Rombel</th>
                            <th width="80">Pagu</th>
                            <th width="80" class="bg-light bg-opacity-50">Zonasi (35%)</th>
                            <th width="80">Afirmasi (30%)</th>
                            <th width="80" class="bg-light bg-opacity-50">Akad (15%)</th>
                            <th width="80">Non-Akad (15%)</th>
                            <th width="80" class="bg-light bg-opacity-50">Mutasi (5%)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $i = 1; // Changed $no to $i as per instruction
                        foreach ($sekolah_list as $sekolah): 
                            $dt = $sekolah['kuota'];
                        $kelas = ceil($dt / 32);
                        
                        // SPMB 2025 Percentages
                        $domisili = floor($dt * 0.35);
                        $afirmasi = floor($dt * 0.30);
                        $prestasi_akad = floor($dt * 0.15);
                        $prestasi_non = floor($dt * 0.15);
                        $mutasi = floor($dt * 0.05);

                        // Adjustment for rounding (remaining goes to domisili)
                        $total_allotted = $domisili + $afirmasi + $prestasi_akad + $prestasi_non + $mutasi;
                        if ($total_allotted < $dt) {
                            $domisili += ($dt - $total_allotted);
                        }
                    ?>
                    <tr class="kuota-row">
                        <td class="text-center fw-bold"><?php echo $i++; ?></td>
                        <td>
                            <div class="fw-bold text-primary mb-0"><?php echo htmlspecialchars($sekolah['nama']); ?></div>
                            <div class="small text-muted"><i class="bi bi-geo-alt me-1"></i><?php echo $sekolah['kecamatan']; ?></div>
                        </td>
                        <td class="text-center"><span class="badge bg-light text-dark border px-3"><?php echo $kelas; ?></span></td>
                        <td class="text-center fw-bold text-primary fs-5"><?php echo $dt; ?></td>
                        <td class="text-center bg-light bg-opacity-50"><?php echo $domisili; ?></td>
                        <td class="text-center"><?php echo $afirmasi; ?></td>
                        <td class="text-center bg-light bg-opacity-50"><?php echo $prestasi_akad; ?></td>
                        <td class="text-center"><?php echo $prestasi_non; ?></td>
                        <td class="text-center bg-light bg-opacity-50"><?php echo $mutasi; ?></td>
                    </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            
            <!-- Empty State -->
            <div id="noResults" class="text-center py-5 d-none">
                <i class="bi bi-search display-1 text-muted opacity-25"></i>
                <h5 class="mt-3 text-muted">Sekolah tidak ditemukan</h5>
            </div>
        </div>

        <!-- Notes Section -->
        <div class="mt-4 p-4 bg-warning bg-opacity-10 rounded-4 border border-warning border-opacity-25">
            <h6 class="fw-bold mb-3"><i class="bi bi-exclamation-circle-fill text-warning me-2"></i>Catatan Penting Mengenai Kuota:</h6>
            <ol class="small text-muted mb-0 ps-3">
                <li class="mb-2">Jumlah kuota Prestasi, Afirmasi, dan Pindah Tugas dihitung berdasarkan pembulatan ke bawah.</li>
                <li class="mb-2">Sisa kuota dari pembulatan akan dialokasikan ke Jalur Zonasi sebagai jalur utama.</li>
                <li>Daya tampung per kelas maksimal adalah 36 siswa sesuai dengan Permendikbud Nomor 17 Tahun 2017.</li>
            </ol>
        </div>
    </div>
</div>

<script>
document.getElementById('kuotaSearch').addEventListener('input', function() {
    const keyword = this.value.toLowerCase();
    const rows = document.querySelectorAll('.kuota-row');
    let found = 0;

    rows.forEach(row => {
        const text = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
        if (text.includes(keyword)) {
            row.style.display = '';
            found++;
        } else {
            row.style.display = 'none';
        }
    });

    document.getElementById('noResults').className = found === 0 ? 'text-center py-5' : 'd-none';
});
</script>

<?php include 'includes/footer.php'; ?>
