<?php
include "koneksi.php";
if (isset($_POST['save'])) {
    // mengambil data dari form
    $nama = $_POST["nama"];
    $kategori = $_POST["kategori"];
    $deskripsi = $_POST["deskripsi"];
    $avg_price = $_POST["avg_price"];
    // mengambil data gambar seperti nama, ukuran, dan tipe
    $temp = $_FILES['gambar']['tmp_name'];
    $gambar = rand(0, 9999) . $_FILES['gambar']['name'];
    $size = $_FILES['gambar']['size'];
    $type = $_FILES['gambar']['type'];
    // mengecek apakah gambar yang diupload sesuai dengan ketentuan
    if ($avg_price < 0 or $avg_price > 1000000000) {
        header("location:tambah.php?=harga_rata_rata_pasaran_tidak_sesuai");
        return;
    }
    // 1000000 = 1MB
    if (($size < 5000000) and ($type == 'image/jpeg' or $type == 'image/png')) {
        // memindahkan gambar ke folder gambar
        move_uploaded_file($temp, "gambar/" . $gambar);
        // menambahkan data ke database
        $query = mysqli_query($koneksi, "INSERT INTO hardware (`id`, `nama`, `kategori`, `deskripsi`, `avg_price`, `gambar`) VALUES (NULL, '$nama', '$kategori', '$deskripsi', '$avg_price', '$gambar')");
        if ($query) {
            // jika berhasil maka akan diarahkan ke halaman index.php
            header("location:index.php");
        } else {
            // jika gagal maka akan diarahkan ke halaman tambah.php
            header("location:tambah.php?=gagal_menambahkan_data");
        }
    } else {
        // jika gambar tidak sesuai dengan ketentuan maka akan diarahkan ke halaman tambah.php
        header("location:tambah.php?=gambar_terlalu_besar_atau_format_tidak_didukung");
    }
} else {
    // jika mencoba mengakses halaman ini tanpa melalui form tambah data
    echo "ERROR: Tidak bisa akses halaman ini tanpa melalui form tambah data";
}
