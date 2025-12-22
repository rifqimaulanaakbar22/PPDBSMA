<?php
// Siswa Controller - Student dashboard and forms
require_once ROOT_PATH . 'app/Models/User.php';
require_once ROOT_PATH . 'app/Models/Siswa.php';
require_once ROOT_PATH . 'app/Models/Sekolah.php';
require_once ROOT_PATH . 'app/Models/Pendaftaran.php';

class SiswaController {
    
    public function __construct() {
        // Check if logged in
        if (!isLoggedIn()) {
            redirect('/login');
        }
    }

    // Dashboard
    public function dashboard() {
        $data = [
            'title' => 'Dashboard Siswa',
            'username' => $_SESSION['username']
        ];
        
        view('siswa.dashboard', $data);
    }

    // Form Zonasi
    public function formZonasi() {
        $sekolah = new Sekolah();
        $data = [
            'title' => 'Pendaftaran Jalur Zonasi',
            'sekolah_list' => $sekolah->all()
        ];
        
        view('siswa.form-zonasi', $data);
    }

    // Submit Zonasi
    public function submitZonasi() {
        // Get form data
        $siswaData = [
            'user_id' => userId(),
            'nisn' => $_POST['nisn'],
            'nik' => $_POST['nik'],
            'nama' => $_POST['nama'],
            'tempat_lahir' => $_POST['tempat_lahir'],
            'tanggal_lahir' => $_POST['tanggal_lahir'],
            'jenis_kelamin' => $_POST['jk'],
            'alamat' => $_POST['alamat'],
            'kecamatan' => $_POST['kecamatan'],
            'sekolah_asal' => $_POST['sekolah_asal'],
            'latitude' => $_POST['lat'] ?? null,
            'longitude' => $_POST['lng'] ?? null
        ];

        // Create or update siswa
        $siswa = new Siswa();
        $existingSiswa = $siswa->findByUserId(userId());
        
        if ($existingSiswa) {
            $siswa->update($existingSiswa['id'], $siswaData);
            $siswaId = $existingSiswa['id'];
        } else {
            $siswaId = $siswa->create($siswaData);
        }

        // Create pendaftaran
        $pendaftaran = new Pendaftaran();
        $pendaftaran->create([
            'siswa_id' => $siswaId,
            'sekolah_id' => $_POST['sekolah_id'],
            'jalur' => 'zonasi',
            'jarak' => $_POST['jarak'] ?? null
        ]);

        $_SESSION['success'] = 'Pendaftaran berhasil!';
        redirect('/dashboard');
    }

    // Form Afirmasi
    public function formAfirmasi() {
        $sekolah = new Sekolah();
        $data = [
            'title' => 'Pendaftaran Jalur Afirmasi',
            'sekolah_list' => $sekolah->all()
        ];
        
        view('siswa.form-afirmasi', $data);
    }

    // Submit Afirmasi
    public function submitAfirmasi() {
        // Get form data
        $siswaData = [
            'user_id' => userId(),
            'nisn' => $_POST['nisn'],
            'nik' => $_POST['nik'],
            'nama' => $_POST['nama'],
            'tempat_lahir' => $_POST['tempat_lahir'],
            'tanggal_lahir' => $_POST['tanggal_lahir'],
            'jenis_kelamin' => $_POST['jk'],
            'alamat' => $_POST['alamat'],
            'kecamatan' => $_POST['kecamatan'],
            'sekolah_asal' => $_POST['sekolah_asal'],
            'nama_ortu' => $_POST['nama_ortu'] ?? null,
            'pekerjaan_ortu' => $_POST['pekerjaan_ortu'] ?? null,
            'no_hp_ortu' => $_POST['no_hp_ortu'] ?? null,
            'latitude' => $_POST['lat'] ?? null,
            'longitude' => $_POST['lng'] ?? null
        ];

        // Create or update siswa
        $siswa = new Siswa();
        $existingSiswa = $siswa->findByUserId(userId());
        
        if ($existingSiswa) {
            $siswa->update($existingSiswa['id'], $siswaData);
            $siswaId = $existingSiswa['id'];
        } else {
            $siswaId = $siswa->create($siswaData);
        }

        // Create pendaftaran
        $pendaftaran = new Pendaftaran();
        $pendaftaran->create([
            'siswa_id' => $siswaId,
            'sekolah_id' => $_POST['sekolah_id'],
            'jalur' => 'afirmasi',
            'sub_jalur' => $_POST['sub_jalur'] ?? null,
            'jarak' => $_POST['jarak'] ?? null
        ]);

        $_SESSION['success'] = 'Pendaftaran Jalur Afirmasi berhasil! Silakan tunggu verifikasi dokumen.';
        redirect('/dashboard');
    }

    // Form Prestasi
    public function formPrestasi() {
        $sekolah = new Sekolah();
        $data = [
            'title' => 'Pendaftaran Jalur Prestasi',
            'sekolah_list' => $sekolah->all()
        ];
        
        view('siswa.form-prestasi', $data);
    }

    // Submit Prestasi
    public function submitPrestasi() {
        // Get form data
        $siswaData = [
            'user_id' => userId(),
            'nisn' => $_POST['nisn'],
            'nik' => $_POST['nik'],
            'nama' => $_POST['nama'],
            'tempat_lahir' => $_POST['tempat_lahir'],
            'tanggal_lahir' => $_POST['tanggal_lahir'],
            'jenis_kelamin' => $_POST['jk'],
            'alamat' => $_POST['alamat'],
            'kecamatan' => $_POST['kecamatan'],
            'sekolah_asal' => $_POST['sekolah_asal'],
            'no_hp' => $_POST['no_hp'] ?? null,
            'no_hp_ortu' => $_POST['no_hp_ortu'] ?? null
        ];

        // Create or update siswa
        $siswa = new Siswa();
        $existingSiswa = $siswa->findByUserId(userId());
        
        if ($existingSiswa) {
            $siswa->update($existingSiswa['id'], $siswaData);
            $siswaId = $existingSiswa['id'];
        } else {
            $siswaId = $siswa->create($siswaData);
        }

        // Prepare prestasi data as JSON
        $prestasiData = [];
        if (isset($_POST['prestasi_nama'])) {
            for ($i = 0; $i < count($_POST['prestasi_nama']); $i++) {
                if (!empty($_POST['prestasi_nama'][$i])) {
                    $prestasiData[] = [
                        'nama' => $_POST['prestasi_nama'][$i],
                        'bidang' => $_POST['prestasi_bidang'][$i] ?? '',
                        'tingkat' => $_POST['prestasi_tingkat'][$i] ?? '',
                        'juara' => $_POST['prestasi_juara'][$i] ?? '',
                        'tahun' => $_POST['prestasi_tahun'][$i] ?? '',
                        'penyelenggara' => $_POST['prestasi_penyelenggara'][$i] ?? ''
                    ];
                }
            }
        }

        // Create pendaftaran
        $pendaftaran = new Pendaftaran();
        $pendaftaran->create([
            'siswa_id' => $siswaId,
            'sekolah_id' => $_POST['sekolah_id'],
            'jalur' => 'prestasi',
            'sub_jalur' => $_POST['sub_jalur'] ?? null,
            'data_prestasi' => json_encode($prestasiData)
        ]);

        $_SESSION['success'] = 'Pendaftaran Jalur Prestasi berhasil! Silakan tunggu verifikasi dokumen.';
        redirect('/dashboard');
    }

    // Form Mutasi
    public function formMutasi() {
        $sekolah = new Sekolah();
        $data = [
            'title' => 'Pendaftaran Jalur Mutasi',
            'sekolah_list' => $sekolah->all()
        ];
        
        view('siswa.form-mutasi', $data);
    }

    // Submit Mutasi
    public function submitMutasi() {
        // Get form data
        $siswaData = [
            'user_id' => userId(),
            'nisn' => $_POST['nisn'],
            'nik' => $_POST['nik'],
            'nama' => $_POST['nama'],
            'tempat_lahir' => $_POST['tempat_lahir'],
            'tanggal_lahir' => $_POST['tanggal_lahir'],
            'jenis_kelamin' => $_POST['jk'],
            'alamat' => $_POST['alamat'],
            'kecamatan' => $_POST['kecamatan'],
            'sekolah_asal' => $_POST['sekolah_asal'],
            'no_hp' => $_POST['no_hp'] ?? null,
            'email' => $_POST['email'] ?? null,
            'nama_ayah' => $_POST['nama_ayah'] ?? null,
            'nik_ayah' => $_POST['nik_ayah'] ?? null,
            'pekerjaan_ayah' => $_POST['pekerjaan_ayah'] ?? null,
            'instansi_ayah' => $_POST['instansi_ayah'] ?? null,
            'nama_ibu' => $_POST['nama_ibu'] ?? null,
            'no_hp_ortu' => $_POST['no_hp_ortu'] ?? null
        ];

        // Create or update siswa
        $siswa = new Siswa();
        $existingSiswa = $siswa->findByUserId(userId());
        
        if ($existingSiswa) {
            $siswa->update($existingSiswa['id'], $siswaData);
            $siswaId = $existingSiswa['id'];
        } else {
            $siswaId = $siswa->create($siswaData);
        }

        // Prepare perpindahan data as JSON
        $perpindahanData = [
            'alasan_pindah' => $_POST['alasan_pindah'] ?? '',
            'kota_asal' => $_POST['kota_asal'] ?? '',
            'provinsi_asal' => $_POST['provinsi_asal'] ?? '',
            'alamat_asal' => $_POST['alamat_asal'] ?? '',
            'tanggal_pindah' => $_POST['tanggal_pindah'] ?? '',
            'no_sk_mutasi' => $_POST['no_sk_mutasi'] ?? '',
            'tanggal_sk_mutasi' => $_POST['tanggal_sk_mutasi'] ?? ''
        ];

        // Create pendaftaran
        $pendaftaran = new Pendaftaran();
        $pendaftaran->create([
            'siswa_id' => $siswaId,
            'sekolah_id' => $_POST['sekolah_id'],
            'jalur' => 'mutasi',
            'sub_jalur' => 'perpindahan_ortu',
            'data_perpindahan' => json_encode($perpindahanData)
        ]);

        $_SESSION['success'] = 'Pendaftaran Jalur Perpindahan berhasil! Silakan tunggu verifikasi dokumen.';
        redirect('/dashboard');
    }

    // Cetak Bukti Pendaftaran
    public function cetakPendaftaran() {
        $pendaftaran = new Pendaftaran();
        $data = $pendaftaran->findByUserId(userId());
        
        if (!$data) {
            $_SESSION['error'] = 'Anda belum memiliki data pendaftaran.';
            redirect('/dashboard');
        }
        
        view('siswa.cetak-pendaftaran', ['data' => $data]);
    }

    // Cetak Bukti Diterima
    public function cetakDiterima() {
        $pendaftaran = new Pendaftaran();
        $data = $pendaftaran->findByUserId(userId());
        
        if (!$data || $data['status'] !== 'diterima') {
            $_SESSION['error'] = 'Anda belum dinyatakan diterima.';
            redirect('/dashboard');
        }
        
        view('siswa.cetak-diterima', ['data' => $data]);
    }

    // Cetak Bukti Daftar Ulang
    public function cetakDaftarUlang() {
        $pendaftaran = new Pendaftaran();
        $data = $pendaftaran->findByUserId(userId());
        
        if (!$data || $data['status'] !== 'daftar_ulang') {
            $_SESSION['error'] = 'Anda belum melakukan daftar ulang.';
            redirect('/dashboard');
        }
        
        view('siswa.cetak-daftar-ulang', ['data' => $data]);
    }
}
