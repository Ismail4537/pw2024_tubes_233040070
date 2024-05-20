<?php
include "../../../assets/function/function.php";
session_start();
$user = $_SESSION['user'];
$query_user = query("SELECT role FROM user WHERE username='$user'");
$tampil = mysqli_fetch_assoc($query_user);
// mengambil id dari url
if (isset($_GET['id_hardware'])) {
    // cek apakah user adalah admin
    if ($_SESSION['status'] != "login") {
        header("location:../../../index.php?=belum_login");
        return;
    }
    $id = $_GET["id_hardware"];
    // mengambil gambar dari database
    $query = query("SELECT gambar FROM hardware WHERE `id_hardware`='$id';");
    $data = mysqli_fetch_array($query);
    $gambar = $data['gambar'];
    // menghapus gambar dari folder gambar
    cek_gambar($gambar, "gambar");
    $query = query("DELETE FROM hardware WHERE `id_hardware`='$id';");
    if ($query) {
        // jika berhasil maka akan diarahkan ke halaman index.php
        header("location:../../hardware.php#main");
    } else {
        echo "Gagal menghapus data";
    }
} else if (isset($_GET['id_harga'])) {
    if ($_SESSION['status'] != "login") {
        header("location:../../../index.php?=belum_login");
        return;
    }
    $id = $_GET["id_harga"];
    $query = query("DELETE FROM harga WHERE `id_harga`='$id';");
    if ($query) {
        // jika berhasil maka akan diarahkan ke halaman harga.php
        header("location:../../index.php#main");
    } else {
        echo "Gagal menghapus data";
    }
} else {
    // jika mencoba mengakses halaman ini tanpa melalui tombol hapus
    echo "ERROR: Tidak bisa akses halaman ini tanpa melalui tombol hapus";
}
