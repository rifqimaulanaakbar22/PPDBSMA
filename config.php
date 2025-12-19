<?php
define('APP_NAME', 'Sistem PPDB SMA Padang');
define('APP_DESCRIPTION', 'Temukan SMA Negeri di Kota Padang dengan sistem zonasi PPDB');
define('APP_KEYWORDS', 'SMA Padang, Zonasi, PPDB, Sekolah Padang');
define('APP_VERSION', '1.0.0');

$host = "localhost";
$user = "root";
$pass = "";
$db   = "smapadang";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8");

?>