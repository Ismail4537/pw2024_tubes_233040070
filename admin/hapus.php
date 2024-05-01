<?php
// mengambil id dari url
include "koneksi.php";
if (isset($_GET['id'])) {
    $id = $_GET["id"];
    // mengambil gambar dari database
    $query = mysqli_query($koneksi, "SELECT gambar FROM user WHERE id='$id';");
    $data = mysqli_fetch_array($query);
    $gambar = $data['gambar'];
    // menghapus gambar dari folder gambar
    unlink("gambar/" . $gambar);
    $query = mysqli_query($koneksi, "DELETE FROM user WHERE id='$id';");
    // jika berhasil maka akan diarahkan ke halaman index.php
    header("location:index.php");
} else {
    // jika mencoba mengakses halaman ini tanpa melalui tombol hapus
    echo "ERROR: Tidak bisa akses halaman ini tanpa melalui tombol hapus";
}
