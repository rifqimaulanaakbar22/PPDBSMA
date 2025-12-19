<?php
require_once 'config.php';
$result = mysqli_query($conn, "SELECT * FROM sekolah");
$data = [];
while($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}
file_put_contents('sekolah_dump.json', json_encode($data, JSON_PRETTY_PRINT));
echo "Dumped " . count($data) . " schools to sekolah_dump.json";
?>
