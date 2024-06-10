<?php
include "../../../assets/function/function.php";
if (isset($_POST['hardware'])) {
    // mengambil data dari form
    $nama = htmlspecialchars($_POST["nama"]);
    if ($_POST['kategori'] != "Kategori") {
        $kategori = $_POST["kategori"];
    } else {
        session_start();
        $_SESSION['gagal'] = "Harap pilih jenis kategori";
        header("location:../form/tambah_hardware.php");
        unset($_POST['hardware']);
    }
    $deskripsi = htmlspecialchars($_POST["deskripsi"]);
    // mengambil data gambar seperti nama, ukuran, dan tipe
    $temp = $_FILES['gambar']['tmp_name'];
    $gambar = rand(0, 9999) . htmlspecialchars($_FILES['gambar']['name']);
    $size = $_FILES['gambar']['size'];
    $type = $_FILES['gambar']['type'];
    // mengecek apakah gambar yang diupload sesuai dengan ketentuan
    // 1000000 = 1MB
    if (($size < 5000000) and ($type == 'image/jpeg' or $type == 'image/png')) {
        // memindahkan gambar ke folder gambar
        move_uploaded_file($temp, "../recource/gambar/" . $gambar);
        // menambahkan data ke database
        $query = query("INSERT INTO hardware (`id_hardware`, `nama`, `kategori`, `deskripsi`, `gambar`) VALUES (NULL, '$nama', '$kategori', '$deskripsi', '$gambar')");
        if ($query) {
            // jika berhasil maka akan diarahkan ke halaman hardware.php
            header("location:../../hardware.php#main");
            unset($_POST['hardware']);
        } else {
            // jika gagal maka akan diarahkan ke halaman tambah.php
            session_start();
            $_SESSION['gagal'] = "Gagal menambahkan data";
            header("location:../form/tambah_hardware.php");
            unset($_POST['hardware']);
        }
    } else {
        // jika gambar tidak sesuai dengan ketentuan maka akan diarahkan ke halaman tambah.php
        session_start();
        $_SESSION['gagal'] = "Gambar terlalu besar atau format tidak didukung";
        header("location:../form/tambah_hardware.php");
        unset($_POST['hardware']);
    }
} elseif (isset($_POST['harga'])) {
    // mengambil data dari form
    if ($_POST["id_hardware"] != "Hardware") {
        $id_hardware = $_POST["id_hardware"];
    } else {
        session_start();
        $_SESSION['gagal'] = "Harap pilih Hardware";
        header("location:../form/tambah_harga.php");
        unset($_POST['harga']);
    }
    $avg_price = $_POST["avg_price"];
    $tanggal = $_POST["tanggal"];
    $link = "tambah_harga.php";
    if (isset($_POST['copy'])) {
        $link = "tambah_harga.php?copy=" . $_POST['copy'] . "";
        unset($_POST['copy']);
    }
    // mengecek apakah harga rata-rata pasaran sesuai
    if ($avg_price < 0 or $avg_price > 1000000000) {
        session_start();
        $_SESSION['gagal'] = "harga rata-rata pasaran tidak sesuai";
        header("location:../form/" . $link . "");
        unset($_POST['harga']);
        return;
    }
    // menambahkan data ke database
    $query = query("INSERT INTO harga (`id_harga`, `id_hardware`, `avg_price`, `tanggal`) VALUES (NULL, '$id_hardware', '$avg_price', '$tanggal')");
    if ($query) {
        // jika berhasil maka akan diarahkan ke halaman harga.php
        header("location:../../index.php#main");
        unset($_POST['harga']);
    } else {
        // jika gagal maka akan diarahkan ke halaman tambah.php
        session_start();
        $_SESSION['gagal'] = "Gagal menambahkan data";
        header("location:../form/" . $link . "");
        unset($_POST['harga']);
    }
} else {
    // jika mencoba mengakses halaman ini tanpa melalui form tambah data
    echo "ERROR: Tidak bisa akses halaman ini tanpa melalui form tambah data";
}
