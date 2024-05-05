<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="style/gambar/Tek.png">
    <link rel="stylesheet" href="style/base.css">
    <link rel="stylesheet" href="style/bootstrap.min.css">
    <link rel="stylesheet" href="style/fontawesome-free/css/all.css">
    <link rel="stylesheet" href="style/index.css">
    <title>GaleryTek</title>
</head>

<body>
    <?php
    include "nav.php";
    ?>
    <header class="border-bottom border-black border-5 d-flex align-content-center justify-content-center flex-column text-center" style="height: 100vh; color: black;">
        <h4><img src="style/gambar/Tek.png" alt="Tek" width="100px"></h4>
        <h1>GaleryTek</h1>
        <br>
        <p>GaleryTek adalah sebuah galery teknologi dimana berfungsi sebagai platform untuk menampilkan berbagai jenis Hardware komputer dalam bentuk gambar dengan deskripsinya</p>
    </header>
    <div class="main d-flex flex-column p-1">
        <div class="data m-auto my-1">
            <div class="ultility d-flex justify-content-between flex-row-reverse m-3">
                <a href="tambah.php" class="text-decoration-none"><button class="btn btn-primary">Tambah</button></a>
                <form action="" method="get" class="input-group">
                    <input type="text" name="cari" placeholder="Cari data" class="input-group-text">
                    <input type="submit" value="Cari" name="cari" class="btn btn-secondary">
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
                // mengambil konfigurasi koneksi
                include 'koneksi.php';
                if (isset($_GET['cari'])) {
                    $cari = $_GET['cari'];
                    $data = mysqli_query($koneksi, "SELECT * FROM hardware WHERE nama LIKE '%" . $cari . "%'");
                } else {
                    $data = mysqli_query($koneksi, "SELECT * FROM hardware");
                }
                // inisialisasi variabel no untuk urutan data
                $no = 1;
                // menampilkan data dari database
                while ($tampil = mysqli_fetch_array($data)) {
                ?>
                    <tr>
                        <td class="align-content-center"><?php echo $no++; ?></td>
                        <td class="align-content-center">
                            <img src="gambar/<?php echo $tampil['gambar'] ?>" alt="<?php echo $tampil['gambar'] ?>">
                        </td>
                        <td class="align-content-center"><?php echo $tampil['nama']; ?></td>
                        <td class="align-content-center"><?php echo $tampil['kategori']; ?></td>
                        <td class="align-content-center"><?php echo $tampil['deskripsi']; ?></td>
                        <td class="align-content-center">
                            <p class="mx-2">Rp,<?php echo number_format($tampil['avg_price'], 0, '', '.'); ?>,00</p>
                        </td>
                        <td class="align-content-center">
                            <div class="action d-flex flex-column">
                                <a href="edit.php?id=<?php echo $tampil['id']; ?>" class="btn btn-success mb-1">Edit</a>
                                <a href="hapus.php?id=<?php echo $tampil['id']; ?>" class="btn btn-danger" onclick="return confirm('Anda yakin mau menghapus item ini ?')">Hapus</a>
                            </div>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </table>
        </div>
    </div>
    <?php
    include "link.php";
    ?>
</body>

</html>