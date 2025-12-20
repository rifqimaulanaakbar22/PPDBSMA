<?php
require_once '../core/config.php';
require_once '../core/functions.php';
?>

<?php include '../includes/header.php'; ?>
<?php include '../includes/navbar.php'; ?>

<style>
    .requirement-card {
        border-radius: 20px;
        border: none;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        background: white;
        overflow: hidden;
    }
    .nav-pills .nav-link {
        border-radius: 12px;
        padding: 14px 28px;
        font-weight: 600;
        color: var(--text-muted);
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        border: 1px solid #e2e8f0;
        background: white;
        margin: 0 5px 10px 5px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .nav-pills .nav-link:hover {
        color: var(--primary-color);
        border-color: var(--primary-color);
        transform: translateY(-2px);
    }
    .nav-pills .nav-link.active {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
        color: white !important;
        box-shadow: 0 8px 20px rgba(12, 77, 162, 0.2);
    }
    .bg-gov-blue {
        background-color: var(--gov-blue) !important;
    }
    .text-gov-blue {
        color: var(--gov-blue) !important;
    }
    .table-scoring thead {
        background-color: #f8fafc;
    }
    .table-scoring th {
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #64748b;
        border-top: none;
    }
    .list-requirement {
        list-style: none;
        padding-left: 0;
    }
    .list-requirement li {
        position: relative;
        padding-left: 30px;
        margin-bottom: 15px;
        line-height: 1.6;
    }
    .list-requirement li::before {
        content: "\F272";
        font-family: "bootstrap-icons";
        position: absolute;
        left: 0;
        top: 3px;
        color: var(--primary-color);
        font-weight: bold;
        font-size: 1.1rem;
    }
    .requirement-card {
        transition: transform 0.3s ease;
    }
    .requirement-card:hover {
        transform: translateY(-5px);
    }
    .scoring-box {
        background: #f1f5f9;
        border-radius: 12px;
        padding: 20px;
    }
</style>

<div class="bg-gov-light py-5">
    <div class="container py-4">
        <!-- Hero Header -->
        <div class="text-center mb-5 animate-fade-in">
            <span class="badge bg-primary bg-opacity-10 text-primary px-4 py-2 rounded-pill mb-3 fw-bold" style="letter-spacing: 1px;">
                <i class="bi bi-info-circle-fill me-1"></i> INFORMASI JALUR
            </span>
            <h1 class="fw-bold display-4 text-dark mb-3">Persyaratan Khusus SMA Negeri</h1>
            <p class="text-muted lead mx-auto" style="max-width: 800px; font-weight: 400;">
                Panduan resmi mengenai kriteria seleksi, kuota pendaftaran, dan sistem penilaian jalur PPDB Sumatera Barat.
            </p>
        </div>

        <!-- Navigation Tabs -->
        <ul class="nav nav-pills mb-5 justify-content-center" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="tab-umum-button" data-bs-toggle="pill" data-bs-target="#tab-umum" type="button" role="tab">
                    <i class="bi bi-info-circle"></i> Persyaratan Umum
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="tab-zonasi-button" data-bs-toggle="pill" data-bs-target="#tab-zonasi" type="button" role="tab">
                    <i class="bi bi-house-door"></i> 1. Jalur Domisili
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="tab-afirmasi-button" data-bs-toggle="pill" data-bs-target="#tab-afirmasi" type="button" role="tab">
                    <i class="bi bi-people"></i> 2. Jalur Afirmasi
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="tab-prestasi-button" data-bs-toggle="pill" data-bs-target="#tab-prestasi" type="button" role="tab">
                    <i class="bi bi-trophy"></i> 3. Jalur Prestasi
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="tab-mutasi-button" data-bs-toggle="pill" data-bs-target="#tab-mutasi" type="button" role="tab">
                    <i class="bi bi-arrow-left-right"></i> 4. Jalur Mutasi
                </button>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content" id="pills-tabContent">
            
            <!-- PERSYARATAN UMUM -->
            <div class="tab-pane fade show active" id="tab-umum" role="tabpanel">
                <div class="requirement-card p-4 p-lg-5">
                    <!-- Header -->
                    <div class="d-flex align-items-center mb-4">
                        <div class="bg-gov-blue text-white p-3 rounded-4 shadow-sm me-3">
                            <i class="bi bi-journal-check fs-3"></i>
                        </div>
                        <div>
                            <h4 class="fw-bold mb-1">Ketentuan Dasar SPMB 2025</h4>
                            <p class="text-muted mb-0 small">Berlaku untuk semua jalur pendaftaran SMA & SMK Negeri</p>
                        </div>
                    </div>
                    
                    <!-- Ketentuan Items -->
                    <div class="mb-4">
                        <div class="d-flex p-3 bg-light rounded-3 mb-3">
                            <div class="me-3 text-primary"><i class="bi bi-calendar-check fs-4"></i></div>
                            <div>
                                <h6 class="fw-bold mb-1">Batas Usia Maksimal</h6>
                                <p class="text-muted small mb-1">Calon murid baru SMA/SMK berusia paling tinggi <strong>21 (dua puluh satu) tahun</strong> pada 01 Juli 2025.</p>
                                <span class="badge bg-primary bg-opacity-10 text-primary">*Dikecualikan bagi penyandang disabilitas</span>
                            </div>
                        </div>
                        <div class="d-flex p-3 bg-light rounded-3 mb-3">
                            <div class="me-3 text-primary"><i class="bi bi-file-earmark-text fs-4"></i></div>
                            <div>
                                <h6 class="fw-bold mb-1">Dokumen Kelahiran</h6>
                                <p class="text-muted small mb-0">Dibuktikan dengan Akta Kelahiran asli atau Surat Keterangan Lahir yang dilegalisasi oleh Lurah/Wali Nagari setempat sesuai domisili.</p>
                            </div>
                        </div>
                        <div class="d-flex p-3 bg-light rounded-3 mb-3">
                            <div class="me-3 text-primary"><i class="bi bi-mortarboard fs-4"></i></div>
                            <div>
                                <h6 class="fw-bold mb-1">Kualifikasi Pendidikan</h6>
                                <p class="text-muted small mb-0">Telah menyelesaikan kelas 9 SMP/MTs sederajat, dibuktikan dengan <strong>Ijazah</strong> atau <strong>Surat Keterangan Lulus (SKL)</strong>.</p>
                            </div>
                        </div>
                        <div class="d-flex p-3 bg-light rounded-3">
                            <div class="me-3 text-danger"><i class="bi bi-house-slash fs-4"></i></div>
                            <div>
                                <h6 class="fw-bold mb-1">Larangan Boarding School</h6>
                                <p class="text-muted small mb-0">Calon murid yang sudah diterima di <strong>Sekolah Boarding Negeri</strong> tidak dapat lagi mengikuti SPMB online.</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Dasar Hukum -->
                    <div class="p-4 bg-primary bg-opacity-10 rounded-4 border border-primary border-opacity-25">
                        <h5 class="fw-bold mb-3 text-primary"><i class="bi bi-shield-check me-2"></i>Dasar Hukum</h5>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2 d-flex align-items-start">
                                <i class="bi bi-check-circle-fill text-primary me-2 mt-1"></i>
                                <span class="small">Permendikdasmen RI No. 3 Tahun 2025 tentang SPMB</span>
                            </li>
                            <li class="mb-2 d-flex align-items-start">
                                <i class="bi bi-check-circle-fill text-primary me-2 mt-1"></i>
                                <span class="small">Peraturan Daerah Prov. Sumbar No. 2 Tahun 2019</span>
                            </li>
                            <li class="d-flex align-items-start">
                                <i class="bi bi-check-circle-fill text-primary me-2 mt-1"></i>
                                <span class="small">Keputusan Kepala Dinas Pendidikan Sumbar No. 423/405/KPTS-2025</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>


            <!-- TAB 2: JALUR DOMISILI -->
    <div class="tab-pane fade" id="tab-zonasi" role="tabpanel">
        <div class="p-4 bg-white rounded-4 shadow-sm border-start border-primary border-5">
            <h5 class="fw-bold text-primary mb-4">Ketentuan Jalur Domisili (Zonasi)</h5>
            <div class="alert alert-info border-0 rounded-3 mb-4">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> Kuota jalur ini paling sedikit <strong>35%</strong> dari daya tampung sekolah.
            </div>
            <div class="row">
                <div class="col-md-6 mb-4 mb-md-0">
                    <h6 class="fw-bold"><i class="bi bi-card-list me-2"></i>Syarat Kartu Keluarga (KK)</h6>
                    <ul class="small text-muted ps-3 mb-0">
                        <li class="mb-2">KK diterbitkan paling singkat <strong>1 (satu) tahun</strong> sebelum pendaftaran.</li>
                        <li class="mb-2">Nama orang tua/wali wajib sama dengan rapor/ijazah/akta kelahiran.</li>
                        <li class="mb-2">KK baru di bawah 1 tahun dapat diterima jika orang tua <strong>Meninggal Dunia</strong> (Akta Kematian) atau <strong>Bercerai</strong> (Akta Cerai).</li>
                        <li class="mb-2">Jika KK hilang/rusak, wajib menyertakan KK lama (jika ada) dan Surat Keterangan Kehilangan dari Kepolisian.</li>
                        <li>Surat Keterangan Domisili hanya berlaku untuk kondisi Bencana Alam/Sosial.</li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <h6 class="fw-bold"><i class="bi bi-sort-numeric-down me-2"></i>Mekanisme Perangkingan</h6>
                    <div class="bg-light p-3 rounded-3 mt-2">
                        <ol class="small mb-0 fw-bold">
                            <li class="mb-2">Jarak domisili tempat tinggal terdekat</li>
                            <li class="mb-2">Usia calon murid yang lebih tua</li>
                            <li>Waktu pendaftaran</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>

            <!-- JALUR AFIRMASI -->
            <div class="tab-pane fade" id="tab-afirmasi" role="tabpanel">
                <div class="requirement-card p-4 p-lg-5">
                    <div class="row align-items-center mb-4">
                        <div class="col-auto">
                            <div class="bg-success text-white p-3 rounded-4 shadow-sm">
                                <i class="bi bi-shield-check fs-2"></i>
                            </div>
                        </div>
                        <div class="col">
                            <h3 class="fw-bold mb-0">Jalur Afirmasi</h3>
                            <p class="text-muted mb-0">Pemerataan akses bagi keluarga tidak mampu dan disabilitas.</p>
                        </div>
                    </div>

                    <div class="row g-4">
                        <div class="col-md-6">
                            <h5 class="fw-bold text-dark border-start border-success border-4 ps-3 mb-4">Keluarga Ekonomi Tidak Mampu</h5>
                            <p class="small text-muted mb-3">Wajib memiliki kartu program penanganan resmi (bukan SKTM/BIS):</p>
                            <ul class="list-requirement">
                                <li><strong>Kartu PIP:</strong> Terdata dalam Dapodik.</li>
                                <li><strong>Kartu PKH/KKS:</strong> Terdata dalam DTSEN Dinas Sosial.</li>
                                <li><strong>Surat Pernyataan:</strong> Bersedia diproses hukum jika memalsukan bukti keikutsertaan.</li>
                            </ul>
                        </div>
                        <div class="col-md-6 border-start">
                            <h5 class="fw-bold text-dark border-start border-warning border-4 ps-3 mb-4">Disabilitas & Anak Panti</h5>
                            <ul class="list-requirement">
                                <li><strong>Disabilitas:</strong> Memiliki kartu disabilitas Kemensos atau surat dokter spesialis + hasil asesmen unit layanan disabilitas.</li>
                                <li><strong>Anak Panti:</strong> Surat keterangan kepala panti asuhan yang diketahui Kepala Dinas Sosial setempat.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- TAB 4: JALUR PRESTASI -->
    <div class="tab-pane fade" id="tab-prestasi" role="tabpanel">
        <div class="row g-4">
            <!-- Prestasi Akademik -->
            <div class="col-md-6">
                <div class="p-4 bg-white rounded-4 shadow-sm border-top border-warning border-5 h-100">
                    <h5 class="fw-bold text-warning mb-4">Prestasi Akademik (Min. 15%)</h5>
                    <div class="mb-4">
                        <h6 class="fw-bold small text-uppercase ls-1 text-muted">A. Jalur Rapor & Peringkat</h6>
                        <p class="small text-muted">Melampirkan peringkat paralel <strong>25% terbaik</strong> di sekolah asal dengan nilai rapor semester 1-5 (kompetensi pengetahuan).</p>
                    </div>
                    <div>
                        <h6 class="fw-bold small text-uppercase ls-1 text-muted">B. Lomba Akademik</h6>
                        <p class="small text-muted">Sertifikat <strong>OSN, OLSN, OPSI, KSM, atau Robotika</strong>. Sertifikat diterbitkan mulai dari <strong>24 Juni 2022</strong> (max 3 tahun).</p>
                    </div>
                </div>
            </div>
            <!-- Prestasi Non-Akademik -->
            <div class="col-md-6">
                <div class="p-4 bg-white rounded-4 shadow-sm border-top border-danger border-5 h-100">
                    <h5 class="fw-bold text-danger mb-4">Prestasi Non-Akademik (Min. 15%)</h5>
                    <div class="mb-4">
                        <h6 class="fw-bold small text-uppercase ls-1 text-muted">A. Kepemimpinan & Organisasi</h6>
                        <p class="small text-muted">Khusus bagi <strong>Ketua OSIS/OSIM</strong> atau <strong>Ketua Pramuka</strong> dengan bukti SK/Sertifikat asli.</p>
                    </div>
                    <div>
                        <h6 class="fw-bold small text-uppercase ls-1 text-muted">B. Bakat & Olahraga</h6>
                        <p class="small text-muted">Prestasi FLS2N, O2SN, GSI, PON, PORPROV, hingga **Hafidz Qur'an** (min. 2 Juz).</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scoring Tables for Achievements -->
        <h5 class="fw-bold mt-5 mb-4 px-2">Sistem Pembobotan Nilai & Skor</h5>
        <div class="row g-4">
            <!-- Tabel Skor Sertifikat Prestasi -->
            <div class="col-lg-12">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                    <div class="card-header bg-gov-light border-0 py-3">
                        <h6 class="fw-bold mb-0">Skor Sertifikat Kejuaraan (Individu/Beregu)</h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-scoring table-hover mb-0 text-center">
                            <thead class="bg-gov-light text-muted">
                                <tr>
                                    <th class="py-3">Juara / Medali</th>
                                    <th class="py-3">Kab/Kota</th>
                                    <th class="py-3">Provinsi</th>
                                    <th class="py-3">Nasional</th>
                                    <th class="py-3">Internasional</th>
                                </tr>
                            </thead>
                            <tbody class="text-dark fw-bold">
                                <tr>
                                    <td class="text-muted">I / Medali Emas</td>
                                    <td>91</td> <td>94</td> <td>97</td> <td class="text-primary">100</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">II / Medali Perak</td>
                                    <td>90</td> <td>93</td> <td>96</td> <td>99</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">III / Medali Perunggu</td>
                                    <td>89</td> <td>92</td> <td>95</td> <td>98</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Tabel OSIS & Pramuka -->
            <div class="col-md-6 mt-4">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100">
                    <div class="card-header bg-primary bg-opacity-10 border-0 py-3">
                        <h6 class="fw-bold text-primary mb-0">Skor Ketua OSIS / Pramuka</h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-sm table-scoring mb-0 text-center">
                            <thead class="bg-light">
                                <tr>
                                    <th class="py-2">Tipe Sekolah (Rombel)</th>
                                    <th class="py-2">Skor</th>
                                </tr>
                            </thead>
                            <tbody class="small">
                                <tr><td>Tipe A (>= 27 Rombel)</td><td class="fw-bold text-primary">91</td></tr>
                                <tr><td>Tipe A1 (24 - 26 Rombel)</td><td class="fw-bold text-primary">90</td></tr>
                                <tr><td>Tipe A2 (21 - 23 Rombel)</td><td class="fw-bold text-primary">89</td></tr>
                                <tr><td>Tipe B (18 - 20 Rombel)</td><td class="fw-bold text-primary">88</td></tr>
                                <tr><td>Tipe B1 (15 - 17 Rombel)</td><td class="fw-bold text-primary">87</td></tr>
                                <tr><td>Tipe B2 (12 - 14 Rombel)</td><td class="fw-bold text-primary">86</td></tr>
                                <tr><td>Tipe C (<= 11 Rombel)</td><td class="fw-bold text-primary">85</td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Tabel Hafidz Quran -->
            <div class="col-md-3 mt-4">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100">
                    <div class="card-header bg-success bg-opacity-10 border-0 py-3">
                        <h6 class="fw-bold text-success mb-0">Hafidz Qur'an</h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-sm table-scoring mb-0 text-center">
                            <thead class="bg-light">
                                <tr><th class="py-2">Jumlah Juz</th><th class="py-2">Skor</th></tr>
                            </thead>
                            <tbody class="small">
                                <tr><td>>= 13 Juz</td><td class="fw-bold text-success">100</td></tr>
                                <tr><td>12 Juz</td><td class="fw-bold text-success">99</td></tr>
                                <tr><td>11 Juz</td><td class="fw-bold text-success">98</td></tr>
                                <tr><td>10 Juz</td><td class="fw-bold text-success">97</td></tr>
                                <tr><td>... s/d 2 Juz</td><td class="fw-bold text-success">89</td></tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer bg-white border-0 py-2">
                        <p class="x-small text-muted mb-0">*Wajib uji ulang di sekolah tujuan.</p>
                    </div>
                </div>
            </div>

            <!-- Tabel Rata-rata Rapor -->
            <div class="col-md-3 mt-4">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100">
                    <div class="card-header bg-info bg-opacity-10 border-0 py-3">
                        <h6 class="fw-bold text-info mb-0">Rerata Rapor</h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-sm table-scoring mb-0 text-center">
                            <thead class="bg-light">
                                <tr><th class="py-2">Nilai Rapor</th><th class="py-2">Skor</th></tr>
                            </thead>
                            <tbody class="small">
                                <tr><td>>= 98</td><td class="fw-bold text-info">94</td></tr>
                                <tr><td>97.00 - 97.99</td><td class="fw-bold text-info">93</td></tr>
                                <tr><td>96.00 - 96.99</td><td class="fw-bold text-info">92</td></tr>
                                <tr><td>... s/d < 85</td><td class="fw-bold text-info">80</td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

            <!-- JALUR MUTASI -->
            <div class="tab-pane fade" id="tab-mutasi" role="tabpanel">
                <div class="requirement-card p-4 p-lg-5">
                    <div class="row align-items-center mb-4">
                        <div class="col-auto">
                            <div class="bg-danger text-white p-3 rounded-4 shadow-sm">
                                <i class="bi bi-briefcase fs-2"></i>
                            </div>
                        </div>
                        <div class="col">
                            <h3 class="fw-bold mb-0">Jalur Mutasi & Anak GTK</h3>
                            <p class="text-muted mb-0">Akomodasi bagi perpindahan tugas dinas dan anak pegawai pendidikan.</p>
                        </div>
                    </div>

                    <div class="row g-4">
                        <div class="col-md-6">
                            <h5 class="fw-bold text-dark border-start border-danger border-4 ps-3 mb-4">Perpindahan Tugas Orang Tua</h5>
                            <ul class="list-requirement">
                                <li><strong>Surat Penugasan:</strong> Dari instansi/lembaga/perusahaan (maks. 1 tahun terakhir).</li>
                                <li><strong>Domisili:</strong> Surat keterangan pindah domisili dari pejabat berwenang.</li>
                            </ul>
                        </div>
                        <div class="col-md-6 border-start">
                            <h5 class="fw-bold text-dark border-start border-info border-4 ps-3 mb-4">Anak GTK (Guru/Tenaga Kependidikan)</h5>
                            <ul class="list-requirement">
                                <li><strong>Penugasan:</strong> Surat tugas orang tua sebagai GTK di sekolah tujuan atau wilayah tersebut.</li>
                                <li><strong>Identitas:</strong> Foto/Scan Kartu Keluarga asli.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quota Summary Section -->
        <div class="mt-5 p-5 bg-white rounded-4 shadow-sm border-0 border-top border-primary border-5">
            <h4 class="fw-bold mb-5 text-center">Persentase Daya Tampung SPMB SMA Negeri 2025</h4>
            <div class="row g-4 text-center">
                <div class="col-md-4">
                    <div class="p-4 bg-primary bg-opacity-10 rounded-4 h-100 border border-primary border-opacity-10">
                        <i class="bi bi-house-door-fill text-primary fs-1 mb-3 d-block"></i>
                        <h2 class="fw-bold text-primary mb-1">Min 35%</h2>
                        <span class="small text-muted fw-bold text-uppercase ls-1">Jalur Domisili</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-4 bg-success bg-opacity-10 rounded-4 h-100 border border-success border-opacity-10">
                        <i class="bi bi-people-fill text-success fs-1 mb-3 d-block"></i>
                        <h2 class="fw-bold text-success mb-1">Min 30%</h2>
                        <span class="small text-muted fw-bold text-uppercase ls-1">Jalur Afirmasi</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-4 bg-warning bg-opacity-10 rounded-4 h-100 border border-warning border-opacity-10">
                        <i class="bi bi-trophy-fill text-warning fs-1 mb-3 d-block"></i>
                        <h2 class="fw-bold text-warning mb-1">Min 30%</h2>
                        <span class="small text-muted fw-bold text-uppercase ls-1">Jalur Prestasi (Akad+Non)</span>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="p-3 bg-danger bg-opacity-10 rounded-4 border border-danger border-opacity-10">
                        <span class="fw-bold text-danger">Max 5% Kuota Jalur Mutasi/Anak GTK</span>
                    </div>
                </div>
            </div>
            <div class="text-center mt-5 text-muted small">
                <i class="bi bi-info-circle me-1"></i> Penentuan kuota didasarkan pada Keputusan Kepala Dinas Pendidikan Provinsi Sumatera Barat No. 423/405/KPTS-2025.
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
