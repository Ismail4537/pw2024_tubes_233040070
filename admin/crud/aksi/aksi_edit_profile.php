<?php
include "../shortcut/koneksi.php";
if (isset($_POST['save'])) {
    $id = $_POST["id"];
    $query = mysqli_query($koneksi, "SELECT * FROM user WHERE id='$id'");
    $data = mysqli_fetch_array($query);
    $passwordOri = $data['password'];

    $username = $_POST["username"];
    $email = $_POST["email"];
    $role = $_POST["role"];
    $password = md5($_POST["password"]);
    $password2 = md5($_POST["password2"]);
    // cek apakah user ingin mengubah password
    if (isset($_POST['ps'])) {
        // cek apakah password sama
        if ($password != $password2) {
            $_SESSION['gagal'] = "Password tidak sama";
            header("location:../edit_profile.php?id=$id");
            return;
        }
    } else {
        // jika user tidak ingin mengubah password
        $password = $passwordOri;
    }
    // cek apakah user ingin mengubah atau menambah gambar
    if (isset($_POST['upt'])) {
        // hapus gambar lama
        $query = mysqli_query($koneksi, "SELECT gambar FROM hardware WHERE id='$id';");
        $data = mysqli_fetch_array($query);
        $gambar = $data['gambar'];
        unlink("../gambar_profile/" . $gambar);
        // tambah gambar baru & edit data
        $temp = $_FILES['gambaru']['tmp_name'];
        $gambaru = rand(0, 9999) . $_FILES['gambaru']['name'];
        $size = $_FILES['gambaru']['size'];
        $type = $_FILES['gambaru']['type'];
        if (($size <= 5000000) and ($type == 'image/jpeg' or $type == 'image/png')) {
            move_uploaded_file($temp, "../gambar_profile/" . $gambaru);
            $query = mysqli_query($koneksi, "UPDATE `user` SET `username` = '$username', `email` = '$email', `password` = '$password', `role` = '$role', `gambar` = '$gambaru' WHERE `user`.`id` = $id");
            if ($query) {
                session_start();
                $_SESSION['user'] = $username;
                header("location:../user.php");
            } else {
                // jika gagal input database atau gambar maka akan diarahkan ke halaman edit.php dengan id yang sama 
                session_start();
                $_SESSION['gagal'] = "Gagal mengedit data";
                header("location:../edit_profile.php?id=$id");
            }
        } else {
            session_start();
            $_SESSION['gagal'] = "Gambar terlalu besar atau format tidak didukung";
            header("location:../edit_profile.php?id=$id");
        }
        // jika user tidak ingin mengubah gambar
    } else {
        $query = mysqli_query($koneksi, "UPDATE `user` SET `username` = '$username', `email` = '$email', `password` = '$password', `role` = '$role' WHERE `user`.`id` = $id");
        if ($query) {
            session_start();
            $_SESSION['user'] = $username;
            header("location:../user.php");
        } else {
            session_start();
            $_SESSION['gagal'] = "Gagal mengedit data";
            header("location:../edit_profile.php?id=$id");
        }
    }
} else {
    echo "ERROR: Tidak bisa akses halaman ini tanpa melalui form edit data";
}
