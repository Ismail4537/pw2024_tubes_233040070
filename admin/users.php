<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../assets/style/gambar/Tek.png">
    <link rel="stylesheet" href="../assets/style/base.css">
    <link rel="stylesheet" href="../assets/style/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/plugins/fontawesome-free-6.5.2-web/css/all.css">
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
        <h4><img src="../assets/style/gambar/Tek.png" alt="Tek" width="100px"></h4>
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
            <div class="ultility d-flex justify-content-between m-3">
                <div class="d-flex" role="search">
                    <input class="form-control me-2" class="cari" type="text" placeholder="Search" name="cari" id="cari" aria-label="Search">
                    <i class='fa-solid fa-magnifying-glass my-auto'></i>
                </div>
                <div class="buttons">
                    <a href="" class="btn btn-danger">PDF Report <i class="fa-regular fa-file-pdf ms-2"></i></a>
                </div>
            </div>
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
                $data = query("SELECT * FROM user");
                // inisialisasi variabel no untuk urutan data
                $no = 1;
                // menampilkan data dari database
                while ($tampil = mysqli_fetch_array($data)) {
                    // mengecek apakah ada gambar
                    if ($tampil['gambar']) {
                        $gambar = $tampil['gambar'];
                    } else {
                        // jika tidak ada gambar
                        $gambar = "Profile_picture.png";
                    }
                ?>
                    <tr>
                        <th class="align-content-center" scope="row"><?= $no++; ?></th>
                        <td class="align-content-center">
                            <img class="rounded-circle" src="crud/recource/gambar_profile/<?= $gambar ?>" alt="<?= $gambar ?>">
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
        </div>
    </section>
    <?php
    include "../assets/shortcut/link.php";
    ?>
    <script>
        $(document).ready(function() {
            $("body").on("change keyup keydown", "#cari", function() {
                var cari = $(this).val();
                var data = "cari=" + cari;
                // alert(data);
                $.ajax({
                    method: 'POST',
                    url: 'crud/data_users.php',
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