<?php
include "../../assets/function/function.php";
?>
<table class="text-center table table-bordered table-hover table-responsive table-sm tableku">
    <thead class="table-success">
        <tr>
            <th class="align-content-center" width="2%">#</th>
            <th class="align-content-center" width="10%">Hardware</th>
            <th class="align-content-center" width="10%">Harga rata-rata</th>
            <th class="align-content-center" width="10%">Tanggal Rekap</th>
            <th class='align-content-center' width='10%'>Aksi</th>
        </tr>
    </thead>
    <tfoot class="table-success">
        <tr>
            <th class="align-content-center">#</th>
            <th class="align-content-center">Hardware</th>
            <th class="align-content-center">Harga rata-rata</th>
            <th class="align-content-center">Tanggal Rekap</th>
            <th class='align-content-center'>Aksi</th>
        </tr>
    </tfoot>
    <?php
    // mengecek apakah ada data yang dicari
    if (isset($_POST['cari'])) {
        $cari = $_POST['cari'];
        $data = query("SELECT * FROM harga INNER JOIN hardware ON harga.id_hardware = hardware.id_hardware WHERE hardware.nama LIKE '%" . $cari . "%'");
    } else {
        $data = query("SELECT * FROM harga INNER JOIN hardware ON harga.id_hardware = hardware.id_hardware");
    }
    // inisialisasi variabel no untuk urutan data
    $no = 1;
    // menampilkan data dari database
    while ($tampil = mysqli_fetch_array($data)) {
        $date = date_create($tampil['tanggal']);
    ?>
        <tr>
            <th class="align-content-center" scope="row"><?= $no++; ?></th>
            <td class="align-content-center"><img src="crud/recource/gambar/<?= $tampil['gambar'] ?>" alt=""><br><a class="text-dark" href="hardware.php?id=<?= $tampil['id_hardware']; ?>#main"><?= $tampil['nama']; ?></a><br><?= $tampil['kategori'] ?></td>
            <td class="align-content-center">
                <p class="mx-2">Rp,<?= number_format($tampil['avg_price'], 0, '', '.'); ?>,00</p>
            </td>
            <td class="align-content-center"><?= date_format($date, "Y/M/d l"); ?></td>
            <td class='align-content-center'>
                <div class='action d-flex flex-column'>
                    <a href='crud/form/edit_harga.php?id=<?= $tampil['id_harga'] ?>' class='btn btn-success mb-1'>Edit</a>
                    <a href='crud/aksi/hapus.php?id_harga=<?= $tampil['id_harga'] ?>' class='btn btn-danger' onclick='return confirm(`Anda yakin mau menghapus item ini ?`)'>Hapus</a>
                </div>
            </td>
        </tr>
    <?php
    }
    ?>
</table>