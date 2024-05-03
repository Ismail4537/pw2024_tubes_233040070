<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/base.css">
    <link rel="stylesheet" href="style/form.css">
    <link rel="stylesheet" href="style/nav.css">
    <link rel="stylesheet" href="style/bootstrap.min.css">
    <title>GaleryTek | Form Edit</title>
</head>

<body>
    <nav class="navbar bg-dark border-bottom border-body position-fixed" data-bs-theme="dark">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1">Navbar</span>
        </div>
    </nav>
    <?php
    $id = $_GET["id"];
    include "koneksi.php";
    $query = mysqli_query($koneksi, "SELECT * FROM hardware WHERE id='$id'");
    while ($tampil = mysqli_fetch_array($query)) {
    ?>
        <div class="main">
            <form action="aksi_edit.php" method="post" enctype="multipart/form-data" class="d-flex flex-column border rounded text-center">
                <h2 class="rounded-top text-white p-1">Form Tambah Data</h2>
                <input type="text" name="id" id="" value="<?php echo $tampil["id"]; ?>" hidden readonly>
                <div class="container d-flex">
                    <div class="border d-inline-flex flex-column text-center p-2">
                        <h4>Gambar lama</h4>
                        <img class="mx-auto mb-2 mt-0" src="gambar/<?php echo $tampil['gambar'] ?>" alt="">
                    </div>
                    <div class="mainForm border">
                        <table class="table table-responsive table-sm">
                            </tr>
                            <tr>
                                <td class="input-group">
                                    <span class="input-group-text" id="addon-wrapping">Nama</span>
                                    <input name="nama" value="<?php echo $tampil['nama']; ?>" type="text" class="form-control" placeholder="Nama" aria-label="Nama" aria-describedby="addon-wrapping">
                                </td>
                            </tr>
                            <tr>
                                <td class="input-group">
                                    <span class="input-group-text" id="addon-wrapping">Deskripsi</span>
                                    <input name="deskripsi" value="<?php echo $tampil['deskripsi']; ?>" type="text" class="form-control" placeholder="Deskripsi" aria-label="Deskripsi" aria-describedby="addon-wrapping">
                                </td>
                            </tr>
                            <tr>
                                <td class="input-group flex-nowrap">
                                    <span class="input-group-text" id="addon-wrapping">Harga rata-rata pasaran(IDR)</span>
                                    <input name="avg_price" value="<?php echo $tampil['avg_price']; ?>" type="text" class="form-control" placeholder="Harga rata-rata pasaran(IDR)" aria-label="Harga rata-rata pasaran(IDR)" aria-describedby="addon-wrapping">
                                </td>
                            </tr>
                            <tr>
                                <td class="input-group">
                                    <label class="input-group-text" for="gambar">Gambar Baru</label>
                                    <input name="gambar" type="file" class="form-control" id="gambar">
                                    <div class="input-group-text">
                                        <input class="form-check-input" type="checkbox" name="upt" value="true">
                                    </div>
                                </td>
                            </tr>
                        </table>
                        <input type="submit" value="Tambah" name="save" class="btn btn-primary mx-5 mb-3 rounded-pill">
                    </div>
                </div>
            </form>
        </div>
        <p class="text-center bg-black text-bg-dark mb-0 mt-5">&copy; 2024 - GaleryTek</p>
    <?php } ?>
    <script src="script/bootstrap.min.js"></script>
</body>

</html>