-- ============================================
-- DATABASE SCHEMA: PPDB SMA NEGERI KOTA PADANG
-- ============================================
-- Database: smapadang
-- ============================================

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+07:00";
SET FOREIGN_KEY_CHECKS = 0;

-- ============================================
-- DROP EXISTING TABLES
-- ============================================
DROP TABLE IF EXISTS `log_aktivitas`;
DROP TABLE IF EXISTS `pengumuman`;
DROP TABLE IF EXISTS `jadwal`;
DROP TABLE IF EXISTS `mutasi`;
DROP TABLE IF EXISTS `afirmasi`;
DROP TABLE IF EXISTS `prestasi`;
DROP TABLE IF EXISTS `nilai_rapor`;
DROP TABLE IF EXISTS `dokumen`;
DROP TABLE IF EXISTS `pendaftaran`;
DROP TABLE IF EXISTS `siswa`;
DROP TABLE IF EXISTS `admin`;
DROP TABLE IF EXISTS `users`;

-- ============================================
-- 1. TABEL USERS
-- ============================================
CREATE TABLE `users` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `nisn` VARCHAR(10) NOT NULL,
    `nik` VARCHAR(16) NOT NULL,
    `nama` VARCHAR(100) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `email` VARCHAR(100) DEFAULT NULL,
    `no_hp` VARCHAR(15) DEFAULT NULL,
    `status` ENUM('aktif', 'nonaktif') DEFAULT 'aktif',
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE KEY `uk_nisn` (`nisn`),
    UNIQUE KEY `uk_nik` (`nik`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================
-- 2. TABEL ADMIN
-- ============================================
CREATE TABLE `admin` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `username` VARCHAR(50) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `nama` VARCHAR(100) NOT NULL,
    `role` ENUM('super_admin', 'operator_sekolah', 'verifikator') DEFAULT 'operator_sekolah',
    `sekolah_id` INT UNSIGNED DEFAULT NULL,
    `status` ENUM('aktif', 'nonaktif') DEFAULT 'aktif',
    `last_login` TIMESTAMP NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY `uk_username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================
-- 3. TABEL SEKOLAH (skip jika sudah ada)
-- ============================================
-- Tabel sekolah sudah ada, tidak perlu dibuat ulang

-- ============================================
-- 4. TABEL SISWA
-- ============================================
CREATE TABLE `siswa` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT UNSIGNED NOT NULL,
    `nisn` VARCHAR(10) NOT NULL,
    `nik` VARCHAR(16) NOT NULL,
    `nama` VARCHAR(100) NOT NULL,
    `tempat_lahir` VARCHAR(50) NOT NULL,
    `tanggal_lahir` DATE NOT NULL,
    `jenis_kelamin` ENUM('L', 'P') NOT NULL,
    `agama` VARCHAR(20) DEFAULT NULL,
    `alamat` TEXT NOT NULL,
    `rt` VARCHAR(3) DEFAULT NULL,
    `rw` VARCHAR(3) DEFAULT NULL,
    `kelurahan` VARCHAR(50) DEFAULT NULL,
    `kecamatan` VARCHAR(50) NOT NULL,
    `kode_pos` VARCHAR(5) DEFAULT NULL,
    `no_kk` VARCHAR(16) DEFAULT NULL,
    `nama_ayah` VARCHAR(100) DEFAULT NULL,
    `nama_ibu` VARCHAR(100) DEFAULT NULL,
    `no_hp_ortu` VARCHAR(15) DEFAULT NULL,
    `sekolah_asal` VARCHAR(100) NOT NULL,
    `npsn_asal` VARCHAR(8) DEFAULT NULL,
    `tahun_lulus` YEAR DEFAULT NULL,
    `latitude` DECIMAL(10, 8) DEFAULT NULL,
    `longitude` DECIMAL(11, 8) DEFAULT NULL,
    `foto` VARCHAR(255) DEFAULT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================
-- 5. TABEL PENDAFTARAN
-- ============================================
CREATE TABLE `pendaftaran` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `no_pendaftaran` VARCHAR(20) NOT NULL,
    `siswa_id` INT UNSIGNED NOT NULL,
    `sekolah_id` INT UNSIGNED NOT NULL,
    `sekolah_id_2` INT UNSIGNED DEFAULT NULL,
    `jalur` ENUM('zonasi', 'afirmasi', 'prestasi', 'mutasi') NOT NULL,
    `sub_jalur` VARCHAR(50) DEFAULT NULL,
    `jarak` DECIMAL(10, 2) DEFAULT NULL,
    `skor` DECIMAL(10, 2) DEFAULT NULL,
    `peringkat` INT DEFAULT NULL,
    `status` ENUM('draft', 'pending', 'verifikasi', 'terverifikasi', 'ditolak', 'diterima', 'tidak_diterima', 'daftar_ulang') DEFAULT 'draft',
    `catatan_verifikasi` TEXT DEFAULT NULL,
    `verifikator_id` INT UNSIGNED DEFAULT NULL,
    `tanggal_verifikasi` TIMESTAMP NULL,
    `tanggal_daftar` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE KEY `uk_no_pendaftaran` (`no_pendaftaran`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================
-- 6. TABEL DOKUMEN
-- ============================================
CREATE TABLE `dokumen` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `pendaftaran_id` INT UNSIGNED NOT NULL,
    `jenis_dokumen` ENUM('kk', 'akta_lahir', 'ijazah', 'skl', 'rapor', 'foto', 'kartu_pip', 'kartu_disabilitas', 'sertifikat_prestasi', 'surat_tugas', 'sk_gtk', 'lainnya') NOT NULL,
    `nama_file` VARCHAR(255) NOT NULL,
    `path_file` VARCHAR(255) NOT NULL,
    `ukuran` INT DEFAULT NULL,
    `status` ENUM('pending', 'valid', 'tidak_valid') DEFAULT 'pending',
    `catatan` TEXT DEFAULT NULL,
    `uploaded_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================
-- 7. TABEL NILAI_RAPOR
-- ============================================
CREATE TABLE `nilai_rapor` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `pendaftaran_id` INT UNSIGNED NOT NULL,
    `semester_1` DECIMAL(5, 2) DEFAULT NULL,
    `semester_2` DECIMAL(5, 2) DEFAULT NULL,
    `semester_3` DECIMAL(5, 2) DEFAULT NULL,
    `semester_4` DECIMAL(5, 2) DEFAULT NULL,
    `semester_5` DECIMAL(5, 2) DEFAULT NULL,
    `rata_rata` DECIMAL(5, 2) DEFAULT NULL,
    `peringkat_kelas` INT DEFAULT NULL,
    `jumlah_siswa_kelas` INT DEFAULT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================
-- 8. TABEL PRESTASI
-- ============================================
CREATE TABLE `prestasi` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `pendaftaran_id` INT UNSIGNED NOT NULL,
    `jenis_prestasi` ENUM('akademik', 'olahraga', 'seni', 'keagamaan', 'lainnya') NOT NULL,
    `nama_kejuaraan` VARCHAR(200) NOT NULL,
    `tingkat` ENUM('internasional', 'nasional', 'provinsi', 'kabkota', 'kecamatan') NOT NULL,
    `peringkat` ENUM('juara_1', 'juara_2', 'juara_3', 'harapan_1', 'harapan_2', 'harapan_3', 'peserta') NOT NULL,
    `tahun` YEAR NOT NULL,
    `penyelenggara` VARCHAR(200) DEFAULT NULL,
    `skor` INT DEFAULT 0,
    `file_sertifikat` VARCHAR(255) DEFAULT NULL,
    `status_verifikasi` ENUM('pending', 'valid', 'tidak_valid') DEFAULT 'pending',
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================
-- 9. TABEL AFIRMASI
-- ============================================
CREATE TABLE `afirmasi` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `pendaftaran_id` INT UNSIGNED NOT NULL,
    `jenis` ENUM('ekonomi', 'disabilitas', 'anak_panti') NOT NULL,
    `nomor_kartu` VARCHAR(50) DEFAULT NULL,
    `jenis_kartu` VARCHAR(50) DEFAULT NULL,
    `jenis_disabilitas` VARCHAR(100) DEFAULT NULL,
    `nama_panti` VARCHAR(100) DEFAULT NULL,
    `file_dokumen` VARCHAR(255) DEFAULT NULL,
    `status_verifikasi` ENUM('pending', 'valid', 'tidak_valid') DEFAULT 'pending',
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================
-- 10. TABEL MUTASI
-- ============================================
CREATE TABLE `mutasi` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `pendaftaran_id` INT UNSIGNED NOT NULL,
    `jenis` ENUM('pindah_tugas', 'anak_gtk') NOT NULL,
    `instansi` VARCHAR(200) DEFAULT NULL,
    `jabatan_ortu` VARCHAR(100) DEFAULT NULL,
    `nomor_sk` VARCHAR(100) DEFAULT NULL,
    `tanggal_sk` DATE DEFAULT NULL,
    `keterangan` TEXT DEFAULT NULL,
    `file_sk` VARCHAR(255) DEFAULT NULL,
    `status_verifikasi` ENUM('pending', 'valid', 'tidak_valid') DEFAULT 'pending',
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================
-- 11. TABEL JADWAL
-- ============================================
CREATE TABLE `jadwal` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `nama_kegiatan` VARCHAR(200) NOT NULL,
    `jalur` ENUM('semua', 'zonasi', 'afirmasi', 'prestasi', 'mutasi') DEFAULT 'semua',
    `tanggal_mulai` DATE NOT NULL,
    `tanggal_selesai` DATE NOT NULL,
    `waktu_mulai` TIME DEFAULT NULL,
    `waktu_selesai` TIME DEFAULT NULL,
    `keterangan` TEXT DEFAULT NULL,
    `status` ENUM('akan_datang', 'berlangsung', 'selesai') DEFAULT 'akan_datang',
    `urutan` INT DEFAULT 0,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================
-- 12. TABEL PENGUMUMAN
-- ============================================
CREATE TABLE `pengumuman` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `judul` VARCHAR(200) NOT NULL,
    `isi` TEXT NOT NULL,
    `kategori` ENUM('info', 'penting', 'urgent') DEFAULT 'info',
    `tanggal_publish` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `tanggal_expired` TIMESTAMP NULL,
    `is_active` TINYINT(1) DEFAULT 1,
    `created_by` INT UNSIGNED DEFAULT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================
-- 13. TABEL LOG_AKTIVITAS
-- ============================================
CREATE TABLE `log_aktivitas` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT UNSIGNED DEFAULT NULL,
    `admin_id` INT UNSIGNED DEFAULT NULL,
    `aksi` VARCHAR(100) NOT NULL,
    `tabel` VARCHAR(50) DEFAULT NULL,
    `data_id` INT UNSIGNED DEFAULT NULL,
    `detail` TEXT DEFAULT NULL,
    `ip_address` VARCHAR(45) DEFAULT NULL,
    `user_agent` TEXT DEFAULT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================
-- TAMBAHKAN FOREIGN KEY (setelah semua tabel dibuat)
-- ============================================
ALTER TABLE `siswa` ADD CONSTRAINT `fk_siswa_user` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE;
ALTER TABLE `pendaftaran` ADD CONSTRAINT `fk_pendaftaran_siswa` FOREIGN KEY (`siswa_id`) REFERENCES `siswa`(`id`) ON DELETE CASCADE;
ALTER TABLE `dokumen` ADD CONSTRAINT `fk_dokumen_pendaftaran` FOREIGN KEY (`pendaftaran_id`) REFERENCES `pendaftaran`(`id`) ON DELETE CASCADE;
ALTER TABLE `nilai_rapor` ADD CONSTRAINT `fk_nilai_pendaftaran` FOREIGN KEY (`pendaftaran_id`) REFERENCES `pendaftaran`(`id`) ON DELETE CASCADE;
ALTER TABLE `prestasi` ADD CONSTRAINT `fk_prestasi_pendaftaran` FOREIGN KEY (`pendaftaran_id`) REFERENCES `pendaftaran`(`id`) ON DELETE CASCADE;
ALTER TABLE `afirmasi` ADD CONSTRAINT `fk_afirmasi_pendaftaran` FOREIGN KEY (`pendaftaran_id`) REFERENCES `pendaftaran`(`id`) ON DELETE CASCADE;
ALTER TABLE `mutasi` ADD CONSTRAINT `fk_mutasi_pendaftaran` FOREIGN KEY (`pendaftaran_id`) REFERENCES `pendaftaran`(`id`) ON DELETE CASCADE;

SET FOREIGN_KEY_CHECKS = 1;

-- ============================================
-- DATA SAMPLE
-- ============================================
INSERT INTO `jadwal` (`nama_kegiatan`, `jalur`, `tanggal_mulai`, `tanggal_selesai`, `urutan`) VALUES
('Pendaftaran Jalur Zonasi', 'zonasi', '2024-06-17', '2024-06-21', 1),
('Pendaftaran Jalur Afirmasi', 'afirmasi', '2024-06-17', '2024-06-21', 2),
('Pendaftaran Jalur Prestasi', 'prestasi', '2024-06-24', '2024-06-28', 3),
('Pendaftaran Jalur Mutasi', 'mutasi', '2024-07-01', '2024-07-05', 4),
('Verifikasi Dokumen', 'semua', '2024-06-22', '2024-07-06', 5),
('Pengumuman Hasil Seleksi', 'semua', '2024-07-10', '2024-07-10', 6),
('Daftar Ulang', 'semua', '2024-07-11', '2024-07-15', 7);

-- ADMIN DEFAULT (password: admin123)
INSERT INTO `admin` (`username`, `password`, `nama`, `role`) VALUES
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Super Administrator', 'super_admin');
