<?php
// Home Controller - Public pages
require_once ROOT_PATH . 'app/Models/Sekolah.php';

class HomeController {
    
    // Homepage
    public function index() {
        $sekolah = new Sekolah();
        $data = [
            'title' => 'Beranda',
            'sekolah_list' => $sekolah->all(),
            'stats' => $sekolah->getStatistics()
        ];
        
        view('layouts.header', $data);
        view('layouts.navbar');
        view('portal.home', $data);
        view('layouts.footer');
    }

    // Kuota Page
    public function kuota() {
        $sekolah = new Sekolah();
        $data = [
            'title' => 'Kuota Pendaftaran',
            'sekolah_list' => $sekolah->allWithKuota(),
            'stats' => $sekolah->getStatistics()
        ];
        
        view('layouts.header', $data);
        view('layouts.navbar');
        view('portal.kuota', $data);
        view('layouts.footer');
    }

    // Detail Sekolah
    public function detail($id) {
        $sekolah = new Sekolah();
        $data = [
            'title' => 'Detail Sekolah',
            'sekolah' => $sekolah->find($id)
        ];
        
        if (!$data['sekolah']) {
            redirect('/kuota');
        }
        
        view('layouts.header', $data);
        view('layouts.navbar');
        view('portal.detail', $data);
        view('layouts.footer');
    }

    // Jadwal Page
    public function jadwal() {
        $data = ['title' => 'Jadwal PPDB'];
        
        view('layouts.header', $data);
        view('layouts.navbar');
        view('portal.jadwal');
        view('layouts.footer');
    }

    // Persyaratan Page
    public function persyaratan() {
        $data = ['title' => 'Persyaratan PPDB'];
        
        view('layouts.header', $data);
        view('layouts.navbar');
        view('portal.persyaratan');
        view('layouts.footer');
    }
}
