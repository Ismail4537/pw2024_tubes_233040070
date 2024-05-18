<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style/base.css">
    <link rel="stylesheet" href="assets/style/form.css">
    <link rel="stylesheet" href="assets/style/bootstrap.min.css">
    <title>GaleryTek | Form Register</title>
</head>

<body>
    <?php include "assets/shortcut/nav_out.php"; ?>
    <section class="main">
        <form action="aksi/aksi_register.php" class="border rounded mx-5" method="post">
            <h2 class="title rounded-top text-center text-white pb-2">Form Register</h2>
            <?php
            session_start();
            if (isset($_SESSION['gagal'])) {
                echo "<div class='alert alert-danger m-auto mx-5' role='alert'>" . $_SESSION['gagal'] . "</div>";
                unset($_SESSION['gagal']);
            }
            session_destroy();
            ?>
            <div class="form d-flex m-2 flex-column">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Username</span>
                    <input type="text" name="username" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" required>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Email</span>
                    <input type="email" name="email" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="basic-addon1" required>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Password</span>
                    <input type="password" name="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1" required>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Confirmasi Password</span>
                    <input type="password" name="password2" class="form-control" placeholder="Confirmasi Password" aria-label="Confirmasi Password" aria-describedby="basic-addon1" required>
                </div>
                <input type="submit" class="btn btn-primary mx-auto" value="Register" name="save">
            </div>
        </form>
        <center>
            <a href="login.php">sudah punya akun? Login disini</a>
        </center>
    </section>
    <?php
    include "assets/shortcut/link.php";
    ?>
</body>

</html>