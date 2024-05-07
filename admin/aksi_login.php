<?php
include 'crud/shortcut/koneksi.php';
if (isset($_POST['save'])) {
    session_start();
    $user = $_POST['user'];
    $password = md5($_POST['password']);
    $data = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$user' or email='$user' and password='$password'");
    $cek = mysqli_num_rows($data);
    if ($cek > 0) {
        $_SESSION['user'] = $user;
        $_SESSION['status'] = "login";
        header("location:crud/index.php");
    } else {
        header("location:index.php?=login_gagal");
    }
} else {
    echo "ERROR: Tidak bisa akses halaman ini tanpa melalui form login";
}
