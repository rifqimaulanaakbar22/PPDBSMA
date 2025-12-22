<?php
// Pendaftaran Model
class Pendaftaran {
    private $db;

    public function __construct() {
        $this->db = getConnection();
    }

    // Find by ID
    public function find($id) {
        $sql = "SELECT p.*, s.nama as nama_siswa, s.nisn, s.nik, 
                       sk.nama as nama_sekolah
                FROM pendaftaran p 
                JOIN siswa s ON p.siswa_id = s.id
                JOIN sekolah sk ON p.sekolah_id = sk.id
                WHERE p.id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    // Find by User ID
    public function findByUserId($userId) {
        $sql = "SELECT p.*, s.nama as nama_siswa, s.nisn, s.nik, s.tempat_lahir, s.tanggal_lahir,
                       s.jenis_kelamin, s.alamat, s.kecamatan, s.sekolah_asal,
                       sk.nama as nama_sekolah, sk.alamat as alamat_sekolah
                FROM pendaftaran p 
                JOIN siswa s ON p.siswa_id = s.id
                JOIN sekolah sk ON p.sekolah_id = sk.id
                WHERE s.user_id = ?
                ORDER BY p.tanggal_daftar DESC
                LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$userId]);
        return $stmt->fetch();
    }

    // Create new registration
    public function create($data) {
        // Generate registration number
        $noPendaftaran = 'PPDB' . date('Y') . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
        
        $sql = "INSERT INTO pendaftaran (no_pendaftaran, siswa_id, sekolah_id, jalur, sub_jalur, jarak, status) 
                VALUES (?, ?, ?, ?, ?, ?, 'pending')";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            $noPendaftaran,
            $data['siswa_id'],
            $data['sekolah_id'],
            $data['jalur'],
            $data['sub_jalur'] ?? null,
            $data['jarak'] ?? null
        ]);
        
        return $this->db->lastInsertId();
    }

    // Update status
    public function updateStatus($id, $status, $catatan = null) {
        $sql = "UPDATE pendaftaran SET status = ?, catatan_verifikasi = ?, updated_at = NOW() WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$status, $catatan, $id]);
    }

    // Get by sekolah and jalur
    public function getBySekolahJalur($sekolahId, $jalur) {
        $sql = "SELECT p.*, s.nama as nama_siswa, s.nisn
                FROM pendaftaran p 
                JOIN siswa s ON p.siswa_id = s.id
                WHERE p.sekolah_id = ? AND p.jalur = ?
                ORDER BY p.tanggal_daftar";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$sekolahId, $jalur]);
        return $stmt->fetchAll();
    }

    // Count by status
    public function countByStatus($status = null) {
        if ($status) {
            $stmt = $this->db->prepare("SELECT COUNT(*) as total FROM pendaftaran WHERE status = ?");
            $stmt->execute([$status]);
        } else {
            $stmt = $this->db->query("SELECT COUNT(*) as total FROM pendaftaran");
        }
        return $stmt->fetch()['total'];
    }
}
