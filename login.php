<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/style/gambar/Tek.png">
    <link rel="stylesheet" href="assets/style/base.css">
    <link rel="stylesheet" href="assets/style/form.css">
    <link rel="stylesheet" href="assets/style/bootstrap.min.css">
    <title>GaleryTek | Form Login</title>
</head>

<body>
    <?php
    session_start();
    if (isset($_SESSION['status']) and $_SESSION['status'] == "login") {
        header("location:admin/index.php");
    }
    include "assets/shortcut/nav_out.php";
    ?>
    <section class="main">
        <form action="aksi/aksi_login.php" class="border rounded mb-0" style="margin-top: 100px;" method="post">
            <h2 class="title rounded-top text-center text-white pb-2">Form Login</h2>
            <?php
            if (isset($_SESSION['gagal'])) {
                echo "<div class='alert alert-danger m-auto mx-5' role='alert'>" . $_SESSION['gagal'] . "</div>";
                unset($_SESSION['gagal']);
            } else if (isset($_SESSION['berhasil'])) {
                echo "<div class='alert alert-success m-auto mx-5' role='alert'>" . $_SESSION['berhasil'] . "</div>";
                unset($_SESSION['berhasil']);
            }
            ?>
            <div class="form d-flex m-2 flex-column">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Username/Email</span>
                    <input type="text" name="user" class="form-control" placeholder="Username/email" aria-label="Username/email" aria-describedby="basic-addon1">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Password</span>
                    <input type="password" name="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1">
                </div>
                <input type="submit" class="btn btn-primary mx-auto" value="Login" name="save">
            </div>
        </form>
        <center>
            <a href="register.php">belum punya akun? Register disini</a>
        </center>
    </section>
    <?php
    include "assets/shortcut/link.php";
    ?>
</body>

</html>