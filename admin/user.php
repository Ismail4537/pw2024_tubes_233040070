<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="style/gambar/Tek.png">
    <link rel="stylesheet" href="style/base.css">
    <link rel="stylesheet" href="style/profile.css">
    <link rel="stylesheet" href="style/fontawesome-free/css/all.css">
    <link rel="stylesheet" href="style/bootstrap.min.css">
    <title>GaleryTek | Profile</title>
</head>

<body>
    <?php
    include "nav.php";
    ?>
    <section class="main mt-5" style="height: 100vh;">
        <div class="data d-flex flex-column border rounded text-center">
            <h2 class="rounded-top text-white p-1">Profil</h2>
            <div class="container d-flex">
                <div class="d-inline-flex flex-column text-center p-2 me-3">
                    <h4>Gambar Profil</h4>
                    <img class="mx-auto mb-2 mt-0 border rounded-circle" src="style/gambar/Profile_picture.png" alt="style/gambar/Profile_picture.png" width="200px" height="200px">
                </div>
                <div class="main_form m-auto" style="width: 100%;">
                    <div class="input-group my-3">
                        <span class="input-group-text" id="addon-wrapping">Nama</span>
                        <input name="nama" type="text" value="AAA" class="form-control" placeholder="Nama" aria-label="Nama" aria-describedby="addon-wrapping" readonly>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="addon-wrapping">Email</span>
                        <input name="email" type="email" value="AAAA@gmail.com" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="addon-wrapping" readonly>
                    </div>
                    <div class="d-flex justify-content-between flex-row-reverse">
                        <a href="" class="btn btn-primary">Edit Profil</a>
                        <a href="" class="btn btn-danger">Hapus Profil</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
    include "link.php";
    ?>
</body>

</html>