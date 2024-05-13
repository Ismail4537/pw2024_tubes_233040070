<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../assets/style/gambar/Tek.png">
    <link rel="stylesheet" href="../assets/style/base.css">
    <link rel="stylesheet" href="../assets/style/bootstrap.min.css">
    <link rel="stylesheet" href="http://localhost/pw2024_tubes_233040070/admin/assets/plugins/fontawesome-free-6.5.2-web/css/all.css">
    <link rel="stylesheet" href="../assets/style/index.css">
    <title>GaleryTek</title>
    <!-- <style>
        * {
            border: 1px solid red;
        }
    </style> -->
</head>

<body>
    <?php
    // mengambil konfigurasi koneksi
    include "../assets/shortcut/nav.php";
    ?>
    <header class="d-flex align-content-center justify-content-center flex-column text-center" style="height: 100vh; color: black;">
        <h4><img src="../assets/style/gambar/Tek.png" alt="Tek" width="100px"></h4>
        <h1>GaleryTek</h1>
        <br>
        <p>GaleryTek adalah sebuah galery teknologi dimana berfungsi sebagai platform untuk menampilkan berbagai jenis Hardware komputer dalam bentuk gambar dengan deskripsinya</p>
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
            <div class="ultility d-flex justify-content-between m-3 flex-row-reverse">
                <a href='form/tambah_hardware.php' class='text-decoration-none btn btn-primary my-auto'>Tambah</a>
                <div class="d-flex mx-2" role="search">
                    <input class="form-control me-2" class="cari" type="text" placeholder="Search" name="cari" id="cari" aria-label="Search">
                    <i class='fa-solid fa-magnifying-glass my-auto'></i>
                </div>
            </div>
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
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $data = mysqli_query($koneksi, "SELECT * FROM hardware WHERE id_hardware =" . $id);
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
                            <img src="http://localhost/pw2024_tubes_233040070/admin/crud/recource/gambar/<?= $tampil['gambar'] ?>" alt="<?= $tampil['gambar'] ?>">
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
                    url: 'data_hardware.php',
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