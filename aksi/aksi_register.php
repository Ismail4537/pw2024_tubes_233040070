<?php
include "../assets/shortcut/koneksi.php";
if (isset($_POST["save"])) {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $password2 = $_POST["password2"];
    // cek apakah email valid
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("location:../register.php?=email_tidak_valid");
        return;
    }
    // cek apakah username valid
    if (!preg_match("/^[a-zA-Z0-9 ]*$/", $username)) {
        header("location:../register.php?=username_tidak_valid");
        return;
    }
    // cek apakah password valid
    // password tidak boleh ada spasi dan hanya boleh berisi huruf dan angka
    if (!preg_match("/^[a-zA-Z0-9]*$/", $password)) {
        header("location:../register.php?=password_tidak_valid");
    }
    // enkripsi password
    $password = md5($_POST["password"]);
    $password2 = md5($_POST["password2"]);
    // cek apakah password sama
    if ($password != $password2) {
        // jika password tidak sama maka akan diarahkan ke halaman register.php
        header("location:../register.php?=password_tidak_sama");
        return;
        // cek apakah password lebih dari 10 kata
    } elseif (strlen($_POST["password"]) < 10) {
        // jika password kurang dari 10 kata maka akan diarahkan ke halaman register.php
        header("location:../register.php?=password_kurang_dari_10_kata");
        return;
    }
    $query_user = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$username' OR email='$email'");
    $tampil_user = mysqli_fetch_assoc($query_user);
    $query_password = mysqli_query($koneksi, "SELECT password FROM user WHERE password='$password'");
    $tampil_password = mysqli_fetch_assoc($query_password);

    // echo $tampil_user['username'];
    // echo "<br>";
    // echo $tampil_user['email'];
    // echo "<br>";
    // echo $tampil_password['password'];
    // echo "<hr>";
    // echo $username;
    // echo "<br>";
    // echo $email;
    // echo "<br>";
    // echo $password;
    // echo "<br>";

    if ($tampil_user['username'] == $username || $tampil_user['email'] == $email) {
        header("location:../register.php?=username_atau_email_sudah_digunakan");
        // echo "username atau email sama";
        return;
    } elseif ($tampil_password['password'] == $password) {
        header("location:../register.php?=password_sudah_digunakan");
        // echo "password sama";
        return;
    }
    // return;

    $query = mysqli_query($koneksi, "INSERT INTO `user` (`id`, `username`, `email`, `password`, `role`, `gambar`) VALUES (NULL, '$username', '$email', '$password', 'admin', '');");
    if ($query) {
        header("location:../admin/index.php");
    } else {
        // jika gagal maka akan diarahkan ke halaman tambah.php
        header("location:../register.php?=gagal_register");
    }
} else {
    echo "ERROR: Tidak bisa akses halaman ini tanpa melalui form tambah data";
}
