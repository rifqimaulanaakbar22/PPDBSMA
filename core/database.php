<?php
/**
 * Database Connection
 * 
 * File ini berisi koneksi database yang terpisah dari config.php
 * untuk modularitas yang lebih baik.
 */

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
