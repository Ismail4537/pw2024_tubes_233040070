<?php
include "../assets/function/function.php";
if (isset($_POST["save"])) {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $password2 = $_POST["password2"];
    // cek apakah email valid
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        session_start();
        $_SESSION['gagal'] = "Email tidak valid";
        header("location:../register.php");
        return;
    }
    // cek apakah username valid
    if (!preg_match("/^[a-zA-Z0-9 ]*$/", $username)) {
        session_start();
        $_SESSION['gagal'] = "Username tidak valid<br>hanya boleh menggunakan huruf dan angka";
        header("location:../register.php");
        return;
    }
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

    $query_user = query("SELECT * FROM user WHERE username='$username' OR email='$email'");
    $tampil_user = mysqli_fetch_assoc($query_user);
    $query_password = query("SELECT password FROM user WHERE password='$password'");
    $tampil_password = mysqli_fetch_assoc($query_password);

    if ($tampil_user['username'] == $username || $tampil_user['email'] == $email) {
        session_start();
        $_SESSION['gagal'] = "Username atau email sudah di gunakan";
        header("location:../register.php?=username_atau_email_sudah_digunakan");
        return;
    } elseif ($tampil_password['password'] == $password) {
        session_start();
        $_SESSION['gagal'] = "Password sudah digunakan";
        header("location:../register.php?=password_sudah_digunakan");
        return;
    }

    $query = query("INSERT INTO `user` (`id`, `username`, `email`, `password`, `role`, `gambar`) VALUES (NULL, '$username', '$email', '$password', 'admin', '');");
    if ($query) {
        session_start();
        $_SESSION['berhasil'] = "Silahkan login";
        header("location:../login.php");
    } else {
        // jika gagal maka akan diarahkan ke halaman tambah.php
        session_start();
        $_SESSION['gagal'] = "gagal register";
        header("location:../register.php");
    }
} else {
    echo "ERROR: Tidak bisa akses halaman ini tanpa melalui form tambah data";
}
