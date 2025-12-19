<?php
require_once 'config.php';
$result = mysqli_query($conn, "SELECT id, nama FROM sekolah");
while($row = mysqli_fetch_assoc($result)) {
    echo $row['id'] . ": " . $row['nama'] . "\n";
}
?>
