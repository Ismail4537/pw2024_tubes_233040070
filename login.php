<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style/base.css">
    <link rel="stylesheet" href="assets/style/form.css">
    <link rel="stylesheet" href="assets/style/bootstrap.min.css">
    <link rel="stylesheet" href="http://localhost/pw2024_tubes_233040070/admin/assets/plugins/fontawesome-free-6.5.2-web/css/all.css">
    <title>GaleryTek | Form Login</title>
</head>

<body>
    <?php include "assets/shortcut/nav_out.php"; ?>
    <section class="main">
        <form action="aksi/aksi_login.php" class="border rounded mx-5" method="post">
            <h2 class="title rounded-top text-center text-white pb-2">Form Login</h2>
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