<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../../assets/style/gambar/Tek.png">
    <link rel="stylesheet" href="../../../assets/style/base.css">
    <link rel="stylesheet" href="../../../assets/style/bootstrap.min.css">
    <link rel="stylesheet" href="../../../assets/style/form.css">
    <title>GaleryTek | Form Edit Hardware</title>
</head>

<body>
    <?php
    include "../../../assets/shortcut/nav.php";
    if (!$_GET["id"]) {
        header("location:../../harga.php?=id_kosong");
        return;
    }
    $id = $_GET["id"];
    $query = mysqli_query($koneksi, "SELECT * FROM hardware WHERE id_hardware='$id'");
    $tampil = mysqli_fetch_array($query)
    ?>
    <section class="main">
        <form action="../aksi/aksi_edit.php" method="post" enctype="multipart/form-data" class="d-flex flex-column border rounded text-center mx-5">
            <h2 class="title rounded-top text-white p-1">Form Edit Hardware</h2>
            <?php
            if (isset($_SESSION['gagal'])) {
                echo "<div class='alert alert-danger m-auto' role='alert'>" . $_SESSION['gagal'] . "</div>";
                unset($_SESSION['gagal']);
            }
            ?>
            <input type="text" name="id" id="" value="<?= $tampil["id_hardware"]; ?>" hidden readonly>
            <div class="d-flex m-2" style="width:auto;">
                <div class="border d-inline-flex flex-column text-center p-2 justify-content-center">
                    <h4>Gambar lama</h4>
                    <img class="mx-auto mb-2 mt-0" src="../recource/gambar/<?= $tampil['gambar'] ?>" alt="<?= $tampil['gambar'] ?>">
                    <p>Kategori : <?= $tampil['kategori']; ?>
                    </p>
                </div>
                <div class="text-start ms-2" style="width:100%;">
                    <span>Nama</span>
                    <div class="mb-2">
                        <input name="nama" value="<?= $tampil['nama']; ?>" type="text" class="form-control" placeholder="Nama" aria-label="Nama" aria-describedby="addon-wrapping" required>
                    </div>
                    <div class="mb-2">
                        <select name="kategori" class="form-select" aria-label="Default select example">
                            <option selected value="<?= $tampil["kategori"]; ?>">Kategori</option>
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
                        <textarea name="deskripsi" class="form-control" placeholder="Masukan Deskripsi" id="deskripsi"><?= $tampil['deskripsi']; ?></textarea>
                        <label for="deskripsi">Deskripsi</label>
                    </div>
                    <label>Gambar Baru</label>
                    <div class="input-group mb-2">
                        <input name="gambaru" type="file" class="form-control" id="gambar">
                        <div class="input-group-text">
                            <input class="form-check-input" type="checkbox" name="upt" value="true">
                        </div>
                    </div>
                    <div class="d-grid">
                        <input type="submit" value="Edit" name="hardware" class="btn btn-primary mx-5 mb-3 rounded-pill">
                    </div>
                </div>
            </div>
        </form>
    </section>
    <?php
    include "../../../assets/shortcut/link.php";
    ?>
    <script type="text/javascript" src="../../../assets/script/NoRClick.js"></script>
</body>

</html>