<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/style/gambar/Tek.png">
    <link rel="stylesheet" href="assets/style/base.css">
    <link rel="stylesheet" href="assets/style/bootstrap.min.css">
    <link rel="stylesheet" href="assets/style/user.css">
    <title>GaleryTek | Harga</title>
    <!-- <style>
        * {
            border: 1px solid red;
        }
    </style> -->
</head>

<body>
    <?php
    session_start();
    if (isset($_SESSION['gagal'])) {
        if (!isset($_SESSION['status']) and $_SESSION['status'] != "login") {
            echo "<script>alert('" . $_SESSION['gagal'] . "')</script>";
        }
        unset($_SESSION['gagal']);
    }
    if (isset($_SESSION['status']) and $_SESSION['status'] == "login") {
        include "assets/shortcut/nav.php";
    } else {
        include "assets/shortcut/nav_out.php";
    }
    include "assets/function/function.php";
    ?>
    <header class="d-flex align-content-center justify-content-center flex-column text-center" style="height: 100vh; color: black;">
        <h4><img class="TEK" src="assets/style/gambar/Tek.png" alt="Tek" width="100px"></h4>
        <h1>GaleryTek | Harga</h1>
        <br>
        <p class="mx-4">GaleryTek adalah sebuah galery teknologi dimana berfungsi sebagai platform untuk merekomendasikan berbagai jenis Hardware komputer dalam bentuk gambar, harga, dan deskripsinya dengan tanggal rekapan harganya</p>
    </header>
    <section class="main d-flex flex-column p-1" id="main">
        <div class="data m-auto">
            <div class="ultility d-flex my-3">
                <div class="d-flex flex-column">
                    <div class="d-flex">
                        <div class="d-flex me-2 form-floating mb-2">
                            <select name="sort1" id="sort1" class="form-select select" aria-label="Default select example">
                                <option selected value="id_harga">Id</option>
                                <option value="avg_price">Harga rata-rata</option>
                                <option value="tanggal">Tanggal Rekap</option>
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
                            <select name="limit" id="limit" class="form-select select" aria-label="Default select example">
                                <option selected value="6">6</option>
                                <option value="12">12</option>
                                <option value="24">24</option>
                            </select>
                            <label for="limit" class="select">Limit</label>
                        </div>
                    </div>
                    <div class="input-group my-auto">
                        <select name="cari2" id="cari2" class="form-select mx-auto select" aria-label="Default select example">
                            <option selected value="hardware.nama">Hardware</option>
                            <option value="hardware.kategori">Kategori</option>
                            <option value="harga.avg_price">Harga rata-rata</option>
                            <option value="harga.tanggal">Tanggal Rekap</option>
                        </select>
                        <input name="cari1" id="cari1" class="form-control" type="search" placeholder="Search">
                        <div class="input-group-text">
                            <i class='fa-solid fa-magnifying-glass'></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tableku">
            </div>
            <!-- <button id="page">AAA</button> -->
        </div>
    </section>
    <?php
    include "assets/shortcut/link.php";
    ?>
    <script>
        $(document).ready(function() {
            load_data();

            function load_data(sort1, sort2, cari1, cari2, page, limit) {
                $.ajax({
                    method: "POST",
                    url: "data/data_harga.php",
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
        });
    </script>
</body>

</html>