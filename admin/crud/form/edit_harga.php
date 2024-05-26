<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../../assets/style/gambar/Tek.png">
    <link rel="stylesheet" href="../../../assets/style/base.css">
    <link rel="stylesheet" href="../../../assets/style/bootstrap.min.css">
    <link rel="stylesheet" href="../../../assets/style/form.css">
    <title>GaleryTek | Form Edit Harga</title>
</head>

<body>
    <?php
    session_start();
    include "../../../assets/shortcut/nav.php";
    include "../../../assets/function/function.php";
    if (!$_GET["id"]) {
        header("location:../../harga.php?=id_kosong");
        return;
    }
    $id = $_GET["id"];
    $query = query("SELECT * FROM harga WHERE id_harga='$id'");
    $tampil = mysqli_fetch_array($query)
    ?>
    <section class="main">
        <form action="../aksi/aksi_edit.php" method="post" class="d-flex flex-column border rounded text-center" style="margin-top: 100px;">
            <h2 class="title rounded-top text-white p-1">Form Edit Harga</h2>
            <?php
            if (isset($_SESSION['gagal'])) {
                echo "<div class='alert alert-danger m-auto' role='alert'>" . $_SESSION['gagal'] . "</div>";
                unset($_SESSION['gagal']);
            }
            ?>
            <input type="text" name="id" id="" value="<?= $tampil["id_harga"]; ?>" hidden readonly>
            <div class="p-2">
                <div class="input-group flex-nowrap p-2">
                    <select name="id_hardware" class="form-select" aria-label="Default select example">
                        <?php
                        $Qselect = query("SELECT * FROM hardware WHERE id_hardware=" . $tampil['id_hardware'] . "");
                        $Tselect = mysqli_fetch_assoc($Qselect);
                        ?>
                        <option selected value="<?= $tampil['id_hardware'] ?>"><?= $Tselect['nama'] ?> - <?= $Tselect['kategori'] ?></option>
                        <?php
                        $Qlist = query("SELECT * FROM hardware");
                        if (mysqli_num_rows($Qlist) == 0) {
                            echo "<option disabled>Data tidak ada</option>";
                        }
                        while ($Tlist = mysqli_fetch_array($Qlist)) {
                        ?>
                            <option value="<?= $Tlist['id_hardware'] ?>"><?= $Tlist['nama'] ?> - <?= $Tlist['kategori'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="input-group p-2">
                    <label class="input-group-text" for="harga">Harga(IDR)</label>
                    <input name="avg_price" type="number" class="form-control" id="harga" value="<?= $tampil['avg_price'] ?>" required>
                    <label class="input-group-text" for="harga">,00</label>
                </div>
                <div class="input-group p-2">
                    <label class="input-group-text" for="tanggal">Tanggal di rekap</label>
                    <input name="tanggal" type="date" class="form-control" id="tanggal" value="<?= $tampil['tanggal'] ?>" required>
                </div>
            </div>
            <input type="submit" value="Edit" name="harga" class="btn btn-primary mx-5 mb-3 rounded-pill">
        </form>
    </section>
    <?php
    include "../../../assets/shortcut/link.php";
    ?>
    <script type="text/javascript" src="../../../assets/script/NoRClick.js"></script>
</body>

</html>