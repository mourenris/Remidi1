<?php
session_start(); include 'koneksi.php';
$id = $_GET['id'];
$row = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM monitoring WHERE id='$id'"));

if(isset($_POST['update'])) {
    $tinggi = $_POST['tinggi'];
    if($tinggi <= 50) $status = "Aman"; elseif($tinggi <= 100) $status = "Waspada"; else $status = "Bahaya";
    
    $foto = $row['foto_bukti'];
    if($_FILES['foto']['name'] != "") {
        unlink("uploads/".$row['foto_bukti']);
        $foto = time()."_".$_FILES['foto']['name'];
        move_uploaded_file($_FILES['foto']['tmp_name'], "uploads/".$foto);
    }
    mysqli_query($conn, "UPDATE monitoring SET lokasi_sungai='".$_POST['lokasi']."', tinggi_air='$tinggi', status_banjir='$status', deskripsi='".$_POST['deskripsi']."', foto_bukti='$foto' WHERE id='$id'");
    header("Location: monitoring.php");
}
?>
<html>
<head><link rel="stylesheet" href="assets/style.css"></head>
<body>
    <div class="container">
        <h2>Edit Data Monitoring</h2>
        <form method="POST" enctype="multipart/form-data">
            <input type="text" name="lokasi" value="<?= $row['lokasi_sungai']; ?>" required><br><br>
            <input type="number" name="tinggi" value="<?= $row['tinggi_air']; ?>" required><br><br>
            <textarea name="deskripsi"><?= $row['deskripsi']; ?></textarea><br><br>
            <p>Foto Lama: <img src="uploads/<?= $row['foto_bukti']; ?>" width="50"></p>
            <input type="file" name="foto"><br><br>
            <button type="submit" name="update" class="btn btn-edit">Update Data</button>
        </form>
    </div>
</body>
</html>