<?php
include "koneksi.php";
if (isset($_POST['save'])) {
    $id = $_POST["id"];
    $nama = $_POST["nama"];
    $deskripsi = $_POST["deskripsi"];
    $avg_price = $_POST["avg_price"];
    // cek apakah user ingin mengubah gambar
    if (isset($_POST['upt'])) {
        // hapus gambar lama
        $query = mysqli_query($koneksi, "SELECT gambar FROM hardware WHERE id='$id';");
        $data = mysqli_fetch_array($query);
        $gambar = $data['gambar'];
        unlink("gambar/" . $gambar);
        // tambah gambar baru & edit data
        $temp = $_FILES['gambar']['tmp_name'];
        $gambaru = rand(0, 9999) . $_FILES['gambar']['name'];
        $size = $_FILES['gambar']['size'];
        $type = $_FILES['gambar']['type'];
        if (($size <= 5000000) and ($type == 'image/jpeg' or $type == 'image/png')) {
            move_uploaded_file($temp, "gambar/" . $gambaru);
            $query = mysqli_query($koneksi, "UPDATE `hardware` SET `nama` = '$nama', `deskripsi` = '$deskripsi', `avg_price` = '$avg_price', `gambar` = '$gambaru' WHERE `hardware`.`id` = $id");
            if ($query) {
                header("location:index.php");
            } else {
                // jika gagal input database atau gambar maka akan diarahkan ke halaman edit.php dengan id yang sama 
                header("location:edit.php?id=$id");
            }
        } else {
            header("location:edit.php?id=$id");
        }
        // jika user tidak ingin mengubah gambar
    } else {
        $query = mysqli_query($koneksi, "UPDATE `hardware` SET `nama` = '$nama', `deskripsi` = '$deskripsi', `avg_price` = '$avg_price' WHERE `hardware`.`id` = $id");
        if ($query) {
            header("location:index.php");
        } else {
            header("location:edit.php?id=$id");
        }
    }
} else {
    echo "ERROR: Tidak bisa akses halaman ini tanpa melalui form edit data";
}
