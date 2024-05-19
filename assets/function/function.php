<?php
function koneksi()
{
    $koneksi = mysqli_connect("localhost", "root", "", "pw2024_tubes_233040070");
    if (mysqli_connect_errno()) {
        echo "koneksi gagal: " . mysqli_connect_errno();
    }
    return $koneksi;
}
function query($input)
{
    $koneksi = koneksi();
    $query = mysqli_query($koneksi, $input);
    return $query;
}
function search_single($table, $sort1, $sort2, $cari1, $cari2)
{
    $koneksi = koneksi();
    $query = query("SELECT * FROM " . $table . " WHERE " . $cari2 . " LIKE '%" . $cari1 . "%' ORDER BY " . $sort1 . " " . $sort2 . "");
    return $query;
}

function cek_gambar($gambar)
{
    if (file_exists("../recource/gambar/" . $gambar)) {
        unlink("../recource/gambar/" . $gambar);
    }
}

function cek_password($password, $password2)
{
    if (!preg_match("/^[a-zA-Z0-9]*$/", $password)) {
        return 1;
    } else if (strlen($password) < 10) {
        return 2;
    } else if ($password != $password2) {
        return 3;
    }
    return 4;
}
