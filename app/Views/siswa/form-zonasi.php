<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Zonasi - <?php echo APP_NAME; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="stylesheet" href="<?php echo asset('css/style.css'); ?>">
    <style>
        .form-section { background: white; border-radius: 16px; padding: 2rem; margin-bottom: 1.5rem; box-shadow: 0 2px 10px rgba(0,0,0,0.05); display: none; }
        .form-section.active { display: block; animation: fadeIn 0.3s; }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        .step-circle { width: 40px; height: 40px; border: 2px solid #e2e8f0; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; background: white; color: #94a3b8; z-index: 2; }
        .step-circle.active { border-color: #0d6efd; color: #0d6efd; background: #e7f1ff; }
        .step-circle.completed { background: #0d6efd; color: white; border-color: #0d6efd; }
        .school-card { border: 2px solid #e2e8f0; border-radius: 12px; padding: 1rem; cursor: pointer; transition: all 0.2s; }
        .school-card:hover, .school-card.selected { border-color: #0d6efd; background: #f8fafc; }
        .upload-area { border: 2px dashed #e2e8f0; border-radius: 12px; padding: 2rem; text-align: center; cursor: pointer; }
        .upload-area:hover { border-color: #0d6efd; }
    </style>
</head>
<body class="bg-light">

<nav class="navbar sticky-top bg-white border-bottom">
    <div class="container">
        <a class="navbar-brand fw-bold" href="<?php echo url('/dashboard'); ?>">
            <i class="bi bi-arrow-left me-2"></i>Kembali ke Dashboard
        </a>
    </div>
</nav>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="text-center mb-5">
                <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill mb-3">JALUR ZONASI</span>
                <h2 class="fw-bold">Formulir Pendaftaran</h2>
            </div>

            <!-- Step Indicator -->
            <div class="d-flex justify-content-between mb-5 position-relative">
                <div class="position-absolute top-50 start-0 end-0" style="height: 2px; background: #e2e8f0; z-index: 1;"></div>
                <div class="d-flex flex-column align-items-center" style="z-index: 2;">
                    <div class="step-circle active" id="sc1">1</div>
                    <small class="mt-2 fw-semibold">Biodata</small>
                </div>
                <div class="d-flex flex-column align-items-center" style="z-index: 2;">
                    <div class="step-circle" id="sc2">2</div>
                    <small class="mt-2">Alamat</small>
                </div>
                <div class="d-flex flex-column align-items-center" style="z-index: 2;">
                    <div class="step-circle" id="sc3">3</div>
                    <small class="mt-2">Sekolah</small>
                </div>
                <div class="d-flex flex-column align-items-center" style="z-index: 2;">
                    <div class="step-circle" id="sc4">4</div>
                    <small class="mt-2">Berkas</small>
                </div>
            </div>

            <form action="<?php echo url('/daftar/zonasi'); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                
                <!-- Step 1 -->
                <div class="form-section active" id="step1">
                    <h5 class="fw-bold mb-4"><i class="bi bi-person-vcard text-primary me-2"></i>Data Identitas</h5>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">NISN</label>
                            <input type="text" name="nisn" class="form-control" maxlength="10" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">NIK</label>
                            <input type="text" name="nik" class="form-control" maxlength="16" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Sekolah Asal</label>
                            <input type="text" name="sekolah_asal" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Jenis Kelamin</label>
                            <select name="jk" class="form-select" required>
                                <option value="">Pilih...</option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mt-4">
                        <button type="button" class="btn btn-primary px-4" onclick="nextStep(1)">Lanjutkan <i class="bi bi-chevron-right"></i></button>
                    </div>
                </div>

                <!-- Step 2 -->
                <div class="form-section" id="step2">
                    <h5 class="fw-bold mb-4"><i class="bi bi-geo-alt text-primary me-2"></i>Alamat & Lokasi</h5>
                    <div class="row g-3">
                        <div class="col-md-8">
                            <label class="form-label fw-semibold">Alamat Lengkap</label>
                            <textarea name="alamat" class="form-control" rows="3" required></textarea>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Kecamatan</label>
                            <select name="kecamatan" class="form-select" required>
                                <option value="">Pilih...</option>
                                <option>Koto Tangah</option>
                                <option>Kuranji</option>
                                <option>Padang Barat</option>
                                <option>Padang Timur</option>
                                <option>Padang Utara</option>
                                <option>Lubuk Begalung</option>
                            </select>
                        </div>
                    </div>
                    <div id="mapContainer" class="rounded-3 my-4" style="height: 300px;"></div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Latitude</label>
                            <input type="text" id="lat" name="lat" class="form-control" readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Longitude</label>
                            <input type="text" id="lng" name="lng" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between mt-4">
                        <button type="button" class="btn btn-outline-secondary px-4" onclick="prevStep(2)"><i class="bi bi-chevron-left"></i> Kembali</button>
                        <button type="button" class="btn btn-primary px-4" onclick="nextStep(2)">Lanjutkan <i class="bi bi-chevron-right"></i></button>
                    </div>
                </div>

                <!-- Step 3 -->
                <div class="form-section" id="step3">
                    <h5 class="fw-bold mb-4"><i class="bi bi-building text-primary me-2"></i>Pilih Sekolah</h5>
                    <div class="row g-3">
                        <?php foreach ($sekolah_list as $s): ?>
                        <div class="col-md-6">
                            <label class="school-card d-block">
                                <input type="radio" name="sekolah_id" value="<?php echo $s['id']; ?>" class="d-none" required>
                                <div class="d-flex align-items-center">
                                    <div class="bg-primary bg-opacity-10 rounded-3 p-2 me-3">
                                        <i class="bi bi-building text-primary"></i>
                                    </div>
                                    <div>
                                        <div class="fw-bold"><?php echo e($s['nama']); ?></div>
                                        <small class="text-muted"><?php echo e($s['kecamatan']); ?></small>
                                    </div>
                                </div>
                            </label>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="d-flex justify-content-between mt-4">
                        <button type="button" class="btn btn-outline-secondary px-4" onclick="prevStep(3)"><i class="bi bi-chevron-left"></i> Kembali</button>
                        <button type="button" class="btn btn-primary px-4" onclick="nextStep(3)">Lanjutkan <i class="bi bi-chevron-right"></i></button>
                    </div>
                </div>

                <!-- Step 4 -->
                <div class="form-section" id="step4">
                    <h5 class="fw-bold mb-4"><i class="bi bi-folder text-primary me-2"></i>Upload Berkas</h5>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Kartu Keluarga</label>
                            <input type="file" name="file_kk" class="form-control" accept=".pdf,.jpg,.png">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Akta Kelahiran</label>
                            <input type="file" name="file_akta" class="form-control" accept=".pdf,.jpg,.png">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Ijazah/SKL</label>
                            <input type="file" name="file_ijazah" class="form-control" accept=".pdf,.jpg,.png">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Pas Foto</label>
                            <input type="file" name="file_foto" class="form-control" accept=".jpg,.png">
                        </div>
                    </div>
                    <div class="d-flex justify-content-between mt-4">
                        <button type="button" class="btn btn-outline-secondary px-4" onclick="prevStep(4)"><i class="bi bi-chevron-left"></i> Kembali</button>
                        <button type="submit" class="btn btn-success px-4"><i class="bi bi-check-circle me-2"></i>Kirim Pendaftaran</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
let currentStep = 1;
let map, marker;

function nextStep(s) { currentStep = s + 1; updateSteps(); }
function prevStep(s) { currentStep = s - 1; updateSteps(); }

function updateSteps() {
    for (let i = 1; i <= 4; i++) {
        document.getElementById('step' + i).classList.remove('active');
        document.getElementById('sc' + i).classList.remove('active', 'completed');
    }
    document.getElementById('step' + currentStep).classList.add('active');
    document.getElementById('sc' + currentStep).classList.add('active');
    for (let i = 1; i < currentStep; i++) document.getElementById('sc' + i).classList.add('completed');
    if (currentStep === 2 && !map) initMap();
    if (map) setTimeout(() => map.invalidateSize(), 100);
}

function initMap() {
    map = L.map('mapContainer').setView([-0.9471, 100.4172], 13);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
    
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(pos => {
            map.setView([pos.coords.latitude, pos.coords.longitude], 16);
            setMarker(pos.coords.latitude, pos.coords.longitude);
        });
    }
    
    map.on('click', e => setMarker(e.latlng.lat, e.latlng.lng));
}

function setMarker(lat, lng) {
    if (marker) map.removeLayer(marker);
    marker = L.marker([lat, lng], {draggable: true}).addTo(map);
    document.getElementById('lat').value = lat.toFixed(8);
    document.getElementById('lng').value = lng.toFixed(8);
    marker.on('dragend', e => {
        document.getElementById('lat').value = e.target.getLatLng().lat.toFixed(8);
        document.getElementById('lng').value = e.target.getLatLng().lng.toFixed(8);
    });
}

document.querySelectorAll('.school-card').forEach(c => {
    c.addEventListener('click', () => {
        document.querySelectorAll('.school-card').forEach(x => x.classList.remove('selected'));
        c.classList.add('selected');
    });
});
</script>
</body>
</html>
