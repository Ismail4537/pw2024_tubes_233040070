<?php
include "../assets/function/function.php";
?>
<div class="tableku row">
    <?php
    $sort1 = "id_hardware";
    $sort2 = "ASC";
    $cari1 = "";
    $cari2 = "nama";
    if (isset($_POST['sort1']) or isset($_POST['sort2'])) {
        $sort1 = $_POST['sort1'];
        $sort2 = $_POST['sort2'];
        $cari1 = $_POST['cari1'];
        $cari2 = $_POST['cari2'];
    }
    $data = search_single("hardware", $sort1, $sort2, $cari1, $cari2);
    if (mysqli_num_rows($data) == 0) {
        echo "<div class='alert alert-danger m-auto mb-2' role='alert'>Belum ada Data, anda bisa register untuk menambahkan data atau info tentang hal-hal hardware terbaru</div>";
    }
    // inisialisasi variabel no untuk urutan data
    $no = 1;
    // menampilkan data dari database
    while ($tampil = mysqli_fetch_array($data)) {
    ?>
        <div class="col-6 col-sm-4 mb-3 m-auto px-1" style="width: 50%;">
            <div class="card m-auto">
                <img class="card-img-top" style="height: 14rem;" src="admin/crud/recource/gambar/<?= $tampil['gambar'] ?>" alt="<?= $tampil['gambar'] ?>">
                <div class="card-body">
                    <h5 class="card-title"><b><?= $tampil['nama']; ?></b> | <?= $tampil['kategori'] ?></h5>
                    <p class="card-text"><?= $tampil['deskripsi']; ?></p>
                </div>
            </div>
        </div>
    <?php
    }
    ?>
</div>