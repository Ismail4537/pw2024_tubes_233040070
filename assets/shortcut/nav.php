<?php
include "koneksi.php";
// session_start();
if ($_SESSION['status'] != "login") {
    $_SESSION['gagal'] = "Anda harus login terlebih dahulu";
    header("location:../index.php");
}
$user = $_SESSION['user'];
$data_user = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$user' or email='$user'");
$tampil_user = mysqli_fetch_array($data_user);
if ($tampil_user['gambar']) {
    $gambar_profile = $tampil_user['gambar'];
} else {
    $gambar_profile = "Profile_picture.png";
}
?>
<nav class="navbar navbar-expand-lg bg-body-tertiary position-fixed bg-dark" data-bs-theme="dark" style="
    color: white;
    width: 100%;
    z-index: 10;
    top: 0;">
    <div class="container-fluid">
        <a class="navbar-brand" href="./">GaleryTek</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 text-center">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#main">Main</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Halaman Admin
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="http://localhost/pw2024_tubes_233040070/admin/index.php">Tabel Harga</a></li>
                        <li><a class="dropdown-item" href="http://localhost/pw2024_tubes_233040070/admin/hardware.php">Tabel Hardware</a></li>
                        <?php
                        if ($tampil_user['role'] == "super admin") {
                            echo
                            "
                    <li>
                            <hr class='dropdown-divider'>
                        </li>
                        <li><a class='dropdown-item' href='http://localhost/pw2024_tubes_233040070/admin/users.php'>Tabel user</a></li>
                    ";
                        }
                        ?>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Halaman Users
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="http://localhost/pw2024_tubes_233040070/index.php">Tabel Harga</a></li>
                        <li><a class="dropdown-item" href="http://localhost/pw2024_tubes_233040070/hardware.php">Tabel Hardware</a></li>
                    </ul>
                </li>
            </ul>
            <div class="d-flex justify-content-evenly">
                <a href="http://localhost/pw2024_tubes_233040070/admin/user.php" class="d-flex btn btn-sm btn-primary justify-content-center me-2">
                    <div class="fs-5 me-2"><?= $tampil_user['username'] ?></div><img class="rounded-circle" src="http://localhost/pw2024_tubes_233040070/admin/crud/recource/gambar_profile/<?= $gambar_profile; ?>" alt="Profile_picture.png" style="height:30px; width: 30px;">
                </a>
                <a href="http://localhost/pw2024_tubes_233040070/admin/crud/aksi/logout.php" class="d-flex btn btn-sm btn-danger justify-content-center" onclick="return confirm('Anda yakin ingin logout ?')">
                    <div class="fs-5">Logout</div><i class="fa-solid fa-right-to-bracket fa-2x ms-2 mt-1"></i>
                </a>
            </div>
        </div>
    </div>
</nav>