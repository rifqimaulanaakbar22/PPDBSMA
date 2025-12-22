<?php
// Sekolah Model - Updated to match actual database schema
class Sekolah {
    private $db;

    public function __construct() {
        $this->db = getConnection();
    }

    // Get all schools
    public function all() {
        $stmt = $this->db->query("SELECT * FROM sekolah ORDER BY nama");
        return $stmt->fetchAll();
    }

    // Get all schools with quota calculation
    public function allWithKuota() {
        $sql = "SELECT s.*, 
                (SELECT COUNT(*) FROM pendaftaran p WHERE p.sekolah_id = s.id AND p.jalur = 'zonasi') as terisi_zonasi,
                (SELECT COUNT(*) FROM pendaftaran p WHERE p.sekolah_id = s.id AND p.jalur = 'afirmasi') as terisi_afirmasi,
                (SELECT COUNT(*) FROM pendaftaran p WHERE p.sekolah_id = s.id AND p.jalur = 'prestasi') as terisi_prestasi,
                (SELECT COUNT(*) FROM pendaftaran p WHERE p.sekolah_id = s.id AND p.jalur = 'mutasi') as terisi_mutasi
                FROM sekolah s ORDER BY s.nama";
        try {
            $stmt = $this->db->query($sql);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            // Fallback if pendaftaran table doesn't exist
            return $this->all();
        }
    }

    // Find by ID
    public function find($id) {
        $stmt = $this->db->prepare("SELECT * FROM sekolah WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    // Create new school
    public function create($data) {
        $sql = "INSERT INTO sekolah (npsn, nama, alamat, kecamatan, latitude, longitude, kuota, akreditasi, foto) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            $data['npsn'] ?? null,
            $data['nama'],
            $data['alamat'] ?? null,
            $data['kecamatan'] ?? null,
            $data['latitude'] ?? null,
            $data['longitude'] ?? null,
            $data['kuota'] ?? 0,
            $data['akreditasi'] ?? 'A',
            $data['foto'] ?? null
        ]);
    }

    // Update school
    public function update($id, $data) {
        $fields = ['nama', 'npsn', 'alamat', 'kecamatan', 'latitude', 'longitude', 'kuota', 'akreditasi', 
                   'kuota_domisili', 'kuota_afirmasi', 'kuota_prestasi_akademik', 'kuota_prestasi_nonakademik', 'kuota_mutasi'];
        $setClauses = [];
        $values = [];
        
        foreach ($fields as $field) {
            if (isset($data[$field])) {
                $setClauses[] = "$field = ?";
                $values[] = $data[$field];
            }
        }
        
        // Handle foto separately (only if provided)
        if (isset($data['foto'])) {
            $setClauses[] = "foto = ?";
            $values[] = $data['foto'];
        }
        
        if (empty($setClauses)) {
            return false;
        }
        
        $values[] = $id;
        $sql = "UPDATE sekolah SET " . implode(', ', $setClauses) . " WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($values);
    }

    // Delete school
    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM sekolah WHERE id = ?");
        return $stmt->execute([$id]);
    }

    // Get statistics
    public function getStatistics() {
        try {
            $stmt = $this->db->query("SELECT COUNT(*) as total_sekolah, COALESCE(SUM(kuota), 0) as total_kuota FROM sekolah");
            return $stmt->fetch();
        } catch (PDOException $e) {
            return ['total_sekolah' => 0, 'total_kuota' => 0];
        }
    }
}
