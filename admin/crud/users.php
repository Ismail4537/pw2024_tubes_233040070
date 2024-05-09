<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="style/gambar/Tek.png">
    <link rel="stylesheet" href="style/base.css">
    <link rel="stylesheet" href="style/bootstrap.min.css">
    <link rel="stylesheet" href="style/index.css">
    <title>GaleryTek | Data User</title>
    <style>
        /* * {
            border: 1px solid red;
        } */
    </style>
</head>

<body>
    <?php
    // mengambil konfigurasi koneksi
    include "shortcut/nav.php";
    if ($_SESSION['status'] != "login") {
        header("location:../index.php?=belum_login");
    }
    if ($tampil_user['role'] == "user") {
        header("location:index.php?=anda_bukan_admin");
    }
    ?>
    <header class="d-flex align-content-center justify-content-center flex-column text-center" style="height: 100vh; color: black;">
        <h4><img src="style/gambar/Tek.png" alt="Tek" width="100px"></h4>
        <h1>GaleryTek | Data Users</h1>
        <br>
        <p>GaleryTek adalah sebuah galery teknologi dimana berfungsi sebagai platform untuk menampilkan berbagai jenis Hardware komputer dalam bentuk gambar dengan deskripsinya</p>
    </header>
    <marquee behavior="" direction="left" class="bg-dark text-white">
        Selamat datang,
        <b class="text-capitalize">
            <?= $tampil_user['role']; ?>
        </b>
        <?= $tampil_user['username']; ?>
    </marquee>
    <section class="main d-flex flex-column p-1" id="main">
        <div class="data m-auto my-1">
            <div class="ultility d-flex justify-content-between flex-row-reverse m-3">
                <form action="" method="get" class="input-group">
                    <input type="text" name="cari" placeholder="Cari data" class="input-group-text">
                    <input type="submit" value="Cari" name="search" class="btn btn-secondary">
                </form>
            </div>
            <table class="text-center table table-bordered table-hover table-responsive table-sm ">
                <thead class="table-success">
                    <tr>
                        <th class="align-content-center" width="2%">#</th>
                        <th class="align-content-center" width="10%">Foto Profile</th>
                        <th class="align-content-center" width="20%">Username</th>
                        <th class="align-content-center">Email</th>
                        <th class='align-content-center' width='10%'>Action</th>

                    </tr>
                </thead>
                <tfoot class="table-success">
                    <tr>
                        <th class="align-content-center">#</th>
                        <th class="align-content-center">Foto Profile</th>
                        <th class="align-content-center">Username</th>
                        <th class="align-content-center">Email</th>
                        <th class='align-content-center'>Action</th>
                    </tr>
                </tfoot>
                <?php
                // mengecek apakah ada data yang dicari
                if (isset($_GET['search'])) {
                    $cari = $_GET['cari'];
                    $data = mysqli_query($koneksi, "SELECT * FROM user WHERE username LIKE '%" . $cari . "%' or email LIKE '%" . $cari . "%'");
                } else {
                    // jika tidak ada data yang dicari
                    $data = mysqli_query($koneksi, "SELECT * FROM user");
                }
                // inisialisasi variabel no untuk urutan data
                $no = 1;
                // menampilkan data dari database
                while ($tampil = mysqli_fetch_array($data)) {
                    if ($tampil['gambar']) {
                        $gambar = $tampil['gambar'];
                    } else {
                        $gambar = "Profile_picture.png";
                    }
                ?>
                    <tr>
                        <th class="align-content-center" scope="row"><?= $no++; ?></th>
                        <td class="align-content-center">
                            <img class="rounded-circle" src="gambar_profile/<?= $gambar ?>" alt="<?= $gambar ?>">
                        </td>
                        <td class="align-content-center"><a href="user.php?id=<?= $tampil['id'] ?>"><?= $tampil['username']; ?></a><br><b><?= $tampil['role']; ?></b></td>
                        <td class="align-content-center"><?= $tampil['email']; ?></td>
                        <td class='align-content-center'>
                            <div class='action d-flex flex-column'>
                                <?php
                                if ($tampil_user['role'] == "super admin") {
                                    if ($tampil['role'] != "super admin" or $tampil['username'] == $tampil_user['username']) {
                                        echo
                                        "
                                        <a href='form/edit_profile.php?id=" . $tampil['id'] . "' class='btn btn-success mb-1'>Edit</a>
                                        ";
                                    }
                                }
                                ?>
                                <a href="aksi/hapus_profile.php?id=<?= $tampil['id'] ?>" class='btn btn-danger' onclick='return confirm(`Anda yakin mau menghapus item ini ?`)'>Hapus</a>
                            </div>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </table>
        </div>
    </section>
    <?php
    include "shortcut/link.php";
    ?>
</body>

</html>