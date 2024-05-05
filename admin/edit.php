<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="style/gambar/Tek.png">
    <link rel="stylesheet" href="style/base.css">
    <link rel="stylesheet" href="style/form.css">
    <link rel="stylesheet" href="style/fontawesome-free/css/all.css">
    <link rel="stylesheet" href="style/bootstrap.min.css">
    <title>GaleryTek | Form Edit</title>
</head>

<body>
    <?php
    include "nav.php";
    ?>
    <?php
    $id = $_GET["id"];
    include "koneksi.php";
    $query = mysqli_query($koneksi, "SELECT * FROM hardware WHERE id='$id'");
    while ($tampil = mysqli_fetch_array($query)) {
    ?>
        <section class="main">
            <form action="aksi_edit.php" method="post" enctype="multipart/form-data" class="d-flex flex-column border rounded text-center mx-5">
                <h2 class="title rounded-top text-white p-1">Form Edit Data</h2>
                <input type="text" name="id" id="" value="<?php echo $tampil["id"]; ?>" hidden readonly>
                <div class="aha d-flex m-2" style="width:auto;">
                    <div class="border d-inline-flex flex-column text-center p-2 justify-content-center">
                        <h4>Gambar lama</h4>
                        <img class="mx-auto mb-2 mt-0" src="gambar/<?php echo $tampil['gambar'] ?>" alt="<?php echo $tampil['gambar'] ?>">
                        <p>Kategori : <?php echo $tampil['kategori']; ?>
                        </p>
                    </div>
                    <div class="text-start ms-2" style="width:100%;">
                        <span>Nama</span>
                        <div class="mb-2">
                            <input name="nama" value="<?php echo $tampil['nama']; ?>" type="text" class="form-control" placeholder="Nama" aria-label="Nama" aria-describedby="addon-wrapping">
                        </div>
                        <div class="mb-2">
                            <select name="kategori" class="form-select" aria-label="Default select example">
                                <option selected value="<?php echo $tampil["kategori"]; ?>">Kategori</option>
                                <option value="ram">RAM</option>
                                <option value="vga">VGA</option>
                                <option value="power suply">Power Suply</option>
                                <option value="hdd">HDD</option>
                                <option value="ssd">SSD</option>
                                <option value="mouse">Mouse</option>
                                <option value="monitor">Monitor</option>
                                <option value="keyboard">Keyboard</option>
                                <option value="motherboard">Motherboard</option>
                            </select>
                        </div>
                        <div class="form-floating mb-2">
                            <textarea name="deskripsi" class="form-control" placeholder="Masukan Deskripsi" id="floatingTextarea"><?php echo $tampil['deskripsi']; ?></textarea>
                            <label for="floatingTextarea">Deskripsi</label>
                        </div>
                        <span>Harga rata-rata(IDR)</span>
                        <div class="mb-2">
                            <input name="avg_price" value="<?php echo $tampil['avg_price']; ?>" type="number" class="form-control" placeholder="Harga rata-rata pasaran(IDR)" aria-describedby="addon-wrapping">
                        </div>
                        <label>Gambar Baru</label>
                        <div class="input-group mb-2">
                            <input name="gambar" type="file" class="form-control" id="gambar">
                            <div class="input-group-text">
                                <input class="form-check-input" type="checkbox" name="upt" value="true">
                            </div>
                        </div>
                        <div class="d-grid">
                            <input type="submit" value="Edit" name="save" class="btn btn-primary mx-5 mb-3 rounded-pill">
                        </div>
                    </div>
                </div>
            </form>
        </section>
    <?php } ?>
    <?php
    include "link.php";
    ?>
</body>

</html>