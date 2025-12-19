<?php
require_once 'config.php';
$result = mysqli_query($conn, "DESCRIBE sekolah");
while($row = mysqli_fetch_assoc($result)) {
    echo $row['Field'] . " (" . $row['Type'] . ")\n";
}
?>
