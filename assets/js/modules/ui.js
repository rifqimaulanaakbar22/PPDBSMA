import { state } from './state.js';

/**
 * Create HTML content for school popup
 * @param {Object} school 
 * @returns {string}
 */
export function createPopupContent(school) {
    return `
        <div class="popup-content" style="min-width: 408px; padding: 18px;">
            <h5 class="fw-bold mb-3" style="font-size: 1.5rem;">${school.nama}</h5>
            <p class="mb-2" style="font-size: 3rem;">
                <i class="bi bi-geo-alt"></i> ${school.alamat}
            </p>
            <p class="mb-2" style="font-size: 3rem;">
                <i class="bi bi-pin-map"></i> ${school.kecamatan}
            </p>
            <p class="mb-2" style="font-size: 3rem;">
                <i class="bi bi-award"></i> Akreditasi 
                <strong>${school.akreditasi}</strong>
            </p>
            <p class="mb-2" style="font-size: 3rem;">
                <i class="bi bi-award"></i> Kuota Penerimaan 
                <strong>${school.kuota} </strong>siswa
            </p>
            <p class="mb-3" style="font-size: 3rem;">
                <i class="bi bi-award"></i> Jalur Penerimaan 
                <strong>Zonasi, Prestasi</strong>
            </p>
            <a href="${BASE_URL}portal/detail.php?id=${school.id}" 
               class="btn btn-primary w-100 text-white" style="padding: 14px; font-size: 1.2rem;">
                <i class="bi bi-info-circle"></i> Lihat Detail
            </a>
        </div>
    `;
}

/**
 * Display the list of schools in the sidebar
 * @param {Array} schools 
 * @param {boolean} showDistance 
 */
export function displaySchoolList(schools, showDistance = false) {
    const listContainer = document.getElementById('schoolList');
    if (!listContainer) return;

    if (schools.length === 0) {
        listContainer.innerHTML = `
            <div class="text-center text-muted py-5">
                <i class="bi bi-inbox fs-1"></i>
                <p class="mt-3">Tidak ada sekolah ditemukan</p>
            </div>
        `;
        updateListTitle(0);
        return;
    }

    let html = '';
    schools.forEach(school => {

        const distanceBadge = showDistance && school.distance
            ? `<span class="badge ${school.inZone ? 'badge-in-zone' : 'badge-out-zone'} ms-2">
                    ${school.inZone ? 'Dalam Zona' : 'Luar Zona'}
               </span>`
            : '';

        const distanceInfo = showDistance && school.distance
            ? `<small class="text-primary fw-bold">
                    <i class="bi bi-rulers"></i> ${school.distanceFormatted}
               </small>`
            : `<small class="text-muted">
                    <i class="bi bi-people"></i> ${school.kuota} siswa
               </small>`;

        html += `
            <div class="school-card mb-3" 
                 data-id="${school.id}"
                 onclick="window.selectSchool(${school.id})">
                <div class="card-body p-3">
                    <div class="d-flex align-items-start">
                        <div class="flex-fill">
                            <h6 class="mb-1 fw-bold">
                                ${school.nama}
                                ${distanceBadge}
                            </h6>
                            <p class="text-muted small mb-2">
                                <i class="bi bi-geo-alt"></i> ${school.kecamatan}
                            </p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="badge bg-primary">
                                    <i class="bi bi-award"></i> ${school.akreditasi}
                                </span>
                                ${distanceInfo}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;
    });

    listContainer.innerHTML = html;
    updateListTitle(schools.length);
}

/**
 * Handle school selection (from map or list)
 * @param {number|string} schoolId 
 */
export function selectSchool(schoolId) {
    // Hilangkan highlight card sebelumnya
    document.querySelectorAll('.school-card').forEach(card => {
        card.classList.remove('active');
    });

    // Tambahkan highlight pada card yang diklik
    const card = document.querySelector(`.school-card[data-id="${schoolId}"]`);
    if (card) {
        card.classList.add('active');
        card.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    }

    // Ambil data sekolah
    const school = window.sekolahData.find(s => s.id == schoolId);
    if (!school || !state.map) return;

    // Zoom ke lokasi sekolah
    state.map.flyTo([school.latitude, school.longitude], 16, {
        duration: 1.2,
        easeLinearity: 0.25
    });

    // Cari marker sekolah
    const marker = state.schoolMarkers.find(m => m.schoolId == schoolId);

    if (marker) {
        // BUAT ULANG POPUP SETIAP KALI DIKLIK DARI LIST
        const popupHTML = createPopupContent(school);
        marker.bindPopup(popupHTML, {
            maxWidth: 456,
            autoPanPadding: [60, 60]
        }).openPopup();
    }

    state.selectedSchoolId = schoolId;
}

/**
 * Update the title of the school list with count
 * @param {number} count 
 */
export function updateListTitle(count) {
    const listTitle = document.getElementById('listTitle');
    if (listTitle) {
        listTitle.textContent = `Daftar SMA (${count})`;
    }
}

/**
 * Show loading spinner
 */
export function showLoading() {
    const spinner = document.getElementById('loadingSpinner');
    if (spinner) spinner.style.display = 'block';

    const schoolList = document.getElementById('schoolList');
    if (schoolList) schoolList.style.opacity = '0.5';
}

/**
 * Hide loading spinner
 */
export function hideLoading() {
    const spinner = document.getElementById('loadingSpinner');
    if (spinner) spinner.style.display = 'none';

    const schoolList = document.getElementById('schoolList');
    if (schoolList) schoolList.style.opacity = '1';
}
