<?php
include "../shortcut/koneksi.php";
// mengambil id dari url
if (isset($_GET['id'])) {
    $id = $_GET["id"];
    // mengambil gambar dari database
    $query = mysqli_query($koneksi, "SELECT gambar FROM user WHERE `id`='$id';");
    $cek = mysqli_num_rows($query);
    $data = mysqli_fetch_array($query);
    $gambar = $data['gambar'];
    // menghapus gambar dari folder gambar_profile
    unlink("../gambar_profile/" . $gambar);
    $query = mysqli_query($koneksi, "DELETE FROM user WHERE `id`='$id';");
    // jika berhasil maka akan diarahkan ke halaman index.php
    session_start();
    session_destroy();
    header("location:../../index.php");
} else {
    // jika mencoba mengakses halaman ini tanpa melalui tombol hapus
    echo "ERROR: Tidak bisa akses halaman ini tanpa melalui tombol hapus";
}
