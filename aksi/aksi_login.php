<?php
include "../assets/function/function.php";
if (isset($_POST['save'])) {
    session_start();
    $user = $_POST['user'];
    $password = md5($_POST['password']);
    $data = query("SELECT * FROM user WHERE username='$user' or email='$user' and password='$password'");
    $tampil = mysqli_fetch_array($data);
    $cek = mysqli_num_rows($data);
    if ($cek > 0) {
        // cek apakah password sama
        if ($tampil['password'] == $password) {
            $_SESSION['user'] = $user;
            $_SESSION['status'] = "login";
            header("location:../admin/index.php");
        } else {
            $_SESSION['gagal'] = "Password Salah";
            header("location:../login.php?=Password_salah");
        }
    } else {
        $_SESSION['gagal'] = "Username atau email Salah";
        header("location:../login.php?=Username_atau_Email_salah");
    }
} else {
    echo "ERROR: Tidak bisa akses halaman ini tanpa melalui form login";
}
