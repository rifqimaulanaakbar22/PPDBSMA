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
    <section class="hero-section text-white">
        <div class="container position-relative z-1">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <div class="d-flex align-items-center mb-4">
                        <div class="bg-white p-2 rounded-circle me-3 shadow-lg">
                            <img src="tutwurinobg.png" alt="Logo" width="50" height="50">
                        </div>
                        <div>
                            <span class="badge bg-danger mb-1 badge-ppdb">Resmi</span>
                            <h1 class="display-6 fw-bold mb-0">PPDB SMA Negeri Kota Padang</h1>
                        </div>
                    </div>
                    <p class="lead opacity-75 mb-4">
                        <?php echo APP_DESCRIPTION; ?>
                    </p>
                    <div class="d-flex gap-2">
                        <a href="#searchSection" class="btn btn-light btn-lg px-4 fw-bold text-primary shadow-sm border-0">
                            Cari Sekolah
                        </a>
                        <a href="#reqSection" class="btn btn-outline-light btn-lg px-4 border-2">
                            Lihat Persyaratan
                        </a>
                    </div>
                </div>
                <div class="col-lg-5 d-none d-lg-block text-center">
                    <!-- Placeholder image/illustration if needed -->
                    <div class="p-4 bg-white bg-opacity-10 rounded-4 backdrop-blur border border-white border-opacity-20 shadow-lg">
                        <h4 class="fw-bold mb-3">Statistik PPDB</h4>
                        <div class="row g-3">
                            <div class="col-6">
                                <div class="bg-white bg-opacity-10 p-3 rounded-3 text-center">
                                    <h3 class="fw-bold mb-0"><?php echo $total_sekolah; ?></h3>
                                    <small class="opacity-75">Sekolah</small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="bg-white bg-opacity-10 p-3 rounded-3 text-center">
                                    <h3 class="fw-bold mb-0"><?php echo number_format($total_kuota); ?></h3>
                                    <small class="opacity-75">Kuota</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Mekanisme Pendaftaran -->
    <section class="py-5 bg-white border-bottom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 mb-4 mb-lg-0">
                    <h2 class="fw-bold mb-4">Mekanisme Pendaftaran</h2>
                    <p class="text-muted mb-5">Ikuti langkah pendaftaran PPDB SMA berikut ini untuk memudahkan proses pendaftaran Anda.</p>
                    
                    <div class="step-list">
                        <div class="step-item">
                            <div class="step-number">1</div>
                            <div class="step-content">
                                <h6 class="fw-bold mb-1">Registrasi Akun</h6>
                                <p class="small text-muted">Pembuatan akun mandiri menggunakan NISN dan NIK.</p>
                            </div>
                        </div>
                        <div class="step-item">
                            <div class="step-number">2</div>
                            <div class="step-content">
                                <h6 class="fw-bold mb-1">Isi Data & Unggah Dokumen</h6>
                                <p class="small text-muted">Lengkapi biodata dan unggah kartu keluarga, ijazah, dll.</p>
                            </div>
                        </div>
                        <div class="step-item">
                            <div class="step-number">3</div>
                            <div class="step-content">
                                <h6 class="fw-bold mb-1">Pilih Jalur & Sekolah</h6>
                                <p class="small text-muted">Pilih jalur (Zonasi/Afirmasi/Prestasi) dan SMA tujuan.</p>
                            </div>
                        </div>
                        <div class="step-item">
                            <div class="step-number">4</div>
                            <div class="step-content">
                                <h6 class="fw-bold mb-1">Verifikasi & Pengumuman</h6>
                                <p class="small text-muted">Pantau status verifikasi dan hasil seleksi akhir.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="p-5 bg-gov-light rounded-4 text-center border">
                        <i class="bi bi-person-badge display-1 text-primary mb-4"></i>
                        <h3 class="fw-bold">Mulai Pendaftaran Anda</h3>
                        <p class="text-muted mb-4">Silakan masuk ke akun atau buat akun baru untuk memulai proses pendaftaran.</p>
                        <div class="d-flex justify-content-center gap-3">
                            <a href="user/login.php" class="btn btn-primary px-4 py-2 rounded-pill shadow-sm">Masuk Akun</a>
                            <a href="user/login.php?action=register" class="btn btn-outline-primary px-4 py-2 rounded-pill">Registrasi</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Fitur Utama -->
    <section class="py-5 bg-gov-light">
        <div class="container text-center py-4">
            <div class="section-title-wrapper">
                <h2 class="fw-bold">Fitur Utama SPMB SMA</h2>
            </div>
            <p class="text-muted mb-5 mx-auto" style="max-width: 700px;">
                Portal terintegrasi untuk pendaftaran, pemetaan, hingga pengumuman hasil seleksi PPDB secara transparan.
            </p>
            
            <div class="row g-4">
                <!-- Fitur 1 -->
                <div class="col-md-4 col-lg-3">
                    <a href="user/login.php" class="text-decoration-none">
                        <div class="card feature-card p-4 text-center shadow-sm">
                            <div class="feature-icon-wrapper bg-primary bg-opacity-10 mx-auto">
                                <i class="bi bi-laptop fs-3 text-primary"></i>
                            </div>
                            <h6 class="fw-bold mb-2 text-dark">Pendaftaran Online</h6>
                            <p class="small text-muted mb-0">Registrasi akun & login mandiri dari rumah.</p>
                        </div>
                    </a>
                </div>
                <!-- Fitur 2 -->
                <div class="col-md-4 col-lg-3">
                    <a href="persyaratan.php" class="text-decoration-none">
                        <div class="card feature-card p-4 text-center shadow-sm">
                            <div class="feature-icon-wrapper bg-success bg-opacity-10 mx-auto">
                                <i class="bi bi-signpost-split fs-3 text-success"></i>
                            </div>
                            <h6 class="fw-bold mb-2 text-dark">Jalur Pendaftaran</h6>
                            <p class="small text-muted mb-0">Zonasi, Afirmasi, Prestasi & Mutasi orang tua.</p>
                        </div>
                    </a>
                </div>
                <!-- Fitur 3 -->
                <div class="col-md-4 col-lg-3">
                    <a href="user/formZonasi.php" class="text-decoration-none">
                        <div class="card feature-card p-4 text-center shadow-sm">
                            <div class="feature-icon-wrapper bg-warning bg-opacity-10 mx-auto">
                                <i class="bi bi-map fs-3 text-warning"></i>
                            </div>
                            <h6 class="fw-bold mb-2 text-dark">Pemetaan Zonasi</h6>
                            <p class="small text-muted mb-0">Penghitungan jarak otomatis (Zonasi GPS).</p>
                        </div>
                    </a>
                </div>
                <!-- Fitur 4 -->
                <div class="col-md-4 col-lg-3">
                    <a href="user/dashboard.php" class="text-decoration-none">
                        <div class="card feature-card p-4 text-center shadow-sm">
                            <div class="feature-icon-wrapper bg-info bg-opacity-10 mx-auto">
                                <i class="bi bi-file-earmark-arrow-up fs-3 text-info"></i>
                            </div>
                            <h6 class="fw-bold mb-2 text-dark">Unggah Dokumen</h6>
                            <p class="small text-muted mb-0">Verifikasi berkas (KK, Rapor, Akta) secara online.</p>
                        </div>
                    </a>
                </div>
                <!-- Fitur 5 -->
                <div class="col-md-4 col-lg-3">
                    <a href="monitoring.php" class="text-decoration-none">
                        <div class="card feature-card p-4 text-center shadow-sm">
                            <div class="feature-icon-wrapper bg-danger bg-opacity-10 mx-auto">
                                <i class="bi bi-graph-up-arrow fs-3 text-danger"></i>
                            </div>
                            <h6 class="fw-bold mb-2 text-dark">Update Real-time</h6>
                            <p class="small text-muted mb-0">Pantau posisi peringkat & hasil seleksi.</p>
                        </div>
                    </a>
                </div>
                <!-- Fitur 6 -->
                <div class="col-md-4 col-lg-3">
                    <a href="user/dashboard.php" class="text-decoration-none">
                        <div class="card feature-card p-4 text-center shadow-sm">
                            <div class="feature-icon-wrapper bg-dark bg-opacity-10 mx-auto">
                                <i class="bi bi-printer fs-3 text-dark"></i>
                            </div>
                            <h6 class="fw-bold mb-2 text-dark">Cetak Bukti</h6>
                            <p class="small text-muted mb-0">Cetak bukti daftar, diterima, & daftar ulang.</p>
                        </div>
                    </a>
                </div>
                <!-- Fitur 7 -->
                <div class="col-md-4 col-lg-3">
                    <a href="#footer" class="text-decoration-none">
                        <div class="card feature-card p-4 text-center shadow-sm">
                            <div class="feature-icon-wrapper bg-primary bg-opacity-10 mx-auto">
                                <i class="bi bi-headset fs-3 text-primary"></i>
                            </div>
                            <h6 class="fw-bold mb-2 text-dark">Helpdesk & Bantuan</h6>
                            <p class="small text-muted mb-0">Layanan pengaduan & FAQ pendaftaran.</p>
                        </div>
                    </a>
                </div>
                <!-- Fitur 8 -->
                <div class="col-md-4 col-lg-3">
                    <a href="jadwal.php" class="text-decoration-none">
                        <div class="card feature-card p-4 text-center shadow-sm">
                            <div class="feature-icon-wrapper bg-secondary bg-opacity-10 mx-auto">
                                <i class="bi bi-calendar-event fs-3 text-secondary"></i>
                            </div>
                            <h6 class="fw-bold mb-2 text-dark">Jadwal PPDB</h6>
                            <p class="small text-muted mb-0">Timeline pendaftaran hingga daftar ulang.</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Requirements Section -->
    <section id="reqSection" class="py-5 bg-white">
        <div class="container requirements-container">
            <div class="row mb-5 justify-content-center">
                <div class="col-lg-8 text-center mt-5 mt-lg-0">
                    <h2 class="fw-bold text-dark">Informasi & Persyaratan</h2>
                    <div class="bg-primary mx-auto mb-3" style="width: 60px; height: 4px; border-radius: 2px;"></div>
                    <p class="text-muted">Pastikan Anda memahami seluruh persyaratan pendaftaran PPDB SMA tahun berjalan</p>
                </div>
            </div>

            <div class="row g-4 justify-content-center">
                <!-- Persyaratan Umum -->
                <div class="col-lg-10">
                    <div class="card shadow-md border-0 mb-4 overflow-hidden">
                        <div class="row g-0">
                            <div class="col-md-4 bg-primary text-white p-4 d-flex flex-column justify-content-center align-items-center">
                                <i class="bi bi-shield-check display-3 mb-3"></i>
                                <h4 class="fw-bold text-center">Persyaratan Umum</h4>
                            </div>
                            <div class="col-md-8 p-4 bg-light bg-opacity-50">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="d-flex mb-3">
                                            <i class="bi bi-1-circle-fill text-primary me-2"></i>
                                            <span><strong>Usia Maksimal:</strong> 21 tahun per 1 Juli (dibuktikan akta/surat lahir).</span>
                                        </div>
                                        <div class="d-flex mb-3">
                                            <i class="bi bi-2-circle-fill text-primary me-2"></i>
                                            <span><strong>Pendidikan:</strong> Lulus SMP/MTs (ijazah atau SKL).</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex mb-3">
                                            <i class="bi bi-3-circle-fill text-primary me-2"></i>
                                            <span><strong>Tahun Lulus:</strong> Tahun berjalan atau tahun sebelumnya.</span>
                                        </div>
                                        <div class="d-flex mb-3 text-warning">
                                            <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                            <small>Boarding negeri tidak boleh ikut PPDB SMA/SMK lain.</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                        
                    <div class="card shadow-md border-0 p-4">
                        <h4 class="fw-bold mb-4 d-flex align-items-center">
                            <i class="bi bi-journal-text text-success me-2"></i>
                            Persyaratan Khusus Berdasarkan Jalur
                        </h4>
                        <div class="accordion accordion-flush" id="accordionRequirements">
                            <!-- Jalur Domisili -->
                            <div class="accordion-item shadow-none border-bottom">
                                <h2 class="accordion-header">
                                    <button class="accordion-button px-0" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
                                        <div class="bg-primary bg-opacity-10 p-2 rounded me-3">
                                            <i class="bi bi-house-door text-primary"></i>
                                        </div>
                                        1. Jalur Domisili (Zonasi)
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionRequirements">
                                    <div class="accordion-body px-0 py-3 text-muted">
                                        <ul>
                                            <li>KK terbit &ge; 1 tahun sebelum pendaftaran.</li>
                                            <li>Nama orang tua/wali harus sesuai di KK, rapor, dan akta lahir.</li>
                                            <li>Surat keterangan domisili hanya berlaku untuk kondisi bencana.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- Jalur Afirmasi -->
                            <div class="accordion-item shadow-none border-bottom">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed px-0" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo">
                                        <div class="bg-success bg-opacity-10 p-2 rounded me-3">
                                            <i class="bi bi-people text-success"></i>
                                        </div>
                                        2. Jalur Afirmasi
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionRequirements">
                                    <div class="accordion-body px-0 py-3 text-muted">
                                        <p class="fw-bold small mb-2">Persyaratan Dokumen:</p>
                                        <ul>
                                            <li><strong>Keluarga tidak mampu:</strong> Kartu PIP atau bansos resmi (bukan SKTM/KIS).</li>
                                            <li><strong>Disabilitas:</strong> Kartu disabilitas/surat dokter + hasil asesmen.</li>
                                            <li><strong>Anak Panti:</strong> Surat keterangan kepala panti asli.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- Jalur Prestasi -->
                            <div class="accordion-item shadow-none border-bottom">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed px-0" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree">
                                        <div class="bg-warning bg-opacity-10 p-2 rounded me-3">
                                            <i class="bi bi-trophy text-warning"></i>
                                        </div>
                                        3. Jalur Prestasi
                                    </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionRequirements">
                                    <div class="accordion-body px-0 py-3 text-muted">
                                        <div class="row">
                                            <div class="col-md-6 border-end">
                                                <strong>Akademik:</strong>
                                                <ul class="small mt-2">
                                                    <li>Rapor sem 1-5 + surat peringkat.</li>
                                                    <li>Sertifikat OSN/KSN/KSM tervalidasi.</li>
                                                </ul>
                                            </div>
                                            <div class="col-md-6 ps-md-4">
                                                <strong>Non-Akademik:</strong>
                                                <ul class="small mt-2">
                                                    <li>Sertifikat seni/olahraga/Hafidz.</li>
                                                    <li>Berlaku maksimal 3 tahun terakhir.</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Jalur Mutasi -->
                            <div class="accordion-item shadow-none">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed px-0" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour">
                                        <div class="bg-danger bg-opacity-10 p-2 rounded me-3">
                                            <i class="bi bi-arrow-left-right text-danger"></i>
                                        </div>
                                        4. Jalur Perpindahan (Mutasi)
                                    </button>
                                </h2>
                                <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionRequirements">
                                    <div class="accordion-body px-0 py-3 text-muted">
                                        <ul>
                                            <li>Surat tugas orang tua (maks. 1 tahun terakhir).</li>
                                            <li>Surat pindah domisili orang tua.</li>
                                            <li><strong>Anak GTK:</strong> SK Tugas + KK.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content (Search & Map) -->
    <div id="searchSection" class="container my-5">
        
        <!-- Search Bar Section -->
        <div class="row mb-5">
            <div class="col-12">
                <div class="card shadow-lg border-0 bg-primary text-white p-4" style="border-radius: 20px;">
                    <div class="row align-items-center">
                        <div class="col-lg-4 mb-3 mb-lg-0">
                            <h4 class="fw-bold mb-1">Cari Sekolah Terdekat</h4>
                            <p class="mb-0 opacity-75 small">Sesuaikan dengan lokasi tempat tinggal Anda</p>
                        </div>
                        <div class="col-lg-8">
                            <form id="searchForm" onsubmit="return false;">
                                <div class="row g-2">
                                    <div class="col-md-5">
                                        <div class="input-group">
                                            <span class="input-group-text border-0 bg-white bg-opacity-10 text-white">
                                                <i class="bi bi-search"></i>
                                            </span>
                                            <input type="text" 
                                                   class="form-control border-0 bg-white bg-opacity-20 text-white placeholder-white" 
                                                   id="searchSchool" 
                                                   placeholder="Nama Sekolah atau NPSN..."
                                                   autocomplete="off">
                                            <button class="btn border-0 text-white bg-white bg-opacity-10" 
                                                    id="clearSchoolSearch" 
                                                    onclick="clearSchoolSearch()" 
                                                    style="display: none;">
                                                <i class="bi bi-x-lg"></i>
                                            </button>
                                        </div>
                                        <div id="schoolSuggestions" class="search-suggestions"></div>
                                    </div>
                                    <div class="col-md-4">
                                        <select class="form-select border-0 bg-white bg-opacity-20 text-white" id="filterKecamatan">
                                            <option value="" class="text-dark">Semua Kecamatan</option>
                                            <option value="Bungus Tlk.Kabung" class="text-dark">Bungus Teluk Kabung</option>
                                            <option value="Lubuk Begalung" class="text-dark">Lubuk Begalung</option>
                                            <option value="Kuranji" class="text-dark">Kuranji</option>
                                            <option value="Pauh" class="text-dark">Pauh</option>
                                            <option value="Lubuk Kilangan" class="text-dark">Lubuk Kilangan</option>
                                            <option value="Koto Tangah" class="text-dark">Koto Tangah</option>
                                            <option value="Nanggalo" class="text-dark">Nanggalo</option>
                                            <option value="Padang Selatan" class="text-dark">Padang Selatan</option>
                                            <option value="Padang Timur" class="text-dark">Padang Timur</option>
                                            <option value="Padang Utara" class="text-dark">Padang Utara</option>
                                            <option value="Padang Barat" class="text-dark">Padang Barat</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <button type="button" 
                                                onclick="getCurrentLocation()" 
                                                class="btn btn-warning w-100 fw-bold shadow-sm">
                                            <i class="bi bi-geo-alt-fill me-1"></i> Lokasi Saya
                                        </button>
                                    </div>
                                </div>
                                <div class="mt-2 d-flex align-items-center small">
                                    <div class="form-check me-3">
                                        <input class="form-check-input bg-white border-0" type="checkbox" id="showZones" checked>
                                        <label class="form-check-label opacity-90" for="showZones">Tampilkan Radius Zonasi</label>
                                    </div>
                                    <a href="javascript:void(0)" onclick="resetAllFilters()" class="text-white opacity-75 text-decoration-none">
                                        <i class="bi bi-arrow-counterclockwise"></i> Reset
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Map -->
        <div class="row py-3">
            <div class="col-12">
                <div class="card overflow-hidden shadow-sm shadow-highlight-hover">
                    <div id="map" style="height: 600px;"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Section Direktori Sekolah -->
    <section id="schoolDirectory" class="py-5 bg-gov-light shadow-sm">
        <div class="container py-4">
            <div class="row mb-5 justify-content-center">
                <div class="col-lg-8 text-center mt-5 mt-lg-0">
                    <div class="badge-ppdb bg-primary bg-opacity-10 text-primary mb-3">Direktori Sekolah</div>
                    <h2 class="fw-bold text-dark">Daftar Lengkap SMA Negeri Kota Padang</h2>
                    <div class="bg-primary mx-auto mb-4" style="width: 80px; height: 5px; border-radius: 2px;"></div>
                    <p class="text-muted lead">Telusuri seluruh sekolah negeri dengan informasi akreditasi, daya tampung, dan lokasi yang akurat.</p>
                </div>
            </div>

            <!-- Filter Bar Direktori -->
            <div class="directory-filter-bar mb-5 animate-fade-in">
                <div class="row g-3 align-items-center">
                    <div class="col-md-5">
                        <div class="input-group">
                            <span class="input-group-text bg-white border-0 ps-0"><i class="bi bi-search text-primary"></i></span>
                            <input type="text" id="dirSearch" class="form-control border-0 shadow-none ps-1" placeholder="Cari nama sekolah (contoh: SMA 1)...">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group">
                            <span class="input-group-text bg-white border-0 ps-0"><i class="bi bi-filter text-primary"></i></span>
                            <select id="dirFilterKec" class="form-select border-0 shadow-none ps-1">
                                <option value="">Semua Kecamatan</option>
                                <option value="lubuk begalung">Lubuk Begalung</option>
                                <option value="kuranji">Kuranji</option>
                                <option value="padang barat">Padang Barat</option>
                                <option value="padang timur">Padang Timur</option>
                                <option value="padang selatan">Padang Selatan</option>
                                <option value="padang utara">Padang Utara</option>
                                <option value="nanggalo">Nanggalo</option>
                                <option value="koto tangah">Koto Tangah</option>
                                <option value="pauh">Pauh</option>
                                <option value="lubuk kilangan">Lubuk Kilangan</option>
                                <option value="bungus tlk.kabung">Bungus Teluk Kabung</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="text-md-end text-muted small">
                            Menampilkan <span id="dirCount" class="fw-bold text-primary"><?php echo count($sekolah_list); ?></span> Sekolah
                        </div>
                    </div>
                </div>
            </div>

            <!-- Grid Sekolah -->
            <div class="row g-4" id="directoryGrid">
                <?php foreach ($sekolah_list as $sekolah): ?>
                    <?php include 'includes/directory_card.php'; ?>
                <?php endforeach; ?>
            </div>
            
            <!-- Empty Search Result -->
            <div id="dirEmpty" class="text-center py-5 d-none animate-fade-in">
                <i class="bi bi-search display-1 text-muted opacity-25 mb-4"></i>
                <h4 class="fw-bold text-muted">Sekolah tidak ditemukan</h4>
                <p class="text-muted">Coba gunakan kata kunci pencarian atau filter kecamatan lain.</p>
                <button onclick="resetDirectoryFilters()" class="btn btn-outline-primary rounded-pill px-4 mt-2">Reset Pencarian</button>
            </div>
        </div>
    </section>

    <!-- Additional Styles for placeholders -->
    <style>
        .placeholder-white::placeholder { color: rgba(255,255,255,0.7) !important; }
        .backdrop-blur { backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px); }
    </style>

    <!-- Pass PHP data to JavaScript -->
    <script>
        window.sekolahData = <?php echo json_encode($sekolah_list); ?>;
    </script>

<?php include 'includes/footer.php'; ?>
