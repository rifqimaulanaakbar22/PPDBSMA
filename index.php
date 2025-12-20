<?php
require_once 'core/config.php';
require_once 'core/functions.php';

$sekolah_list = getAllSekolah($conn);

$statistik = getStatistikSekolah($sekolah_list);
$total_sekolah = $statistik['total_sekolah'];
$total_kuota = $statistik['total_kuota'];
?>

<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar.php'; ?>

<?php include 'includes/sections/hero.php'; ?>
<?php include 'includes/sections/mekanisme.php'; ?>
<?php include 'includes/sections/fitur.php'; ?>
<?php include 'includes/sections/persyaratan.php'; ?>
<?php include 'includes/sections/search_map.php'; ?>
<?php include 'includes/sections/directory.php'; ?>

<!-- Additional Styles for placeholders -->
<style>
    .placeholder-white::placeholder { color: rgba(255,255,255,0.7) !important; }
    .backdrop-blur { backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px); }
</style>

<!-- Pass PHP data to JavaScript -->
<script>
    window.sekolahData = <?php echo json_encode($sekolah_list); ?>;
</script>

<?php include 'includes/footer.php'; ?>
