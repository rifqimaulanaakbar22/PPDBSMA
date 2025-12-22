<?php
// Admin Controller
require_once ROOT_PATH . 'app/Models/Sekolah.php';
require_once ROOT_PATH . 'app/Models/Pendaftaran.php';

class AdminController {
    
    private function checkAdmin() {
        if (!isset($_SESSION['admin_id'])) {
            redirect('/admin/login');
        }
    }

    // Show Admin Login
    public function showLogin() {
        if (isset($_SESSION['admin_id'])) {
            redirect('/admin');
        }
        view('admin.login');
    }

    // Process Admin Login
    public function login() {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        // Simple admin check (you should use database)
        $db = getConnection();
        $stmt = $db->prepare("SELECT * FROM admin WHERE username = ?");
        $stmt->execute([$username]);
        $admin = $stmt->fetch();

        if ($admin && password_verify($password, $admin['password'])) {
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_name'] = $admin['nama'];
            $_SESSION['admin_role'] = $admin['role'];
            redirect('/admin');
        } else {
            $_SESSION['error'] = 'Username atau Password salah!';
            redirect('/admin/login');
        }
    }

    // Admin Dashboard
    public function dashboard() {
        $this->checkAdmin();
        
        $sekolah = new Sekolah();
        $pendaftaran = new Pendaftaran();
        
        $data = [
            'title' => 'Dashboard Admin',
            'total_sekolah' => $sekolah->getStatistics()['total_sekolah'],
            'total_pendaftar' => $pendaftaran->countByStatus(),
            'pendaftar_pending' => $pendaftaran->countByStatus('pending'),
            'pendaftar_diterima' => $pendaftaran->countByStatus('diterima')
        ];
        
        view('admin.dashboard', $data);
    }

    // Sekolah List
    public function sekolah() {
        $this->checkAdmin();
        
        $sekolah = new Sekolah();
        $data = [
            'title' => 'Data Sekolah',
            'sekolah_list' => $sekolah->all()
        ];
        
        view('admin.sekolah', $data);
    }

    // Tambah Sekolah Form
    public function tambahSekolah() {
        $this->checkAdmin();
        view('admin.tambah-sekolah');
    }

    // Store Sekolah
    public function storeSekolah() {
        $this->checkAdmin();
        
        $data = $_POST;
        
        // Handle photo upload
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = ROOT_PATH . 'public/uploads/sekolah/';
            $filename = uniqid() . '_' . time() . '.' . pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
            $uploadPath = $uploadDir . $filename;
            
            if (move_uploaded_file($_FILES['foto']['tmp_name'], $uploadPath)) {
                $data['foto'] = $filename;
            }
        }
        
        $sekolah = new Sekolah();
        $sekolah->create($data);
        
        $_SESSION['success'] = 'Sekolah berhasil ditambahkan!';
        redirect('/admin/sekolah');
    }

    // Edit Sekolah Form
    public function editSekolah($id) {
        $this->checkAdmin();
        
        $sekolah = new Sekolah();
        $data = [
            'title' => 'Edit Sekolah',
            'sekolah' => $sekolah->find($id)
        ];
        
        view('admin.edit-sekolah', $data);
    }

    // Update Sekolah
    public function updateSekolah($id) {
        $this->checkAdmin();
        
        $sekolah = new Sekolah();
        $data = $_POST;
        
        // Handle photo upload
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = ROOT_PATH . 'public/uploads/sekolah/';
            $filename = uniqid() . '_' . time() . '.' . pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
            $uploadPath = $uploadDir . $filename;
            
            if (move_uploaded_file($_FILES['foto']['tmp_name'], $uploadPath)) {
                // Delete old photo if exists
                $oldData = $sekolah->find($id);
                if (!empty($oldData['foto']) && file_exists($uploadDir . $oldData['foto'])) {
                    unlink($uploadDir . $oldData['foto']);
                }
                $data['foto'] = $filename;
            }
        }
        
        $sekolah->update($id, $data);
        
        $_SESSION['success'] = 'Sekolah berhasil diupdate!';
        redirect('/admin/sekolah');
    }

    // Hapus Sekolah
    public function hapusSekolah($id) {
        $this->checkAdmin();
        
        $sekolah = new Sekolah();
        $sekolah->delete($id);
        
        $_SESSION['success'] = 'Sekolah berhasil dihapus!';
        redirect('/admin/sekolah');
    }
}
