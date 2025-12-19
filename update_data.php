<?php
require_once 'config.php';

$schools = [
    [
        'npsn' => '69948163',
        'nama' => 'SMA NEGERI 4 SUMATERA BARAT (KEBERBAKATAN OLAHRAGA)',
        'kecamatan' => 'Kuranji',
        'kuota' => 255,
        'akreditasi' => 'B'
    ],
    [
        'npsn' => '10303461',
        'nama' => 'SMAN 1 PADANG',
        'kecamatan' => 'Padang Utara',
        'kuota' => 224,
        'akreditasi' => 'A'
    ],
    [
        'npsn' => '10303462',
        'nama' => 'SMAN 10 PADANG',
        'kecamatan' => 'Padang Timur',
        'kuota' => 256,
        'akreditasi' => 'A'
    ],
    [
        'npsn' => '10303463',
        'nama' => 'SMAN 11 PADANG',
        'kecamatan' => 'Kuranji',
        'kuota' => 256,
        'akreditasi' => 'A'
    ],
    [
        'npsn' => '10303480',
        'nama' => 'SMAN 12 PADANG',
        'kecamatan' => 'Koto Tangah',
        'kuota' => 256,
        'akreditasi' => 'A'
    ],
    [
        'npsn' => '10303481',
        'nama' => 'SMAN 13 PADANG',
        'kecamatan' => 'Koto Tangah',
        'kuota' => 256,
        'akreditasi' => 'A'
    ]
];

foreach ($schools as $s) {
    $npsn = $s['npsn'];
    $nama = mysqli_real_escape_string($conn, $s['nama']);
    $kec = mysqli_real_escape_string($conn, $s['kecamatan']);
    $kuota = $s['kuota'];
    $akr = $s['akreditasi'];
    
    // First, find if any record matches name or NPSN
    $find = mysqli_query($conn, "SELECT id FROM sekolah WHERE npsn = '$npsn' OR nama = '$nama' LIMIT 1");
    if ($row = mysqli_fetch_assoc($find)) {
        $id = $row['id'];
        $query = "UPDATE sekolah SET 
                  npsn = '$npsn',
                  nama = '$nama', 
                  kecamatan = '$kec', 
                  kuota = $kuota, 
                  akreditasi = '$akr' 
                  WHERE id = $id";
    } else {
        $query = "INSERT INTO sekolah (npsn, nama, kecamatan, kuota, akreditasi) 
                  VALUES ('$npsn', '$nama', '$kec', $kuota, '$akr')";
    }
    
    if (mysqli_query($conn, $query)) {
        echo "Processed: $nama\n";
    } else {
        echo "Error processing $nama: " . mysqli_error($conn) . "\n";
    }
}
?>
