<?php
session_start(); include 'koneksi.php';
if(isset($_POST['login'])) {
    $email = $_POST['email']; $pass = $_POST['password'];
    $res = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    $u = mysqli_fetch_assoc($res);
    if($u && password_verify($pass, $u['password'])) {
        $_SESSION['user_id'] = $u['id']; $_SESSION['nama'] = $u['nama'];
        header("Location: dashboard.php");
    } else { echo "Login Gagal!"; }
}
?>
<html>
<head><link rel="stylesheet" href="assets/style.css"></head>
<body>
    <div class="container">
        <h2>Login SmartFlood</h2>
        <form method="POST">
            <input type="email" name="email" placeholder="Email" required><br><br>
            <input type="password" name="password" placeholder="Password" required><br><br>
            <button type="submit" name="login" class="btn btn-add">Login</button>
        </form>
    </div>
</body>
</html>