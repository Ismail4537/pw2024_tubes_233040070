<?php
include 'assets/shortcut/koneksi.php';
if (isset($_POST['save'])) {
    session_start();
    $user = $_POST['user'];
    $password = md5($_POST['password']);
    $data = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$user' or email='$user' and password='$password'");
    $tampil = mysqli_fetch_array($data);
    $cek = mysqli_num_rows($data);

    // debugging
    // if ($tampil['password'] != $password) {
    //     echo "password tidak sama";
    // }
    // return;
    // echo $tampil['password'];
    // echo "<br>";
    // echo $password;
    // return;
    // debugging end

    // cek apakah data ada
    if ($cek > 0) {
        // cek apakah password sama
        if ($tampil['password'] == $password) {
            $_SESSION['user'] = $user;
            $_SESSION['status'] = "login";
            header("location:crud/index.php");
        } else {
            header("location:login.php?=Password_salah");
        }
    } else {
        header("location:login.php?=Username_atau_Email_salah");
    }
} else {
    echo "ERROR: Tidak bisa akses halaman ini tanpa melalui form login";
}
