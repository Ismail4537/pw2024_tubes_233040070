<?php
include "crud/shortcut/koneksi.php";
if (isset($_POST["save"])) {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = md5($_POST["password"]);
    $password2 = md5($_POST["password2"]);
    // cek apakah password sama
    if ($password != $password2) {
        // jika password tidak sama maka akan diarahkan ke halaman register.php
        header("location:register.php");
        return;
    }
    $passwordDec = md5($_POST["password"]);
    $query = mysqli_query($koneksi, "INSERT INTO `user` (`id`, `username`, `email`, `password`, `role`, `gambar`) VALUES (NULL, '$username', '$email', '$passwordDec', 'user', '');");
    if ($query) {
        header("location:index.php");
    } else {
        // jika gagal maka akan diarahkan ke halaman tambah.php
        header("location:register.php");
    }
} else {
    echo "ERROR: Tidak bisa akses halaman ini tanpa melalui form tambah data";
}
