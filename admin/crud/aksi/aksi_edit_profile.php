<?php
include "../shortcut/koneksi.php";
session_start();
// cek siapa yang sedang login
$current = $_SESSION['user'];
$query_current = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$current'");
$tampil_current = mysqli_fetch_assoc($query_current);

if (isset($_POST['save'])) {
    $id = $_POST["id"];
    // ambil data user
    $query = mysqli_query($koneksi, "SELECT * FROM user WHERE id='$id'");
    $tampil = mysqli_fetch_array($query);
    // ambil password user
    $passwordOri = $tampil['password'];
    // ambil role user
    $roleOri = $tampil['role'];
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
        // password tidak boleh ada spasi dan hanya boleh berisi huruf dan angka
        if (!preg_match("/^[a-zA-Z0-9]*$/", $password)) {
            session_start();
            $_SESSION['gagal'] = "Password tidak valid";
            header("location:..//edit_profile.php?id=$id");
        }
        // enkripsi password
        $password = md5($_POST["password"]);
        $password2 = md5($_POST["password2"]);
        // cek apakah password lebih dari 10 kata
        if (strlen($_POST["password"]) < 10) {
            // jika password kurang dari 10 kata maka akan diarahkan ke halaman register.php
            session_start();
            $_SESSION['gagal'] = "Password kurang dari 10 kata";
            header("location:../form/edit_profile.php?id=$id");
            return;
            // cek apakah password sama
        } elseif ($password != $password2) {
            // jika password tidak sama maka akan diarahkan ke halaman register.php
            session_start();
            $_SESSION['gagal'] = "Password tidak sama";
            header("location:../form/edit_profile.php?id=$id");
            return;
        }
    } else {
        // jika user tidak ingin mengubah password
        $password = $passwordOri;
    }
    // cek apakah username, email atau password sudah digunakan
    $query_user = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$username' OR email='$email'");
    $tampil_user = mysqli_fetch_assoc($query_user);
    $query_password = mysqli_query($koneksi, "SELECT password FROM user WHERE password='$password'");
    $tampil_password = mysqli_fetch_assoc($query_password);
    // cek apakah username atau email lain terdeteksi
    if (isset($tampil_user['username']) or isset($tampil_user['email'])) {
        // cek apakah username yang terdeteksi adalah username yang sedang diinput
        if ($tampil_user['username'] == $username) {
            // jika username yang terdeteksi adalah username yang sedang diinput maka 
            // akan di cek apakah username yang sedang diinput adalah username yang sedang login
            if ($tampil_current['username'] != $tampil_user['username']) {
                session_start();
                $_SESSION['gagal'] = "Username sudah digunakan";
                header("location:../form/edit_profile.php?id=$id");
                // echo "current user :<br>";
                // echo $tampil_current['username'];
                // echo "<br>other user :<br>";
                // echo $tampil_user['username'];
                // echo "<br>inputted text :<br>";
                // echo $username;
                return;
            }
            // jika username adalah username baru maka lanjut ke cek email
        }
        if ($tampil_user['email'] == $email) {
            if ($tampil_current['email'] != $tampil_user['email']) {
                session_start();
                $_SESSION['gagal'] = "Email sudah digunakan";
                header("location:../form/edit_profile.php?id=$id");
                // echo "current user :<br>";
                // echo $tampil_current['email'];
                // echo "<br>other user :<br>";
                // echo $tampil_user['email'];
                // echo "<br>inputted text :<br>";
                // echo $email;
                return;
            }
        }
    }
    if (isset($tampil_password['password'])) {
        if ($tampil_password['password'] == $password) {
            if ($tampil_current['password'] != $tampil_password['password']) {
                session_start();
                $_SESSION['gagal'] = "Password sudah digunakan";
                header("location:../form/edit_profile.php?id=$id");
                // echo "current user :<br>";
                // echo $tampil_current['password'];
                // echo "<br>other user :<br>";
                // echo $tampil_password['password'];
                // echo "<br>inputted text :<br>";
                // echo $password;
                return;
            }
        }
    }
    // return;
    // cek apakah user ingin mengubah atau menambah gambar
    if (isset($_POST['upt'])) {
        // hapus gambar lama
        $query = mysqli_query($koneksi, "SELECT gambar FROM user WHERE id='$id';");
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
                // jika username pengedit dan username input sama akan diarahkan ke halaman user.php
                if ($tampil_current['username'] == $username) {
                    session_start();
                    $_SESSION['user'] = $username;
                    header("location:../user.php");
                } else {
                    // jika username pengedit dan username yang di edit sama akan diarahkan ke halaman user.php
                    if ($tampil_current['username'] == $tampil['username']) {
                        session_start();
                        $_SESSION['user'] = $username;
                        header("location:../user.php");
                    } else {
                        // jika username pengedit dan username yang di edit tidak sama akan diarahkan ke halaman users.php
                        header("location:../users.php#main");
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
        $query = mysqli_query($koneksi, "UPDATE `user` SET `username` = '$username', `email` = '$email', `password` = '$password', `role` = '$role' WHERE `user`.`id` = $id");
        if ($query) {
            if ($tampil_current['username'] == $username) {
                session_start();
                $_SESSION['user'] = $username;
                header("location:../user.php");
            } else {
                if ($tampil_current['username'] == $tampil['username']) {
                    session_start();
                    $_SESSION['user'] = $username;
                    header("location:../user.php");
                } else {
                    header("location:../users.php#main");
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
