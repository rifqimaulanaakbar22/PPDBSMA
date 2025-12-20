<!-- Hero Section -->
<section class="hero-section text-white">
    <div class="container position-relative z-1">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <div class="d-flex align-items-center mb-4">
                    <div class="bg-white p-2 rounded-circle me-3 shadow-lg">
                        <img src="<?php echo BASE_URL; ?>assets/img/logo_kemdikbud.png" alt="Logo" width="50" height="50">
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
