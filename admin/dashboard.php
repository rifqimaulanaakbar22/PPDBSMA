<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit;
}
require_once '../core/config.php';

// Hitung statistik
$total_sekolah = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT COUNT(*) as total FROM sekolah")
)['total'];

$total_akreditasi_a = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT COUNT(*) as total FROM sekolah WHERE akreditasi='A'")
)['total'];

$total_akreditasi_b = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT COUNT(*) as total FROM sekolah WHERE akreditasi='B'")
)['total'];

$total_kuota = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT SUM(kuota) as total FROM sekolah")
)['total'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-dark bg-primary">
    <div class="container-fluid">
        <span class="navbar-brand">
            Admin
        </span>
        <a href="logout.php" class="btn btn-light btn-sm">
            <i class="bi bi-box-arrow-right"></i> Logout
        </a>
    </div>
</nav>

<div class="container my-4">
    <h2 class="mb-4">Dashboard</h2>

    <!-- STATISTICS -->
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="card text-white bg-primary shadow">
                <div class="card-body">
                    <h3><?= $total_sekolah ?></h3>
                    <p class="mb-0">Total Sekolah</p>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card text-white bg-success shadow">
                <div class="card-body">
                    <h3><?= $total_akreditasi_a ?></h3>
                    <p class="mb-0">Akreditasi A</p>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card text-white bg-warning shadow">
                <div class="card-body">
                    <h3><?= $total_akreditasi_b ?></h3>
                    <p class="mb-0">Akreditasi B</p>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card text-white bg-info shadow">
                <div class="card-body">
                    <h3><?= number_format($total_kuota) ?></h3>
                    <p class="mb-0">Total Kuota</p>
                </div>
            </div>
        </div>
    </div>

    <!-- QUICK ACTIONS -->
    <div class="row">
        <div class="col-md-6 mb-3">
            <div class="card h-100">
                <div class="card-body">
                    <h5><i class="bi bi-building"></i> Kelola Sekolah</h5>
                    <p class="text-muted">Lihat, tambah, edit, atau hapus data sekolah</p>
                    <a href="data-sekolah.php" class="btn btn-primary">
                        <i class="bi bi-list"></i> Lihat Data Sekolah
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-3">
            <div class="card h-100">
                <div class="card-body">
                    <h5><i class="bi bi-plus-circle"></i> Tambah Sekolah</h5>
                    <p class="text-muted">Tambahkan sekolah baru ke database</p>
                    <a href="tambah-sekolah.php" class="btn btn-success">
                        <i class="bi bi-plus"></i> Tambah Sekolah
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
