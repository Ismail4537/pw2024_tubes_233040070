<?php
include "../../../assets/function/function.php";
session_start();
// cek siapa yang sedang login
$current = $_SESSION['user'];
$query_current = query("SELECT * FROM user WHERE username='$current'");
$data_current = mysqli_fetch_assoc($query_current);

if (isset($_POST['save'])) {
    $id = $_POST["id"];
    // ambil data user
    $query = query("SELECT * FROM user WHERE id='$id'");
    $data = mysqli_fetch_array($query);
    // ambil password user
    $passwordOri = $data['password'];
    // ambil role user
    $roleOri = $data['role'];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $password2 = $_POST["password2"];
    // cek apakah email valid
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        session_start();
        $_SESSION['gagal'] = "Email tidak valid";
        header("location:../form/edit_profile.php?id=$id");
        return;
    }
    // cek apakah username valid
    // username hanya boleh berisi huruf, spasi dan angka
    if (!preg_match("/^[a-zA-Z0-9 ]*$/", $username)) {
        session_start();
        $_SESSION['gagal'] = "Username tidak valid";
        header("location:../form/edit_profile.php?id=$id");
        return;
    }
    // cek apakah ada $_POST['roleNew']
    if (isset($_POST['r_change'])) {
        // jika ada maka role akan diubah
        $role = $_POST['roleNew'];
    } else {
        // jika tidak ada maka role akan tetap sama
        $role = $roleOri;
    }
    // cek apakah user ingin mengubah password
    if (isset($_POST['ps'])) {
        // cek apakah password valid
        $apakah_valid = cek_password($password, $password2);
        if ($apakah_valid == 1) {
            session_start();
            $_SESSION['gagal'] = "Password tidak valid";
            header("location:../form/edit_profile.php?id=$id");
            return;
        } else if ($apakah_valid == 2) {
            session_start();
            $_SESSION['gagal'] = "Password kurang dari 10 kata";
            header("location:../form/edit_profile.php?id=$id");
            return;
        } elseif ($apakah_valid == 3) {
            session_start();
            $_SESSION['gagal'] = "Password tidak sama";
            header("location:../form/edit_profile.php?id=$id");
            return;
        }
        // enkripsi password
        $password = md5($_POST["password"]);
        $password2 = md5($_POST["password2"]);
    } else {
        // jika user tidak ingin mengubah password
        $password = $passwordOri;
    }
    // cek apakah username, email atau password sudah digunakan
    $query_user = query("SELECT * FROM user WHERE username='$username' OR email='$email'");
    $data_user = mysqli_fetch_assoc($query_user);
    $query_password = query("SELECT password FROM user WHERE password='$password'");
    $data_password = mysqli_fetch_assoc($query_password);
    // cek apakah username atau email lain terdeteksi
    if (isset($data_user['username']) or isset($data_user['email'])) {
        // cek apakah username dan email yang diedit tidak sama dengan username dan email yang di input
        if ($data['username'] != $username) {
            // cek apakah username sudah digunakan
            if ($data_user['username'] == $username) {
                session_start();
                $_SESSION['gagal'] = "Username sudah digunakan";
                header("location:../form/edit_profile.php?id=$id");
                return;
                // jika username adalah username baru maka lanjut ke cek email
            }
        }
        if ($data['email'] != $email) {
            if ($data_user['email'] == $email) {
                session_start();
                $_SESSION['gagal'] = "Email sudah digunakan";
                header("location:../form/edit_profile.php?id=$id");
                return;
            }
        }
    }
    if (isset($data_password['password'])) {
        if ($data['password'] != $password) {
            if ($data_password['password'] == $password) {
                session_start();
                $_SESSION['gagal'] = "Password sudah digunakan";
                header("location:../form/edit_profile.php?id=$id");
                return;
            }
        }
    }
    // return;
    // cek apakah user ingin mengubah atau menambah gambar
    if (isset($_POST['upt'])) {
        // hapus gambar lama
        $query = query("SELECT gambar FROM user WHERE id='$id';");
        $data = mysqli_fetch_array($query);
        $gambar = $data['gambar'];
        cek_gambar($gambar);
        // tambah gambar baru & edit data
        $temp = $_FILES['gambaru']['tmp_name'];
        $gambaru = rand(0, 9999) . $_FILES['gambaru']['name'];
        $size = $_FILES['gambaru']['size'];
        $type = $_FILES['gambaru']['type'];
        if (($size <= 5000000) and ($type == 'image/jpeg' or $type == 'image/png')) {
            move_uploaded_file($temp, "../recource/gambar_profile/" . $gambaru);
            $query = query("UPDATE `user` SET `username` = '$username', `email` = '$email', `password` = '$password', `role` = '$role', `gambar` = '$gambaru' WHERE `user`.`id` = $id");
            if ($query) {
                // jika username pengedit dan username input sama akan diarahkan ke halaman user.php
                if ($data_current['username'] == $username) {
                    session_start();
                    $_SESSION['user'] = $username;
                    header("location:../../user.php");
                } else {
                    // jika username pengedit dan username yang di edit sama akan diarahkan ke halaman user.php
                    if ($data_current['username'] == $data['username']) {
                        session_start();
                        $_SESSION['user'] = $username;
                        header("location:../../user.php");
                    } else {
                        // jika username pengedit dan username yang di edit tidak sama akan diarahkan ke halaman users.php
                        header("location:../../users.php#main");
                    }
                }
            } else {
                // jika gagal input database atau gambar maka akan diarahkan ke halaman edit.php dengan id yang sama 
                session_start();
                $_SESSION['gagal'] = "Gagal mengedit data";
                header("location:../form/edit_profile.php?id=$id");
            }
        } else {
            session_start();
            $_SESSION['gagal'] = "Gambar terlalu besar atau format tidak didukung";
            header("location:../form/edit_profile.php?id=$id");
        }
        // jika user tidak ingin mengubah gambar
    } else {
        $query = query("UPDATE `user` SET `username` = '$username', `email` = '$email', `password` = '$password', `role` = '$role' WHERE `user`.`id` = $id");
        if ($query) {
            if ($data_current['username'] == $username) {
                session_start();
                $_SESSION['user'] = $username;
                header("location:../../user.php");
            } else {
                if ($data_current['username'] == $data['username']) {
                    session_start();
                    $_SESSION['user'] = $username;
                    header("location:../../user.php");
                } else {
                    header("location:../../users.php#main");
                }
            }
        } else {
            session_start();
            $_SESSION['gagal'] = "Gagal mengedit data";
            header("location:../form/edit_profile.php?id=$id");
        }
    }
} else {
    echo "ERROR: Tidak bisa akses halaman ini tanpa melalui form edit data";
}
