<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../../assets/style/gambar/Tek.png">
    <link rel="stylesheet" href="../../../assets/style/base.css">
    <link rel="stylesheet" href="../../../assets/style/bootstrap.min.css">
    <link rel="stylesheet" href="../../../assets/style/form.css">
    <title>GaleryTek | Form Tambah Harga</title>
</head>

<body>
    <?php
    session_start();
    include "../../../assets/shortcut/nav.php";
    include "../../../assets/function/function.php";
    $harga = "";
    $tanggal = "";
    if (isset($_GET['copy'])) {
        $id = $_GET['copy'];
        $query = query("SELECT * FROM harga WHERE id_harga = $id");
        if (mysqli_num_rows($query) != 0) {
            $tampil = mysqli_fetch_array($query);
            $harga = $tampil['avg_price'];
            $tanggal = $tampil['tanggal'];
        } else {
            unset($_GET['copy']);
        }
    }
    ?>
    <section class="main">
        <form action="../aksi/aksi_tambah.php" method="post" class="d-flex flex-column border rounded text-center" style="margin-top: 100px;">
            <h2 class="title rounded-top text-white p-1">Form Tambah Harga</h2>
            <?php
            if (isset($_GET['copy'])) {
                echo "<input type='hidden' name='copy' value='$id'>";
            }
            if (isset($_SESSION['gagal'])) {
                echo "<div class='alert alert-danger m-auto' role='alert'>" . $_SESSION['gagal'] . "</div>";
                unset($_SESSION['gagal']);
            }
            ?>
            <div class="p-2">
                <div class="input-group flex-nowrap p-2">
                    <select name="id_hardware" class="form-select" aria-label="Default select example">
                        <?php
                        if (isset($_GET['copy'])) {
                            $id = $_GET['copy'];
                            $query = query("SELECT * FROM harga WHERE id_harga = $id");
                            $tampil = mysqli_fetch_array($query);
                            $id_hardware = $tampil['id_hardware'];
                            $query = query("SELECT * FROM hardware WHERE id_hardware = $id_hardware");
                            $tampil = mysqli_fetch_array($query);
                            echo "<option value='$id_hardware'>" . $tampil['nama'] . " - " . $tampil['kategori'] . "</option>";
                        } else {
                            echo "<option selected>Hardware</option>";
                        }
                        $query = query("SELECT * FROM hardware");
                        if (mysqli_num_rows($query) == 0) {
                            echo "<option disabled>Data tidak ada</option>";
                        }
                        while ($tampil = mysqli_fetch_array($query)) {
                        ?>
                            <option value="<?= $tampil['id_hardware'] ?>"><?= $tampil['nama'] ?> - <?= $tampil['kategori'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="input-group p-2">
                    <label class="input-group-text" for="harga">Harga(IDR)</label>
                    <input name="avg_price" type="number" class="form-control" id="harga" value="<?= $harga ?>" required>
                    <label class="input-group-text" for="harga">,00</label>
                </div>
                <div class="input-group p-2">
                    <label class="input-group-text" for="tanggal">Tanggal di rekap</label>
                    <input name="tanggal" type="date" class="form-control" id="tanggal" value="<?= $tanggal ?>" required>
                </div>
            </div>
            <input type="submit" value="Tambah" name="harga" class="btn btn-primary mx-5 mb-3 rounded-pill">
        </form>
    </section>
    <?php
    include "../../../assets/shortcut/link.php";
    ?>
    <script type="text/javascript" src="../../../assets/script/NoRClick.js"></script>
</body>

</html>