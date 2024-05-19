<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../../assets/style/gambar/Tek.png">
    <link rel="stylesheet" href="../../../assets/style/base.css">
    <link rel="stylesheet" href="../../../assets/style/bootstrap.min.css">
    <link rel="stylesheet" href="../../../assets/style/form.css">
    <title>GaleryTek | Form Tambah Hardware</title>
</head>

<body>
    <?php
    include "../../../assets/shortcut/nav.php";
    ?>
    <section class="main">
        <form action="../aksi/aksi_tambah.php" method="post" enctype="multipart/form-data" class="d-flex flex-column border rounded text-center mx-5">
            <h2 class="title rounded-top text-white p-1">Form Tambah Hardware</h2>
            <?php
            if (isset($_SESSION['gagal'])) {
                echo "<div class='alert alert-danger m-auto' role='alert'>" . $_SESSION['gagal'] . "</div>";
                unset($_SESSION['gagal']);
            }
            ?>
            <div class="p-2">
                <div class="input-group flex-nowrap p-2">
                    <span class="input-group-text" id="addon-wrapping">Nama</span>
                    <input name="nama" type="text" class="form-control" placeholder="Nama" aria-label="Nama" aria-describedby="addon-wrapping" required>
                    <select name="kategori" class="form-select" aria-label="Default select example">
                        <option selected>Kategori</option>
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
                <div class="form-floating p-2">
                    <textarea name="deskripsi" class="form-control" placeholder="Masukan Deskripsi" id="floatingTextarea"></textarea>
                    <label for="floatingTextarea">Deskripsi</label>
                </div>
                <div class="input-group p-2">
                    <label class="input-group-text" for="gambar">Gambar</label>
                    <input name="gambar" type="file" class="form-control" id="gambar" required>
                </div>
            </div>
            <input type="submit" value="Tambah" name="hardware" class="btn btn-primary mx-5 mb-3 rounded-pill">
        </form>
    </section>
    <?php
    include "../../../assets/shortcut/link.php";
    ?>
    <script type="text/javascript" src="../../../assets/script/NoRClick.js"></script>
</body>

</html>