import { state } from './modules/state.js';
import { initMap } from './modules/map.js';
import { selectSchool } from './modules/ui.js';
import { filterSchools, clearSchoolSearch, resetAllFilters, showSchoolSuggestions, hideSchoolSuggestions, selectSchoolFromSuggestion } from './modules/search.js';
import { getCurrentLocation } from './modules/location.js';

// EXPOSE FUNCTIONS TO WINDOW FOR COMPATIBILITY
// These are used in inline onclick handlers in PHP templates
window.selectSchool = selectSchool;
window.clearSchoolSearch = clearSchoolSearch;
window.resetAllFilters = resetAllFilters;
window.getCurrentLocation = getCurrentLocation;
window.selectSchoolFromSuggestion = selectSchoolFromSuggestion;

/**
 * Initialize on page load
 */
document.addEventListener('DOMContentLoaded', function () {
    // Initialize Map
    initMap();

    // Event Listeners for Search Input
    const searchSchoolInput = document.getElementById('searchSchool');
    if (searchSchoolInput) {
        searchSchoolInput.addEventListener('input', function (e) {
            const keyword = e.target.value.trim();
            state.currentSearchSchool = keyword;

            // Tampilkan/sembunyikan tombol clear
            const clearBtn = document.getElementById('clearSchoolSearch');
            if (clearBtn) clearBtn.style.display = keyword ? 'block' : 'none';

            // Tampilkan suggestions
            if (keyword.length >= 2) {
                showSchoolSuggestions(keyword);
            } else {
                hideSchoolSuggestions();
            }
            filterSchools();
        });
    }

    // Toggle zones
    const showZonesCheckbox = document.getElementById('showZones');
    if (showZonesCheckbox) {
        showZonesCheckbox.addEventListener('change', function () {
            filterSchools();
        });
    }

    // Filter kecamatan
    const filterKecamatanSelect = document.getElementById('filterKecamatan');
    if (filterKecamatanSelect) {
        filterKecamatanSelect.addEventListener('change', function () {
            state.currentFilterKecamatan = this.value;
            filterSchools();
        });
    }

    // Close suggestions when clicking outside
    document.addEventListener('click', function (e) {
        if (!e.target.closest('#searchSchool') && !e.target.closest('#schoolSuggestions')) {
            hideSchoolSuggestions();
        }
    });

    console.log('Sistem Zonasi SMA Padang loaded successfully!');
    if (window.sekolahData) {
        console.log('Total sekolah:', window.sekolahData.length);
    }
});
