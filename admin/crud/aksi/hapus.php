<?php
include "../shortcut/koneksi.php";
session_start();
$user = $_SESSION['user'];
$query_user = mysqli_query($koneksi, "SELECT role FROM user WHERE username='$user'");
$tampil = mysqli_fetch_assoc($query_user);
// mengambil id dari url
if (isset($_GET['id'])) {
    // cek apakah user adalah admin
    if ($tampil['role'] == "user") {
        // jika bukan admin maka akan diarahkan ke halaman index.php
        header("location:../index.php?=anda_bukan_admin");
        return;
    }
    $id = $_GET["id"];
    // mengambil gambar dari database
    $query = mysqli_query($koneksi, "SELECT gambar FROM hardware WHERE `id`='$id';");
    $data = mysqli_fetch_array($query);
    $gambar = $data['gambar'];
    // menghapus gambar dari folder gambar
    unlink("../gambar/" . $gambar);
    $query = mysqli_query($koneksi, "DELETE FROM hardware WHERE `id`='$id';");
    // jika berhasil maka akan diarahkan ke halaman index.php
    header("location:../index.php");
} else {
    // jika mencoba mengakses halaman ini tanpa melalui tombol hapus
    echo "ERROR: Tidak bisa akses halaman ini tanpa melalui tombol hapus";
}
