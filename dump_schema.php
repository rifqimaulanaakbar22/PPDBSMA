<?php
require_once 'config.php';
$result = mysqli_query($conn, "SHOW COLUMNS FROM sekolah");
$columns = [];
while($row = mysqli_fetch_assoc($result)) {
    $columns[] = $row['Field'];
}
echo implode(", ", $columns);
?>
