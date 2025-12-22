<?php
// Siswa Model
class Siswa {
    private $db;

    public function __construct() {
        $this->db = getConnection();
    }

    // Find by ID
    public function find($id) {
        $stmt = $this->db->prepare("SELECT * FROM siswa WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    // Find by User ID
    public function findByUserId($userId) {
        $stmt = $this->db->prepare("SELECT * FROM siswa WHERE user_id = ?");
        $stmt->execute([$userId]);
        return $stmt->fetch();
    }

    // Find by NISN
    public function findByNisn($nisn) {
        $stmt = $this->db->prepare("SELECT * FROM siswa WHERE nisn = ?");
        $stmt->execute([$nisn]);
        return $stmt->fetch();
    }

    // Create new siswa
    public function create($data) {
        $sql = "INSERT INTO siswa (user_id, nisn, nik, nama, tempat_lahir, tanggal_lahir, jenis_kelamin, 
                alamat, kecamatan, sekolah_asal, latitude, longitude) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            $data['user_id'],
            $data['nisn'],
            $data['nik'],
            $data['nama'],
            $data['tempat_lahir'],
            $data['tanggal_lahir'],
            $data['jenis_kelamin'],
            $data['alamat'],
            $data['kecamatan'],
            $data['sekolah_asal'],
            $data['latitude'] ?? null,
            $data['longitude'] ?? null
        ]);
        return $this->db->lastInsertId();
    }

    // Update siswa
    public function update($id, $data) {
        $sql = "UPDATE siswa SET nama = ?, tempat_lahir = ?, tanggal_lahir = ?, jenis_kelamin = ?, 
                alamat = ?, kecamatan = ?, sekolah_asal = ?, latitude = ?, longitude = ?, updated_at = NOW() 
                WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            $data['nama'],
            $data['tempat_lahir'],
            $data['tanggal_lahir'],
            $data['jenis_kelamin'],
            $data['alamat'],
            $data['kecamatan'],
            $data['sekolah_asal'],
            $data['latitude'] ?? null,
            $data['longitude'] ?? null,
            $id
        ]);
    }
}
