<?php
include 'koneksi.php';
$id = $_GET['id'];
$res = mysqli_query($conn, "SELECT foto_bukti FROM monitoring WHERE id='$id'");
$data = mysqli_fetch_assoc($res);

if($data) {
    if(file_exists("uploads/".$data['foto_bukti'])) {
        unlink("uploads/".$data['foto_bukti']); // Hapus file fisik [cite: 112]
    }
    mysqli_query($conn, "DELETE FROM monitoring WHERE id='$id'"); // Hapus data [cite: 111]
}
header("Location: monitoring.php");
?>