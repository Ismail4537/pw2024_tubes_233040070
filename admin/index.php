<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/base.css">
    <link rel="stylesheet" href="style/index.css">
    <title>GaleryTek</title>
</head>

<body>
    <header>
        <h1>GaleryTek</h1>
        <br>
        <p>GaleryTek adalah sebuah galery teknologi dimana berfungsi sebagai platform untuk menampilkan berbagai jenis Hardware komputer dalam bentuk gambar dengan deskripsinya</p>
    </header>
    <div>
        <br>
        <form action="" method="get">
            <input type="text" name="cari" id="" placeholder="Cari data">
            <input type="submit" value="Cari" name="search">
        </form>
        <a href="tambah.php"><button>Tambah</button></a>
        <table>
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <!-- <th width="10%">id</th> -->
                    <th width="20%">Nama</th>
                    <th width="40%">Alamat</th>
                    <th>Gambar</th>
                    <th width="10%">Action</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>No</th>
                    <!-- <th>id</th> -->
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
            </tfoot>
            <?php
            // mengambil konfigurasi koneksi
            include 'koneksi.php';
            if (isset($_GET['search'])) {
                $cari = $_GET['cari'];
                $data = mysqli_query($koneksi, "SELECT * FROM user WHERE nama LIKE '%" . $cari . "%' OR alamat LIKE '%" . $cari . "%'");
            } else {
                $data = mysqli_query($koneksi, "SELECT * FROM user");
            }
            // inisialisasi variabel no untuk urutan data
            $no = 1;
            // menampilkan data dari database
            while ($tampil = mysqli_fetch_array($data)) {
            ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <!-- <td><?php echo $tampil['id']; ?></td> -->
                    <td><?php echo $tampil['nama']; ?></td>
                    <td><?php echo $tampil['alamat']; ?></td>
                    <td>
                        <img src="gambar/<?php echo $tampil['gambar'] ?>" alt="">
                    </td>
                    <td>
                        <a href="edit.php?id=<?php echo $tampil['id']; ?>">Edit</a>
                        <a href="hapus.php?id=<?php echo $tampil['id']; ?>" onclick="return confirm('Anda yakin mau menghapus item ini ?')">Hapus</a>
                    </td>
                </tr>
            <?php
            }
            ?>
        </table>
    </div>
    <footer>
        <p>&copy; 2021 - GaleryTek</p>
    </footer>
</body>

</html>