<?php

class SekolahService
{
    public static function getAll($conn)
    {
        $sql = "SELECT id, nama_sekolah, kecamatan, latitude, longitude, kuota, akreditasi 
                FROM sekolah
                WHERE status = 1
                ORDER BY nama_sekolah ASC";

        return $conn->query($sql)->fetch_all(MYSQLI_ASSOC);
    }

    public static function getStatistik(array $sekolah)
    {
        return [
            'total_sekolah' => count($sekolah),
            'total_kuota'   => array_sum(array_column($sekolah, 'kuota'))
        ];
    }
}
