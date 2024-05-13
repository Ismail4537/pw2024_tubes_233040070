<?php
include "../assets/shortcut/koneksi.php";
?>
<table class="text-center table table-bordered table-hover table-responsive table-sm tableku">
    <thead class="table-success">
        <tr>
            <th class="align-content-center" width="2%">#</th>
            <th class="align-content-center" width="10%">Foto Profile</th>
            <th class="align-content-center" width="20%">Username</th>
            <th class="align-content-center">Email</th>
            <th class='align-content-center' width='10%'>Action</th>

        </tr>
    </thead>
    <tfoot class="table-success">
        <tr>
            <th class="align-content-center">#</th>
            <th class="align-content-center">Foto Profile</th>
            <th class="align-content-center">Username</th>
            <th class="align-content-center">Email</th>
            <th class='align-content-center'>Action</th>
        </tr>
    </tfoot>
    <?php
    // mengecek apakah ada data yang dicari
    if (isset($_POST['cari'])) {
        $cari = $_POST['cari'];
        $data = mysqli_query($koneksi, "SELECT * FROM user WHERE username LIKE '%" . $cari . "%' or email LIKE '%" . $cari . "%'");
    } else {
        // jika tidak ada data yang dicari
        $data = mysqli_query($koneksi, "SELECT * FROM user");
    }
    // inisialisasi variabel no untuk urutan data
    $no = 1;
    // menampilkan data dari database
    while ($tampil = mysqli_fetch_array($data)) {
        if ($tampil['gambar']) {
            $gambar = $tampil['gambar'];
        } else {
            $gambar = "Profile_picture.png";
        }
    ?>
        <tr>
            <th class="align-content-center" scope="row"><?= $no++; ?></th>
            <td class="align-content-center">
                <img class="rounded-circle" src="recource/gambar_profile/<?= $gambar ?>" alt="<?= $gambar ?>">
            </td>
            <td class="align-content-center"><a href="user.php?id=<?= $tampil['id'] ?>"><?= $tampil['username']; ?></a><br><b><?= $tampil['role']; ?></b></td>
            <td class="align-content-center"><?= $tampil['email']; ?></td>
            <td class='align-content-center'>
                <div class='action d-flex flex-column'>
                    <a href='form/edit_profile.php?id=<?= $tampil['id'] ?>' class='btn btn-success mb-1'>Edit</a>
                    <a href="aksi/hapus_profile.php?id=<?= $tampil['id'] ?>" class='btn btn-danger' onclick='return confirm(`Anda yakin mau menghapus item ini ?`)'>Hapus</a>
                </div>
            </td>
        </tr>
    <?php
    }
    ?>
</table>