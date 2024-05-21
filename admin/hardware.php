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
    session_start();
    include "../assets/shortcut/nav.php";
    include "../assets/function/function.php";
    ?>
    <header class="d-flex align-content-center justify-content-center flex-column text-center" style="height: 100vh; color: black;">
        <h4><img class="TEK" src="../assets/style/gambar/Tek.png" alt="Tek" width="100px"></h4>
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
            <div class="ultility d-flex m-3 justify-content-between">
                <div class="d-flex flex-column">
                    <div class="d-flex">
                        <div class="d-flex me-2 form-floating mb-2">
                            <select name="sort1" id="sort1" class="form-select select" aria-label="Default select example">
                                <option selected value="id_hardware">Id</option>
                                <option value="nama">Nama</option>
                                <option value="kategori">Kategori</option>
                                <option value="deskripsi">Deskripsi</option>
                            </select>
                            <label for="sort1" class="select">Sort By</label>
                        </div>
                        <div class="d-flex me-2 form-floating">
                            <select name="sort2" id="sort2" class="form-select select" aria-label="Default select example">
                                <option selected value="ASC">Menaik</option>
                                <option value="DESC">Menurun</option>
                            </select>
                            <label for="sort2" class="select">Urutan</label>
                        </div>
                        <div class="d-flex me-2 form-floating">
                            <select name="limit" id="limit" class="form-select select">
                                <option selected value="10">10</option>
                                <option value="20">20</option>
                                <option value="30">30</option>
                            </select>
                            <label for="limit" class="select">Limit</label>
                        </div>
                    </div>
                    <div class="input-group my-auto">
                        <select name="cari2" id="cari2" class="form-select mx-auto select" aria-label="Default select example">
                            <option selected value="nama">Nama</option>
                            <option value="kategori">Kategori</option>
                            <option value="deskripsi">Deskripsi</option>
                        </select>
                        <?php if (isset($_GET['nama'])) {
                            $det = $_GET['nama'];
                        } else {
                            $det = "";
                        } ?>
                        <input name="cari1" id="cari1" class="form-control" type="search" placeholder="Search" value="<?= $det ?>">
                        <div class="input-group-text">
                            <i class='fa-solid fa-magnifying-glass'></i>
                        </div>
                    </div>
                </div>
                <div class="buttons d-flex flex-column">
                    <a href="../pdf/pdf_hardware.php" class="btn btn-danger my-auto">PDF Report <i class="fa-regular fa-file-pdf ms-2"></i></a>
                    <a href='crud/form/tambah_hardware.php' class='text-decoration-none btn btn-primary my-auto'>Tambah</a>
                </div>
            </div>
            <div class="tableku">
            </div>
        </div>
    </section>
    <?php
    include "../assets/shortcut/link.php";
    ?>
    <script>
        $(document).ready(function() {
            load_data();

            function load_data(sort1, sort2, cari1, cari2, page, limit) {
                $.ajax({
                    method: "POST",
                    url: "crud/data_hardware.php",
                    data: {
                        limit: limit,
                        page: page,
                        sort1: sort1,
                        sort2: sort2,
                        cari2: cari2,
                        cari1: cari1
                    },
                    success: function(hasil) {
                        $('.tableku').html(hasil);
                    }
                });
            }
            $('#cari1').keyup(function() {
                var sort1 = $("#sort1").val();
                var sort2 = $("#sort2").val();
                var cari1 = $("#cari1").val();
                var cari2 = $("#cari2").val();
                var limit = $("#limit").val();
                var page = $(".halaman").attr("id");
                load_data(sort1, sort2, cari1, cari2, page, limit);
            });
            $('#cari2').change(function() {
                var sort1 = $("#sort1").val();
                var sort2 = $("#sort2").val();
                var cari1 = $("#cari1").val();
                var cari2 = $("#cari2").val();
                var limit = $("#limit").val();
                var page = $(".halaman").attr("id");
                load_data(sort1, sort2, cari1, cari2, page, limit);
            });
            $('#sort1').change(function() {
                var sort1 = $("#sort1").val();
                var sort2 = $("#sort2").val();
                var cari1 = $("#cari1").val();
                var cari2 = $("#cari2").val();
                var limit = $("#limit").val();
                var page = $(".halaman").attr("id");
                load_data(sort1, sort2, cari1, cari2, page, limit);
            });
            $('#sort2').change(function() {
                var sort1 = $("#sort1").val();
                var sort2 = $("#sort2").val();
                var cari1 = $("#cari1").val();
                var cari2 = $("#cari2").val();
                var limit = $("#limit").val();
                var page = $(".halaman").attr("id");
                load_data(sort1, sort2, cari1, cari2, page, limit);
            });
            $('#limit').change(function() {
                var sort1 = $("#sort1").val();
                var sort2 = $("#sort2").val();
                var cari1 = $("#cari1").val();
                var cari2 = $("#cari2").val();
                var limit = $("#limit").val();
                var page = $(".halaman").attr("id");
                load_data(sort1, sort2, cari1, cari2, page, limit);
            });
            $(document).on('click', '.halaman', function() {
                var sort1 = $("#sort1").val();
                var sort2 = $("#sort2").val();
                var cari1 = $("#cari1").val();
                var cari2 = $("#cari2").val();
                var limit = $("#limit").val();
                var page = $(this).attr("id");
                load_data(sort1, sort2, cari1, cari2, page, limit);
            });
            var url = new URL(window.location.href);
            var nama = url.searchParams.get("nama");
            $("#cari1").val(nama);
            load_data("id_hardware", "ASC", nama, "nama", 1, 10);
        });
    </script>
</body>

</html>