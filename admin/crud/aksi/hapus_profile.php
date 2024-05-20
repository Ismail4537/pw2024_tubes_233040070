<?php
include "../../../assets/function/function.php";
session_start();
// cek siapa yang sedang login
$current = $_SESSION['user'];
$query_current = query("SELECT * FROM user WHERE username='$current'");
$data_current = mysqli_fetch_array($query_current);
if ($_SESSION['status'] != "login") {
    header("location:../../../index.php?=belum_login");
}

// mengambil id dari url
if (isset($_GET['id'])) {
    $id = $_GET["id"];
    // mengambil data user yang di hapus
    $query_user = query("SELECT * FROM user WHERE `id`='$id';");
    $data_user = mysqli_fetch_array($query_user);
    if ($data_current['role'] == "admin") {
        if ($data_current['username'] != $data_user['username']) {
            // jika bukan super admin maka akan diarahkan ke halaman index.php
            header("location:../../index.php?=anda_bukan_super_admin");
            return;
        }
    }
    // mengambil gambar dari database
    $query = query("SELECT gambar FROM user WHERE `id`='$id';");
    $cek = mysqli_num_rows($query);
    $data = mysqli_fetch_array($query);
    $gambar = $data['gambar'];
    // menghapus gambar dari folder gambar_profile
    cek_gambar($gambar, "gambar_profile");
    $query = query("DELETE FROM user WHERE `id`='$id';");
    // cek apakah user yang dihapus adalah user yang sedang login
    if ($data_user['username'] == $data_current['username']) {
        // jika user yang dihapus adalah user yang sedang login maka akan diarahkan ke halaman login
        session_start();
        session_destroy();
        header("location:../../../index.php");
    } else {
        // jika user yang dihapus bukan user yang sedang login maka akan diarahkan ke halaman users.php
        header("location:../../users.php#main");
    }
} else {
    // jika mencoba mengakses halaman ini tanpa melalui tombol hapus
    echo "ERROR: Tidak bisa akses halaman ini tanpa melalui tombol hapus";
}
