<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../assets/style/gambar/Tek.png">
    <link rel="stylesheet" href="../../assets/style/base.css">
    <link rel="stylesheet" href="../../assets/style/form.css">
    <link rel="stylesheet" href="http://localhost/pw2024_tubes_233040070/admin/assets/plugins/fontawesome-free-6.5.2-web/css/all.css">
    <link rel="stylesheet" href="../../assets/style/bootstrap.min.css">
    <title>GaleryTek | Form Edit Profile</title>
</head>

<body>
    <?php
    include "../../assets/shortcut/nav.php";
    ?>
    <section class="main" style="height:100%;">
        <?php
        $id = $_GET["id"];
        $query = mysqli_query($koneksi, "SELECT * FROM user WHERE id='$id'");
        while ($tampil = mysqli_fetch_array($query)) {
            if ($tampil_user['role'] == "admin") {
                if ($tampil_user['username'] != $tampil['username']) {
                    header("location:index.php?=anda_bukan_super_admin");
                }
            }
            if ($tampil['gambar']) {
                $gambar = $tampil['gambar'];
            } else {
                $gambar = "Profile_picture.png";
            }
        ?>
            <form action="../aksi/aksi_edit_profile.php" method="post" enctype="multipart/form-data" class="d-flex flex-column border rounded text-center mx-5">
                <h2 class="title rounded-top text-white p-1">Form Edit Profile</h2>
                <?php
                if (isset($_SESSION['gagal'])) {
                    echo "<div class='alert alert-danger m-auto' role='alert'>" . $_SESSION['gagal'] . "</div>";
                    unset($_SESSION['gagal']);
                }
                ?>
                <input type="text" name="id" value="<?php echo $tampil["id"]; ?>" hidden readonly>
                <div class="aha d-flex m-2" style="width:auto;">
                    <div class="border d-inline-flex flex-column text-center p-2 justify-content-center">
                        <h4>Gambar lama</h4>
                        <img class="mx-auto mb-2 mt-0" src="<?php echo "http://localhost/pw2024_tubes_233040070/admin/crud/recource/gambar_profile/" . $gambar ?>" alt="<?php if ($tampil['gambar']) {
                                                                                                                                                                            echo $tampil['gambar'];
                                                                                                                                                                        } else {
                                                                                                                                                                            echo "Tidak_ada_gambar";
                                                                                                                                                                        } ?>">
                    </div>
                    <div class="text-start ms-2" style="width:100%;">
                        <span>Username</span>
                        <div class="mb-2">
                            <input name="username" value="<?php echo $tampil['username']; ?>" type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="addon-wrapping" required>
                        </div>
                        <span>Email</span>
                        <div class="mb-2">
                            <input name="email" value="<?php echo $tampil['email']; ?>" type="email" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="addon-wrapping" required>
                        </div>
                        <label>Gambar Baru</label>
                        <div class="input-group mb-2">
                            <div class="input-group-text">
                                <input class="form-check-input" type="checkbox" name="upt" value="true">
                            </div>
                            <input name="gambaru" type="file" class="form-control" id="gambar">
                        </div>
                        <hr>
                        Ganti password <input class="form-check-input" type="checkbox" name="ps" value="true">
                        <br>
                        <span>Password Baru</span>
                        <div class="mb-2">
                            <input name="password" type="Password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="addon-wrapping">
                        </div>
                        <span>Confirmasi Password</span>
                        <div class="mb-2">
                            <input name="password2" type="Password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="addon-wrapping">
                        </div>
                        <?php
                        if ($tampil_user['role'] == "super admin") {
                            echo
                            "
                            <hr>
                        <span>Ganti Role </span><input class='form-check-input' type='checkbox' name='r_change' value='true'>
                        <div class='mb-2'>
                            <select name='roleNew' class='form-select' aria-label='Default select example'>
                                <option selected value='" . $tampil["role"] . "'>" . $tampil["role"] . "</option>
                                <option value='admin'>admin</option>
                                <option value='super admin'>super admin</option>
                            </select>
                        </div>
                            ";
                        }

                        ?>

                        <div class="d-grid">
                            <input type="submit" value="Edit" name="save" class="btn btn-primary mx-5 mb-3 rounded-pill">
                        </div>
                    </div>
                </div>
            </form>
        <?php } ?>
    </section>
    <?php
    include "../../assets/shortcut/link.php";
    ?>
</body>

</html>