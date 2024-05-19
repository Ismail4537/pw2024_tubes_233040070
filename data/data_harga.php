<?php
include "../assets/function/function.php";
?>
<table class="text-center table table-bordered table-hover table-responsive table-sm tableku">
    <thead class="table-success">
        <tr>
            <th class="align-content-center" width="2%">#</th>
            <th class="align-content-center" width="10%">Hardware</th>
            <th class="align-content-center" width="10%">Harga rata-rata</th>
            <th class="align-content-center" width="10%">Tanggal Rekap</th>
        </tr>
    </thead>
    <tfoot class="table-success">
        <tr>
            <th class="align-content-center">#</th>
            <th class="align-content-center">Hardware</th>
            <th class="align-content-center">Harga rata-rata</th>
            <th class="align-content-center">Tanggal Rekap</th>
        </tr>
    </tfoot>
    <?php
    $sort1 = "id_harga";
    $sort2 = "ASC";
    $cari1 = "";
    $cari2 = "hardware.nama";
    if (isset($_POST['sort1']) or isset($_POST['sort2'])) {
        $sort1 = $_POST['sort1'];
        $sort2 = $_POST['sort2'];
        $cari1 = $_POST['cari1'];
        $cari2 = $_POST['cari2'];
    }
    $data = query("SELECT * FROM harga INNER JOIN hardware ON harga.id_hardware = hardware.id_hardware WHERE $cari2 LIKE '%" . $cari1 . "%' ORDER BY " . $sort1 . " " . $sort2 . "");
    if (mysqli_num_rows($data) == 0) {
        echo "<tr><td colspan='5'>Data tidak ditemukan</td></tr>";
    }
    // inisialisasi variabel no untuk urutan data
    $no = 1;
    // menampilkan data dari database
    while ($tampil = mysqli_fetch_array($data)) {
        $date = date_create($tampil['tanggal']);
    ?>
        <tr>
            <th class="align-content-center" scope="row"><?= $no++; ?></th>
            <td class="align-content-center"><img src="admin/crud/recource/gambar/<?= $tampil['gambar'] ?>" alt=""><br>
                <b><a style="color: black;" href="hardware.php?nama=<?= $tampil['nama'] ?>#main"><?= $tampil['nama']; ?></a></b><br><?= $tampil['kategori'] ?>
            </td>
            <td class="align-content-center">
                <p class="mx-2">Rp,<?= number_format($tampil['avg_price'], 0, '', '.'); ?>,00</p>
            </td>
            <td class="align-content-center"><?= date_format($date, "Y/M/d l"); ?></td>
        </tr>
    <?php
    }
    ?>
</table>