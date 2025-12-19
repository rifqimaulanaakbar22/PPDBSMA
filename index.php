<?php
require_once 'config.php';
require_once 'includes/functions.php';

$sekolah_list = getAllSekolah($conn);

$statistik = getStatistikSekolah($sekolah_list);
$total_sekolah = $statistik['total_sekolah'];
$total_kuota = $statistik['total_kuota'];
?>

<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar.php'; ?>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <div class="col-lg-2">
                        <img src="tutwurinobg.png" alt="Logo" width="20%" height="20%">
                    </div>
                    <h1 class="display-5 fw-bold mb-3">
                        <i class=""></i> PPDB SMA Negeri Kota Padang
                    </h1>
                    <p class="lead mb-0">
                        <?php echo APP_DESCRIPTION; ?>
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <div class="container my-4">
        
        <!-- Search Bar -->
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <h5 class="card-title mb-3">
                    <i class="bi bi-search"></i> Cari Sekolah
                </h5>
                <form id="searchForm" onsubmit="return false;">
                    <div class="row g-3">
                        <!-- Pencarian Nama/NPSN Sekolah -->
                        <div class="col-lg-6">
                            <div class="position-relative">
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-building"></i>
                                    </span>
                                    <input type="text" 
                                           class="form-control" 
                                           id="searchSchool" 
                                           placeholder="Cari nama sekolah atau NPSN..."
                                           autocomplete="off">
                                    <button type="button" 
                                            class="btn btn-outline-secondary" 
                                            id="clearSchoolSearch"
                                            style="display: none;"
                                            onclick="clearSchoolSearch()">
                                        <i class="bi bi-x-lg"></i>
                                    </button>
                                </div>
                                <div id="schoolSuggestions" class="search-suggestions"></div>
                            </div>
                        </div>
                        
                        <!-- Filter Kecamatan -->
                        <div class="col-lg-3">
                            <select class="form-select" id="filterKecamatan">
                                <option value="">Semua Kecamatan</option>
                                <option value="Bungus Tlk.Kabung">Bungus Teluk Kabung</option>
                                <option value="Lubuk Begalung">Lubuk Begalung</option>
                                <option value="Kuranji">Kuranji</option>
                                <option value="Pauh">Pauh</option>
                                <option value="Lubuk Kilangan">Lubuk Kilangan</option>
                                <option value="Koto Tangah">Koto Tangah</option>
                                <option value="Nanggalo">Nanggalo</option>
                                <option value="Padang Selatan">Padang Selatan</option>
                                <option value="Padang Timur">Padang Timur</option>
                                <option value="Padang Utara">Padang Utara</option>
                                <option value="Padang Barat">Padang Barat</option>
                            </select>
                        </div>
                        
                        <!-- Button Reset -->
                        <div class="col-lg-3">
                            <button type="button" 
                                    onclick="resetAllFilters()" 
                                    class="btn btn-outline-secondary w-100">
                                <i class="bi bi-arrow-clockwise"></i> Reset
                            </button>
                        </div>
                    </div>
                    
                    <div class="mt-3">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" 
                                   type="checkbox" 
                                   id="showZones" 
                                   checked>
                            <label class="form-check-label" for="showZones">
                                Tampilkan zona sekolah (radius 2 km)
                            </label>
                        </div>
                        <button type="button" 
                                onclick="getCurrentLocation()" 
                                class="btn btn-success btn-sm ms-2">
                            <i class="bi bi-crosshair"></i> Gunakan Lokasi Saya
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Map and List -->
        <div class="row">
            
            <!-- Map Column -->
            <div class="col-lg-8 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">
                            <i class="bi bi-map"></i> Peta Lokasi Sekolah
                        </h5>
                    </div>
                    <div class="card-body p-0">
                        <div id="map"></div>
                    </div>
                    <div class="card-footer bg-white text-muted small">
                        <i class="bi bi-info-circle"></i> 
                        Klik marker pada peta untuk melihat informasi sekolah
                    </div>
                </div>
            </div>

            <!-- School List Column -->
            <div class="col-lg-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">
                            <i class="bi bi-building"></i> 
                            <span id="listTitle">Daftar SMA (<?php echo $total_sekolah; ?>)</span>
                        </h5>
                    </div>
                    <div class="card-body p-3">
                        
                        <!-- Loading Spinner -->
                        <div id="loadingSpinner" class="loading-spinner">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            <p class="mt-2">Memuat data sekolah...</p>
                        </div>
                        
                        <!-- School List -->
                        <div id="schoolList" class="school-list">
                            <?php foreach ($sekolah_list as $sekolah): ?>
                                <?php include 'includes/school_card.php'; ?>
                            <?php endforeach; ?>
                        </div>
                        
                    </div>
                </div>
            </div>
            
        </div>
        
    </div>

    <!-- Pass PHP data to JavaScript -->
    <script>
        window.sekolahData = <?php echo json_encode($sekolah_list); ?>;
    </script>

<?php include 'includes/footer.php'; ?>
