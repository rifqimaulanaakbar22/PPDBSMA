import { state } from './state.js';
import { createPopupContent, updateListTitle, displaySchoolList, selectSchool } from './ui.js';

// Initialize the map
export function initMap() {
    if (state.map) return;

    // Create map centered on Padang
    state.map = L.map('map').setView([-0.9371, 100.3600], 13);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
        maxZoom: 19
    }).addTo(state.map);

    displaySchoolsOnMap();
}

// Clear all markers and circles from map
export function clearMap() {
    if (!state.map) return;
    state.schoolMarkers.forEach(marker => state.map.removeLayer(marker));
    state.zoneCircles.forEach(circle => state.map.removeLayer(circle));
    state.schoolMarkers = [];
    state.zoneCircles = [];
}

// Display schools on map with markers and zone circles
export function displaySchoolsOnMap(schools = null) {
    if (!state.map) return;

    clearMap();

    const showZonesCheckbox = document.getElementById('showZones');
    const showZones = showZonesCheckbox ? showZonesCheckbox.checked : false;
    const schoolsToDisplay = schools || window.sekolahData;

    schoolsToDisplay.forEach(school => {
        // Add zone circle
        if (showZones) {
            const circle = L.circle([school.latitude, school.longitude], {
                color: '#00d269ff',
                fillColor: '#00d269ff',
                fillOpacity: 0.1,
                radius: parseInt(school.radius),
                weight: 2,
                dashArray: '5, 5'
            }).addTo(state.map);
            state.zoneCircles.push(circle);
        }

        // Add marker
        const marker = L.marker([school.latitude, school.longitude])
            .bindPopup(createPopupContent(school), {
                maxWidth: 180,
                autoPanPadding: [20, 20]
            })
            .addTo(state.map);

        marker.schoolId = school.id;
        marker.on('click', function () {
            selectSchool(school.id);
        });

        state.schoolMarkers.push(marker);
    });

    // Update list title
    updateListTitle(schoolsToDisplay.length);

    // Fit bounds if filtered
    if (schools && schools.length > 0 && schools.length < window.sekolahData.length) {
        const bounds = L.latLngBounds(schools.map(s => [s.latitude, s.longitude]));
        state.map.fitBounds(bounds, { padding: [50, 50] });
    }
}
