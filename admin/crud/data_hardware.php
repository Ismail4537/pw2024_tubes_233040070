<?php
include "../../assets/function/function.php";
?>
<div class="tableku">
    <table class="text-center table table-bordered table-hover table-responsive table-sm">
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
        $sort1 = isset($_POST['sort1']) ? $_POST['sort1'] : "id_hardware";
        $sort2 = isset($_POST['sort2']) ? $_POST['sort2'] : "ASC";
        $cari1 = isset($_POST['cari1']) ? $_POST['cari1'] : "";
        $cari2 = isset($_POST['cari2']) ? $_POST['cari2'] : "nama";
        $limit = isset($_POST['limit']) ? $_POST['limit'] : 10;
        $page = isset($_POST['page']) ? $_POST['page'] : 1;
        $limit_start = ($page - 1) * $limit;
        $limit_start = ($limit_start < 0) ? 0 : $limit_start;
        $data = search_single("hardware", $sort1, $sort2, $cari1, $cari2, $limit_start, $limit);
        if (mysqli_num_rows($data) == 0) {
            echo "<tr><td colspan='5'>Data tidak ditemukan</td></tr>";
        }
        $no = $limit_start + 1;
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
                        <a href='crud/form/edit_hardware.php?id=<?= $tampil['id_hardware'] ?>' class='btn btn-success mb-1'>Edit</a>
                        <a href='crud/aksi/hapus.php?id_hardware=<?= $tampil['id_hardware'] ?>' class='btn btn-danger' onclick='return confirm(`Anda yakin mau menghapus item ini ?`)'>Hapus</a>
                    </div>
                </td>
            </tr>
        <?php
        }
        ?>
    </table>
    <div>
        <?php
        $query_jumlah = "SELECT COUNT(*) AS jumlah FROM hardware WHERE $cari2 LIKE '%" . $cari1 . "%'";
        $hasil_jumlah = query($query_jumlah);
        $data_jumlah = mysqli_fetch_array($hasil_jumlah);
        $total_records = $data_jumlah['jumlah'];
        ?>
        <p>Total Data : <?= $total_records; ?></p>
        <nav class="mb-5">
            <ul class="pagination justify-content-end">
                <?php
                $jumlah_page = ceil($total_records / $limit);
                $jumlah_number = 1;
                $start_number = ($page > $jumlah_number) ? $page - $jumlah_number : 1;
                $end_number = ($page < ($jumlah_page - $jumlah_number)) ? $page + $jumlah_number : $jumlah_page;
                if (mysqli_num_rows($data) == 0) {
                    return;
                }
                if ($page == 1) {
                    echo '<li class="page-item disabled"><a class="page-link" href="#main">First</a></li>';
                    echo '<li class="page-item disabled"><a class="page-link" href="#main"><span aria-hidden="true">&laquo;</span></a></li>';
                } else {
                    $link_prev = ($page > 1) ? $page - 1 : 1;
                    echo '<li class="page-item halaman" id="1"><a class="page-link" href="#main">First</a></li>';
                    echo '<li class="page-item halaman" id="' . $link_prev . '"><a class="page-link" href="#main"><span aria-hidden="true">&laquo;</span></a></li>';
                }

                for ($i = $start_number; $i <= $end_number; $i++) {
                    $link_active = ($page == $i) ? ' active' : '';
                    echo '<li class="page-item halaman ' . $link_active . '" id="' . $i . '"><a class="page-link" href="#main">' . $i . '</a></li>';
                }

                if ($page == $jumlah_page) {
                    echo '<li class="page-item disabled"><a class="page-link" href="#main"><span aria-hidden="true">&raquo;</span></a></li>';
                    echo '<li class="page-item disabled"><a class="page-link" href="#main">Last</a></li>';
                } else {
                    $link_next = ($page < $jumlah_page) ? $page + 1 : $jumlah_page;
                    echo '<li class="page-item halaman" id="' . $link_next . '"><a class="page-link" href="#main"><span aria-hidden="true">&raquo;</span></a></li>';
                    echo '<li class="page-item halaman" id="' . $jumlah_page . '"><a class="page-link" href="#main">Last</a></li>';
                }
                ?>
            </ul>
        </nav>
    </div>
</div>