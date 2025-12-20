<?php

/**
 * Mengambil semua data sekolah dari database
 * @param mysqli $conn Resource koneksi database
 * @return array Array data sekolah
 */
function getAllSekolah($conn) {
    $query = "SELECT * FROM sekolah ORDER BY nama ASC";
    $result = mysqli_query($conn, $query);
    $list = [];
    
    while ($row = mysqli_fetch_assoc($result)) {
        $list[] = $row;
    }
    
    return $list;
}

/**
 * Menghitung total statistik sekolah
 * @param array $sekolah_list Array data sekolah
 * @return array Array statistik (total_sekolah, total_kuota)
 */
function getStatistikSekolah($sekolah_list) {
    return [
        'total_sekolah' => count($sekolah_list),
        'total_kuota' => array_sum(array_column($sekolah_list, 'kuota'))
    ];
}
?>
