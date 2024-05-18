<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../assets/style/gambar/Tek.png">
    <link rel="stylesheet" href="../assets/style/base.css">
    <link rel="stylesheet" href="../assets/style/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/style/index.css">
    <title>GaleryTek</title>
</head>

<body>
    <?php
    // mengambil konfigurasi koneksi
    include "../assets/shortcut/nav.php";
    include "../assets/function/function.php";
    ?>
    <header class="d-flex align-content-center justify-content-center flex-column text-center" style="height: 100vh; color: black;">
        <h4><img src="../assets/style/gambar/Tek.png" alt="Tek" width="100px"></h4>
        <h1>GaleryTek</h1>
        <br>
        <p class="mx-4">GaleryTek adalah sebuah galery teknologi dimana berfungsi sebagai platform untuk menampilkan berbagai jenis Hardware komputer dalam bentuk gambar dengan deskripsinya</p>
    </header>
    <marquee behavior="" direction="left" class="bg-dark text-white">
        Selamat datang,
        <b class="text-capitalize">
            <?= $tampil_user['role']; ?>
        </b>
        <?= $tampil_user['username']; ?>
    </marquee>
    <section class="main d-flex flex-column p-1" id="main">
        <div class="data m-auto">
            <div class="ultility d-flex justify-content-between m-3">
                <div class="d-flex mx-2" role="search">
                    <input class="form-control me-2" class="cari" type="text" placeholder="Search" name="cari" id="cari" aria-label="Search">
                    <i class='fa-solid fa-magnifying-glass my-auto'></i>
                </div>
                <div class="buttons">
                    <a href="../pdf/pdf_harga.php" class="btn btn-danger">PDF Report <i class="fa-regular fa-file-pdf ms-2"></i></a>
                    <a href='crud/form/tambah_harga.php' class='text-decoration-none btn btn-primary my-auto'>Tambah</a>
                </div>
            </div>
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
                $data = query("SELECT * FROM harga INNER JOIN hardware ON harga.id_hardware = hardware.id_hardware");
                // }
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
        </div>
    </section>
    <?php
    include "../assets/shortcut/link.php";
    ?>
    <script>
        $(document).ready(function() {
            $(" body").on("change keyup keydown", "#cari", function() {
                var cari = $(this).val();
                var data = "cari=" + cari;
                // alert(data);
                $.ajax({
                    method: 'POST',
                    url: 'crud/data_harga.php',
                    data: data,
                    success: function(result) {
                        $(".tableku").html(result);
                    }
                })
            })
        });
    </script>
</body>

</html>