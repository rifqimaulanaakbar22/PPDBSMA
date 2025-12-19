<?php
require_once 'config.php';
$result = mysqli_query($conn, "SELECT id, npsn, nama, kecamatan FROM sekolah");
while($row = mysqli_fetch_assoc($result)) {
    echo "ID: " . $row['id'] . " | NPSN: " . $row['npsn'] . " | Name: " . $row['nama'] . " | Kec: " . $row['kecamatan'] . "\n";
}
?>
