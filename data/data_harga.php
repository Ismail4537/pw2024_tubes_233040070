<?php
include "../assets/function/function.php";
?>
<div class="tableku row justify-content-center">
    <?php
    $sort1 = isset($_POST['sort1']) ? $_POST['sort1'] : "id_harga";
    $sort2 = isset($_POST['sort2']) ? $_POST['sort2'] : "ASC";
    $cari1 = isset($_POST['cari1']) ? $_POST['cari1'] : "";
    $cari2 = isset($_POST['cari2']) ? $_POST['cari2'] : "hardware.nama";
    $limit = isset($_POST['limit']) ? $_POST['limit'] : 6;
    $page = isset($_POST['page']) ? $_POST['page'] : 1;
    $limit_start = ($page - 1) * $limit;
    $limit_start = ($limit_start < 0) ? 0 : $limit_start;
    $data = query("SELECT * FROM harga INNER JOIN hardware ON harga.id_hardware = hardware.id_hardware WHERE $cari2 LIKE '%" . $cari1 . "%' ORDER BY " . $sort1 . " " . $sort2 . " LIMIT " . $limit_start . "," . $limit . "");
    if (mysqli_num_rows($data) == 0) {
        echo "<div class='alert alert-danger m-auto' role='alert'>Belum ada Data, anda bisa register untuk menambahkan data atau info tentang hal-hal hardware terbaru</div>";
    }
    $no = $limit_start + 1;
    while ($tampil = mysqli_fetch_array($data)) {
        $date = date_create($tampil['tanggal']);
    ?>
        <div class="col-6 col-sm-4 mb-3 m-auto px-1" style="width: 20rem;">
            <div class="card m-auto">
                <img class="card-img-top" style="height: 14rem;" src="admin/crud/recource/gambar/<?= $tampil['gambar'] ?>" alt="<?= $tampil['gambar'] ?>">
                <div class="card-body">
                    <h5 class="card-title"><b><a style="color: black;" href="hardware.php?nama=<?= $tampil['nama'] ?>#main"><?= $tampil['nama']; ?></a></b><br><?= $tampil['kategori'] ?></h5>
                    <p class="card-text">Rp,<?= number_format($tampil['avg_price'], 0, '', '.'); ?>,00</p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Tanggal di rekap : <br><?= date_format($date, "Y/M/d"); ?></li>
                </ul>
            </div>
        </div>
    <?php
    }
    ?>
</div>
<?php
$query_jumlah = "SELECT COUNT(*) AS jumlah FROM harga INNER JOIN hardware ON harga.id_hardware = hardware.id_hardware WHERE $cari2 LIKE '%" . $cari1 . "%'";
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