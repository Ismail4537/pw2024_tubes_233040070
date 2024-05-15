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
    // mengecek apakah ada data yang dicari
    if (isset($_POST['cari'])) {
        $cari = $_POST['cari'];
        $data = query("SELECT * FROM hardware WHERE nama LIKE '%" . $cari . "%'");
    } else {
        // jika tidak ada data yang dicari
        $data = query("SELECT * FROM hardware");
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