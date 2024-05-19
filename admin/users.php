<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../assets/style/gambar/Tek.png">
    <link rel="stylesheet" href="../assets/style/base.css">
    <link rel="stylesheet" href="../assets/style/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/style/index.css">
    <title>GaleryTek | Data User</title>
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
    include "../assets/function/function.php";
    if ($tampil_user['role'] != "super admin") {
        header("location:index.php?=anda_bukan_super_admin");
    }
    ?>
    <header class="d-flex align-content-center justify-content-center flex-column text-center" style="height: 100vh; color: black;">
        <h4><img class="TEK" src="../assets/style/gambar/Tek.png" alt="Tek" width="100px"></h4>
        <h1>GaleryTek | Data Users</h1>
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
        <div class="data m-auto my-1">
            <div class="ultility d-flex m-3 justify-content-between">
                <div class="d-flex flex-column">
                    <div class="d-flex">
                        <div class="d-flex me-2 form-floating mb-2">
                            <select name="sort1" id="sort1" class="form-select select" aria-label="Default select example">
                                <option selected value="id">Id</option>
                                <option value="username">Username</option>
                                <option value="role">Role</option>
                                <option value="email">Email</option>
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
                    </div>
                    <div class="input-group my-auto">
                        <select name="cari2" id="cari2" class="form-select mx-auto select" aria-label="Default select example">
                            <option selected value="username">Username</option>
                            <option value="role">Role</option>
                            <option value="email">Email</option>
                        </select>
                        <input name="cari1" id="cari1" class="form-control" type="search" placeholder="Search">
                        <div class="input-group-text">
                            <i class='fa-solid fa-magnifying-glass'></i>
                        </div>
                    </div>
                </div>
                <div class="buttons d-flex flex-column">
                    <a href="../pdf/pdf_users.php" class="btn btn-danger my-auto">PDF Report <i class="fa-regular fa-file-pdf ms-2"></i></a>
                </div>
            </div>
            <table class="text-center table table-bordered table-hover table-responsive table-sm tableku">
            </table>
        </div>
    </section>
    <?php
    include "../assets/shortcut/link.php";
    ?>
    <script>
        $(document).ready(function() {
            load_data();
            // membuat fungsi load_data
            function load_data(sort1, sort2, cari1, cari2) {
                $.ajax({
                    method: "POST",
                    url: "crud/data_users.php",
                    data: {
                        sort1: sort1,
                        sort2: sort2,
                        cari2: cari2,
                        cari1: cari1
                    },
                    // jika berhasil
                    success: function(hasil) {
                        $('.tableku').html(hasil);
                    }
                });
            }
            // membuat event ketika input cari1 di isi
            $('#cari1').keyup(function() {
                var sort1 = $("#sort1").val();
                var sort2 = $("#sort2").val();
                var cari1 = $("#cari1").val();
                var cari2 = $("#cari2").val();
                load_data(sort1, sort2, cari1, cari2);
            });
            // membuat event ketika input cari2 di ubah
            $('#cari2').change(function() {
                var sort1 = $("#sort1").val();
                var sort2 = $("#sort2").val();
                var cari1 = $("#cari1").val();
                var cari2 = $("#cari2").val();
                load_data(sort1, sort2, cari1, cari2);
            });
            $('#sort1').change(function() {
                var sort1 = $("#sort1").val();
                var sort2 = $("#sort2").val();
                var cari1 = $("#cari1").val();
                var cari2 = $("#cari2").val();
                load_data(sort1, sort2, cari1, cari2);
            });
            $('#sort2').change(function() {
                var sort1 = $("#sort1").val();
                var sort2 = $("#sort2").val();
                var cari1 = $("#cari1").val();
                var cari2 = $("#cari2").val();
                load_data(sort1, sort2, cari1, cari2);
            });
        });
    </script>
</body>

</html>