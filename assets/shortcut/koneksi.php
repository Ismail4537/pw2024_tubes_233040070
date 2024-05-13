<?php
// koneksi ke database
$koneksi = mysqli_connect("localhost", "root", "", "pw2024_tubes_233040070");
if (mysqli_connect_errno()) {
    echo "koneksi gagal: " . mysqli_connect_errno();
}
