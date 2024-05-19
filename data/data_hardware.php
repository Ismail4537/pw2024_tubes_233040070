<?php
include "../assets/function/function.php";
?>
<table class="text-center table table-bordered table-hover table-responsive table-sm tableku">
    <thead class="table-success">
        <tr>
            <th class="align-content-center" width="2%">#</th>
            <th class="align-content-center" width="20%">Gambar</th>
            <th class="align-content-center" width="10%">Nama</th>
            <th class="align-content-center" width="10%">Kategori</th>
            <th class="align-content-center">Deskripsi</th>
        </tr>
    </thead>
    <tfoot class="table-success">
        <tr>
            <th class="align-content-center">#</th>
            <th class="align-content-center">Gambar</th>
            <th class="align-content-center">Nama</th>
            <th class="align-content-center">Kategori</th>
            <th class="align-content-center">Deskripsi</th>
        </tr>
    </tfoot>
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
        echo "<tr><td colspan='5'>Data tidak ditemukan</td></tr>";
    }
    // inisialisasi variabel no untuk urutan data
    $no = 1;
    // menampilkan data dari database
    while ($tampil = mysqli_fetch_array($data)) {
    ?>
        <tr>
            <th class="align-content-center" scope="row"><?= $no++; ?></th>
            <td class="align-content-center">
                <img src="admin/crud/recource/gambar/<?= $tampil['gambar'] ?>" alt="<?= $tampil['gambar'] ?>">
            </td>
            <td class="align-content-center"><?= $tampil['nama']; ?></td>
            <td class="align-content-center"><?= $tampil['kategori']; ?></td>
            <td class="align-content-center"><?= $tampil['deskripsi']; ?></td>
        </tr>
    <?php
    }
    ?>
</table>