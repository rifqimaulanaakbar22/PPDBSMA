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
                                               class="form-control border-0 bg-white text-dark" 
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
                                    <select class="form-select border-0 bg-white bg-opacity-20 text-gray" id="filterKecamatan">
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
