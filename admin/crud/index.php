<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="style/gambar/Tek.png">
    <link rel="stylesheet" href="style/base.css">
    <link rel="stylesheet" href="style/bootstrap.min.css">
    <link rel="stylesheet" href="style/index.css">
    <title>GaleryTek</title>
    <style>
        /* * {
            border: 1px solid red;
        } */
    </style>
</head>

<body>
    <?php
    // mengambil konfigurasi koneksi
    include 'shortcut/koneksi.php';
    include "shortcut/nav.php";
    session_start();
    if ($_SESSION['status'] != "login") {
        header("location:../index.php?=belum_login");
    }
    $user = $_SESSION['user'];
    $data_user = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$user' or email='$user'");
    $tampil_user = mysqli_fetch_array($data_user);
    ?>
    <header class="d-flex align-content-center justify-content-center flex-column text-center" style="height: 100vh; color: black;">
        <h4><img src="style/gambar/Tek.png" alt="Tek" width="100px"></h4>
        <h1>GaleryTek</h1>
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
                <a href="tambah.php" class="text-decoration-none btn btn-primary my-auto">Tambah</a>
                <form action="" method="get" class="input-group">
                    <input type="text" name="cari" placeholder="Cari data" class="input-group-text">
                    <input type="submit" value="Cari" name="search" class="btn btn-secondary">
                </form>
            </div>
            <table class="text-center table table-bordered table-hover table-responsive table-sm ">
                <thead class="table-success">
                    <tr>
                        <th class="align-content-center" width="2%">#</th>
                        <th class="align-content-center" width="20%">Gambar</th>
                        <th class="align-content-center" width="10%">Nama</th>
                        <th class="align-content-center" width="10%">Kategori</th>
                        <th class="align-content-center">Deskripsi</th>
                        <th class="align-content-center" width="15%">Harga rata-rata pasaran(IDR)</th>
                        <th class="align-content-center" width="10%">Action</th>
                    </tr>
                </thead>
                <tfoot class="table-success">
                    <tr>
                        <th class="align-content-center">#</th>
                        <th class="align-content-center">Gambar</th>
                        <th class="align-content-center">Nama</th>
                        <th class="align-content-center">Kategori</th>
                        <th class="align-content-center">Deskripsi</th>
                        <th class="align-content-center">Harga rata-rata pasaran(IDR)</th>
                        <th class="align-content-center">Aksi</th>
                    </tr>
                </tfoot>
                <?php
                // mengecek apakah ada data yang dicari
                if (isset($_GET['search'])) {
                    $cari = $_GET['cari'];
                    $data = mysqli_query($koneksi, "SELECT * FROM hardware WHERE nama LIKE '%" . $cari . "%'");
                } else {
                    // jika tidak ada data yang dicari
                    $data = mysqli_query($koneksi, "SELECT * FROM hardware");
                }
                // inisialisasi variabel no untuk urutan data
                $no = 1;
                // menampilkan data dari database
                while ($tampil = mysqli_fetch_array($data)) {
                ?>
                    <tr>
                        <th class="align-content-center" scope="row"><?= $no++; ?></th>
                        <td class="align-content-center">
                            <img src="gambar/<?= $tampil['gambar'] ?>" alt="<?= $tampil['gambar'] ?>">
                        </td>
                        <td class="align-content-center"><?= $tampil['nama']; ?></td>
                        <td class="align-content-center"><?= $tampil['kategori']; ?></td>
                        <td class="align-content-center"><?= $tampil['deskripsi']; ?></td>
                        <td class="align-content-center">
                            <p class="mx-2">Rp,<?= number_format($tampil['avg_price'], 0, '', '.'); ?>,00</p>
                        </td>
                        <td class="align-content-center">
                            <div class="action d-flex flex-column">
                                <a href="edit.php?id=<?= $tampil['id']; ?>" class="btn btn-success mb-1">Edit</a>
                                <a href="aksi/hapus.php?id=<?= $tampil['id']; ?>" class="btn btn-danger" onclick="return confirm('Anda yakin mau menghapus item ini ?')">Hapus</a>
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