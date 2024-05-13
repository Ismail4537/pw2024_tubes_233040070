<?php
include "../../assets/shortcut/koneksi.php";
?>
<table class="text-center table table-bordered table-hover table-responsive table-sm tableku">
    <thead class="table-success">
        <tr>
            <th class="align-content-center" width="2%">#</th>
            <th class="align-content-center" width="20%">Gambar</th>
            <th class="align-content-center" width="10%">Nama</th>
            <th class="align-content-center" width="10%">Kategori</th>
            <th class="align-content-center">Deskripsi</th>
            <th class='align-content-center' width='10%'>Aksi</th>
        </tr>
    </thead>
    <tfoot class="table-success">
        <tr>
            <th class="align-content-center">#</th>
            <th class="align-content-center">Gambar</th>
            <th class="align-content-center">Nama</th>
            <th class="align-content-center">Kategori</th>
            <th class="align-content-center">Deskripsi</th>
            <th class='align-content-center'>Aksi</th>
        </tr>
    </tfoot>
    <?php
    // mengecek apakah ada data yang dicari
    if (isset($_POST['cari'])) {
        $cari = $_POST['cari'];
        $data = mysqli_query($koneksi, "SELECT * FROM hardware WHERE nama LIKE '%" . $cari . "%'");
    } else {
        // jika tidak ada data yang dicari
        $data = mysqli_query($koneksi, "SELECT * FROM hardware");
    }
    // inisialisasi variabel no untuk urutan data
    $no = 1;
    // menampilkan data dari database
    while ($tampil = mysqli_fetch_array($data)) {
    ?>
        <tr>
            <th class="align-content-center" scope="row"><?= $no++; ?></th>
            <td class="align-content-center">
                <img src="crud/recource/gambar/<?= $tampil['gambar'] ?>" alt="<?= $tampil['gambar'] ?>">
            </td>
            <td class="align-content-center"><?= $tampil['nama']; ?></td>
            <td class="align-content-center"><?= $tampil['kategori']; ?></td>
            <td class="align-content-center"><?= $tampil['deskripsi']; ?></td>
            <td class='align-content-center'>
                <div class='action d-flex flex-column'>
                    <a href='form/edit_hardware.php?id=<?= $tampil['id_hardware'] ?>' class='btn btn-success mb-1'>Edit</a>
                    <a href='aksi/hapus.php?id_hardware=<?= $tampil['id_hardware'] ?>' class='btn btn-danger' onclick='return confirm(`Anda yakin mau menghapus item ini ?`)'>Hapus</a>
                </div>
            </td>
        </tr>
    <?php
    }
    ?>
</table>