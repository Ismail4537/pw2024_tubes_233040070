<?php
include "../../assets/function/function.php";
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
    $sort1 = "id";
    $sort2 = "ASC";
    $cari1 = "";
    $cari2 = "username";
    if (isset($_POST['sort1']) or isset($_POST['sort2'])) {
        $sort1 = $_POST['sort1'];
        $sort2 = $_POST['sort2'];
        $cari1 = $_POST['cari1'];
        $cari2 = $_POST['cari2'];
    }
    $data = search_single("user", $sort1, $sort2, $cari1, $cari2);
    if (mysqli_num_rows($data) == 0) {
        echo "<tr><td colspan='5'>Data tidak ditemukan</td></tr>";
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
                <img class="rounded-circle" src="crud/recource/gambar_profile/<?= $gambar ?>" alt="<?= $gambar ?>" style="width: 50px; height:50px;">
            </td>
            <td class="align-content-center"><a href="user.php?id=<?= $tampil['id'] ?>"><?= $tampil['username']; ?></a><br><b><?= $tampil['role']; ?></b></td>
            <td class="align-content-center"><?= $tampil['email']; ?></td>
            <td class='align-content-center'>
                <div class='action d-flex flex-column'>
                    <a href='crud/form/edit_profile.php?id=<?= $tampil['id'] ?>' class='btn btn-success mb-1'>Edit</a>
                    <a href="crud/aksi/hapus_profile.php?id=<?= $tampil['id'] ?>" class='btn btn-danger' onclick='return confirm(`Anda yakin mau menghapus item ini ?`)'>Hapus</a>
                </div>
            </td>
        </tr>
    <?php
    }
    ?>
</table>