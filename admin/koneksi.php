<?php
// koneksi ke database
$koneksi = mysqli_connect("localhost", "root", "", "db");
if (mysqli_connect_errno()) {
    echo "koneksi gagal: " . mysqli_connect_errno();
}
