<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/base.css">
    <link rel="stylesheet" href="style/index.css">
    <link rel="stylesheet" href="style/nav.css">
    <link rel="stylesheet" href="style/bootstrap.min.css">
    <title>GaleryTek</title>
</head>

<body>
    <nav class="navbar bg-dark border-bottom border-body position-fixed" data-bs-theme="dark">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1">Navbar</span>
        </div>
    </nav>
    <header class="mt-5 border-bottom border-black border-5 d-flex align-content-center justify-content-center flex-column text-center">
        <h1>GaleryTek</h1>
        <br>
        <p>GaleryTek adalah sebuah galery teknologi dimana berfungsi sebagai platform untuk menampilkan berbagai jenis Hardware komputer dalam bentuk gambar dengan deskripsinya</p>
    </header>
    <div class="main d-flex flex-column p-1">
        <div class="data m-auto my-1">
            <div class="ultility d-flex justify-content-between flex-row-reverse m-3">
                <a href="tambah.php" class="text-decoration-none"><button class="btn btn-primary">Tambah</button></a>
                <form action="" method="get" class="input-group">
                    <input type="text" name="cari" id="" placeholder="Cari data" class="input-group-text">
                    <input type="submit" value="Cari" name="search" class="btn btn-secondary">
                </form>
            </div>
            <table class="text-center table table-bordered table-hover table-responsive table-sm">
                <thead class="table-success">
                    <tr>
                        <th class="align-content-center" width="2%">#</th>
                        <th class="align-content-center" width="15%">Gambar</th>
                        <th class="align-content-center" width="20%">Nama</th>
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
                        <th class="align-content-center">Deskripsi</th>
                        <th class="align-content-center">Harga rata-rata pasaran(IDR)</th>
                        <th class="align-content-center">Aksi</th>
                    </tr>
                </tfoot>
                <?php
                // mengambil konfigurasi koneksi
                include 'koneksi.php';
                if (isset($_GET['search'])) {
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
                            <img src="gambar/<?php echo $tampil['gambar'] ?>" alt="">
                        </td>
                        <td class="align-content-center"><?php echo $tampil['nama']; ?></td>
                        <td class="align-content-center"><?php echo $tampil['deskripsi']; ?></td>
                        <td class="align-content-center"><?php echo $tampil['avg_price']; ?></td>
                        <td class="align-content-center">
                            <div class="action d-flex flex-column">
                                <a href="edit.php?id=<?php echo $tampil['id']; ?>"><button class="btn btn-success mb-1">Edit</button></a>
                                <a href="hapus.php?id=<?php echo $tampil['id']; ?>" onclick="return confirm('Anda yakin mau menghapus item ini ?')"><button class="btn btn-danger">Hapus</button></a>
                            </div>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </table>
        </div>
    </div>
    <p class="text-center bg-black text-bg-dark mb-0 mt-5">&copy; 2024 - GaleryTek</p>
    <script src="script/bootstrap.min.js"></script>
</body>

</html>