<?php
session_start(); include 'koneksi.php';
if(!isset($_SESSION['user_id'])) header("Location: login.php");
include 'navbar.php';
$uid = $_SESSION['user_id'];
$data = mysqli_query($conn, "SELECT * FROM monitoring WHERE user_id='$uid'");
?>
<html>
<head><link rel="stylesheet" href="assets/style.css"></head>
<body>
    <div class="container">
        <h2>Daftar Monitoring Sungai</h2>
        <a href="tambah_monitoring.php" class="btn btn-add">+ Tambah Data</a>
        <table>
            <tr>
                <th>Lokasi Sungai</th><th>Waktu</th><th>Tinggi (cm)</th><th>Status</th><th>Deskripsi</th><th>Bukti</th><th>Aksi</th>
            </tr>
            <?php while($row = mysqli_fetch_assoc($data)): ?>
            <tr>
                <td><?= $row['lokasi_sungai']; ?></td>
                <td><?= $row['waktu_pengukuran']; ?></td>
                <td><?= $row['tinggi_air']; ?></td>
                <td><span class="status-<?= strtolower($row['status_banjir']); ?>"><?= $row['status_banjir']; ?></span></td>
                <td><?= $row['deskripsi']; ?></td>
                <td><img src="uploads/<?= $row['foto_bukti']; ?>" width="80"></td>
                <td>
                    <a href="edit_monitoring.php?id=<?= $row['id']; ?>" class="btn btn-edit">Edit</a>
                    <a href="hapus_monitoring.php?id=<?= $row['id']; ?>" class="btn btn-delete" onclick="return confirm('Hapus data ini?')">Hapus</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>