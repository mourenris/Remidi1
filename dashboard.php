<?php
session_start(); include 'koneksi.php';
if(!isset($_SESSION['user_id'])) header("Location: login.php");
include 'navbar.php';

$q_all = mysqli_query($conn, "SELECT COUNT(*) as c FROM monitoring");
$q_aman = mysqli_query($conn, "SELECT COUNT(*) as c FROM monitoring WHERE status_banjir='Aman'");
$q_waspada = mysqli_query($conn, "SELECT COUNT(*) as c FROM monitoring WHERE status_banjir='Waspada'");
$q_bahaya = mysqli_query($conn, "SELECT COUNT(*) as c FROM monitoring WHERE status_banjir='Bahaya'");
$latest = mysqli_query($conn, "SELECT * FROM monitoring ORDER BY waktu_pengukuran DESC LIMIT 1");
?>
<html>
<head><link rel="stylesheet" href="assets/style.css"></head>
<body>
    <div class="container">
        <h2>Dashboard Monitoring</h2>
        <div style="display:flex; gap:20px;">
            <div style="padding:20px; background:#ddd;">Total: <?= mysqli_fetch_assoc($q_all)['c']; ?></div>
            <div style="padding:20px; background:green; color:white;">Aman: <?= mysqli_fetch_assoc($q_aman)['c']; ?></div>
            <div style="padding:20px; background:orange;">Waspada: <?= mysqli_fetch_assoc($q_waspada)['c']; ?></div>
            <div style="padding:20px; background:red; color:white;">Bahaya: <?= mysqli_fetch_assoc($q_bahaya)['c']; ?></div>
        </div>
        <h3>Data Monitoring Terbaru:</h3>
        <?php if($row = mysqli_fetch_assoc($latest)): ?>
            <p>Lokasi: <?= $row['lokasi_sungai']; ?> | Tinggi: <?= $row['tinggi_air']; ?> cm | Status: <?= $row['status_banjir']; ?></p>
        <?php endif; ?>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>