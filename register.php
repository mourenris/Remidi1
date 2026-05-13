<?php
include 'koneksi.php';
if(isset($_POST['register'])) {
    $nama = $_POST['nama']; $email = $_POST['email']; $pass = $_POST['password'];
    if(strlen($pass) < 6) { echo "<script>alert('Password minimal 6 karakter!');</script>"; } 
    else {
        $hash = password_hash($pass, PASSWORD_DEFAULT);
        $q = "INSERT INTO users (nama, email, password) VALUES ('$nama', '$email', '$hash')";
        if(mysqli_query($conn, $q)) { header("Location: login.php"); }
    }
}
?>
<html>
<head><link rel="stylesheet" href="assets/style.css"></head>
<body>
    <div class="container">
        <h2>Registrasi Operator</h2>
        <form method="POST">
            <input type="text" name="nama" placeholder="Nama" required><br><br>
            <input type="email" name="email" placeholder="Email" required><br><br>
            <input type="password" name="password" placeholder="Password (Min 6 Karakter)" required><br><br>
            <button type="submit" name="register" class="btn btn-add">Daftar</button>
            <p>Sudah punya akun? <a href="login.php">Login di sini</a></p>
        </form>
    </div>
</body>
</html>