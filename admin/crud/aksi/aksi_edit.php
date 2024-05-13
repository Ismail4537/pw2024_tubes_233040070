<?php
include "../../../assets/shortcut/koneksi.php";
if (isset($_POST['hardware'])) {
    $id = $_POST["id"];
    $nama = $_POST["nama"];
    $kategori = $_POST["kategori"];
    $deskripsi = $_POST["deskripsi"];
    // cek apakah user ingin mengubah gambar
    if (isset($_POST['upt'])) {
        // hapus gambar lama
        $query = mysqli_query($koneksi, "SELECT gambar FROM hardware WHERE id_hardware='$id';");
        $data = mysqli_fetch_array($query);
        $gambar = $data['gambar'];
        if (file_exists("../recource/gambar/" . $gambar)) {
            unlink("../recource/gambar/" . $gambar);
        }
        // tambah gambar baru & edit data
        $temp = $_FILES['gambaru']['tmp_name'];
        $gambaru = rand(0, 9999) . $_FILES['gambaru']['name'];
        $size = $_FILES['gambaru']['size'];
        $type = $_FILES['gambaru']['type'];
        if (($size <= 5000000) and ($type == 'image/jpeg' or $type == 'image/png')) {
            move_uploaded_file($temp, "../recource/gambar/" . $gambaru);
            $query = mysqli_query($koneksi, "UPDATE `hardware` SET `nama` = '$nama', `kategori` = '$kategori', `deskripsi` = '$deskripsi', `gambar` = '$gambaru' WHERE `hardware`.`id_hardware` = $id");
            if ($query) {
                header("location:../../hardware.php#main");
                unset($_POST['hardware']);
                unset($_POST['upt']);
            } else {
                // jika gagal input database atau gambar maka akan diarahkan ke halaman edit.php dengan id yang sama 
                session_start();
                $_SESSION['gagal'] = "Gagal mengedit data";
                header("location:../form/edit_hardware.php?id=$id");
                unset($_POST['hardware']);
                unset($_POST['upt']);
            }
        } else {
            session_start();
            $_SESSION['gagal'] = "Gambar terlalu besar atau format tidak didukung";
            header("location:../form/edit_hardware.php?id=$id");
            unset($_POST['hardware']);
            unset($_POST['upt']);
        }
        // jika user tidak ingin mengubah gambar
    } else {
        $query = mysqli_query($koneksi, "UPDATE `hardware` SET `nama` = '$nama', `kategori` = '$kategori', `deskripsi` = '$deskripsi' WHERE `hardware`.`id_hardware` = $id");
        if ($query) {
            header("location:../../hardware.php#main");
        } else {
            session_start();
            $_SESSION['gagal'] = "Gagal mengedit data";
            header("location:../form/edit_hardware.php?id=$id");
            unset($_POST['hardware']);
        }
    }
} else if (isset($_POST['harga'])) {
    $id = $_POST["id"];
    $id_hardware = $_POST["id_hardware"];
    $avg_price = $_POST["avg_price"];
    $tanggal = $_POST["tanggal"];
    // cek apakah harga rata-rata pasaran sesuai
    if ($avg_price < 0 or $avg_price > 1000000000) {
        header("location:../form/edit_harga.php?id=$id");
        unset($_POST['harga']);
        return;
    }
    $query = mysqli_query($koneksi, "UPDATE `harga` SET `id_hardware` = '$id_hardware', `avg_price` = '$avg_price', `tanggal` = '$tanggal' WHERE `harga`.`id_harga` = $id");
    if ($query) {
        header("location:../../harga.php#main");
        unset($_POST['harga']);
    } else {
        session_start();
        $_SESSION['gagal'] = "Gagal mengedit data";
        header("location:../form/edit_harga.php?id=$id");
        unset($_POST['harga']);
    }
} else {
    echo "ERROR: Tidak bisa akses halaman ini tanpa melalui form edit data";
}
