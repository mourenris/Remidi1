<?php
session_start(); include 'koneksi.php';
if(isset($_POST['simpan'])) {
    $tinggi = $_POST['tinggi'];
    if($tinggi <= 50) $status = "Aman";
    elseif($tinggi <= 100) $status = "Waspada";
    else $status = "Bahaya";

    $foto = $_FILES['foto']['name'];
    $tmp = $_FILES['foto']['tmp_name'];
    $ext = pathinfo($foto, PATHINFO_EXTENSION);
    $allowed = ['jpg', 'jpeg', 'png'];

    if(in_array(strtolower($ext), $allowed)) {
        $nama_baru = time()."_".$foto;
        move_uploaded_file($tmp, "uploads/".$nama_baru);
        $q = "INSERT INTO monitoring (user_id, lokasi_sungai, waktu_pengukuran, tinggi_air, status_banjir, deskripsi, foto_bukti) 
              VALUES ('".$_SESSION['user_id']."', '".$_POST['lokasi']."', NOW(), '$tinggi', '$status', '".$_POST['deskripsi']."', '$nama_baru')";
        mysqli_query($conn, $q);
        header("Location: monitoring.php");
    }
}
?>
<html>
<head><link rel="stylesheet" href="assets/style.css"></head>
<body>
    <div class="container">
        <h2>Tambah Data Monitoring</h2>
        <form method="POST" enctype="multipart/form-data">
            <input type="text" name="lokasi" placeholder="Lokasi Sungai" required><br><br>
            <input type="number" name="tinggi" placeholder="Tinggi Air (cm)" required><br><br>
            <textarea name="deskripsi" placeholder="Deskripsi Lapangan"></textarea><br><br>
            <input type="file" name="foto" required><br><br>
            <button type="submit" name="simpan" class="btn btn-add">Simpan Data</button>
        </form>
    </div>
</body>
</html>