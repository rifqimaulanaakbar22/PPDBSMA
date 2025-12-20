<nav class="navbar navbar-expand-lg sticky-top py-3">
    <div class="container">
        <a class="navbar-brand fw-bold d-flex align-items-center fs-4" href="<?php echo BASE_URL; ?>index.php">
            <img src="<?php echo BASE_URL; ?>assets/img/logo_kemdikbud.png" alt="Logo" width="55" height="55" class="me-3">
            <span class="d-none d-sm-inline"><?php echo APP_NAME; ?></span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <i class="bi bi-list fs-1 text-primary"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center fs-5">
                <li class="nav-item">
                    <a class="nav-link active" href="<?php echo BASE_URL; ?>index.php">Beranda</a>
                </li>
                
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        Informasi
                    </a>
                    <ul class="dropdown-menu shadow-lg border-0 animate-fade-in">
                        <li><a class="dropdown-item" href="#">Pengumuman</a></li>
                        <li><a class="dropdown-item" href="<?php echo BASE_URL; ?>portal/jadwal.php">Jadwal</a></li>
                        <li><a class="dropdown-item" href="<?php echo BASE_URL; ?>portal/persyaratan.php">Jalur</a></li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="<?php echo BASE_URL; ?>portal/kuota.php">Kuota Pendaftaran</a>
                </li>

                <li class="nav-item ms-lg-3 mt-3 mt-lg-0 d-flex gap-2">
                    <a class="btn btn-primary rounded-pill px-4" href="<?php echo BASE_URL; ?>user/login.php">
                        <i class="bi bi-person-circle me-1"></i> Login Siswa
                    </a>
                    <a class="btn btn-outline-primary rounded-pill px-4" href="<?php echo BASE_URL; ?>admin/login.php">
                        <i class="bi bi-person-badge me-1"></i> Admin
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
