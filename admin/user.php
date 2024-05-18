<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../assets/style/gambar/Tek.png">
    <link rel="stylesheet" href="../assets/style/base.css">
    <link rel="stylesheet" href="../assets/style/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/style/profile.css">
    <title>GaleryTek | Profile</title>
</head>

<body>
    <?php
    include "../assets/shortcut/nav.php";
    include "../assets/function/function.php";
    if (isset($_GET['id'])) {
        $getId = $_GET['id'];
        $query = query("SELECT * FROM user WHERE id='$getId'");
        while ($tampil = mysqli_fetch_assoc($query)) {
            $username = $tampil['username'];
            $password = $tampil['password'];
            $email = $tampil['email'];
            $role = $tampil['role'];
            $userId = $tampil['id'];
            if ($tampil['gambar']) {
                $gambar_profile = $tampil['gambar'];
            } else {
                $gambar_profile = "Profile_picture.png";
            }
        }
    } else {
        $username = $tampil_user['username'];
        $password = $tampil_user['password'];
        $email = $tampil_user['email'];
        $role = $tampil_user['role'];
        $userId = $tampil_user['id'];
    }
    ?>
    <section class="main mt-5" style="height: 100vh;">
        <div class="data d-flex flex-column border rounded text-center">
            <h2 class="rounded-top text-white p-1">Profil</h2>
            <div class="container d-flex">
                <div class="d-inline-flex flex-column text-center p-2 me-3">
                    <h4>Gambar Profil</h4>
                    <img class="mx-auto mb-2 mt-0 border rounded-circle" src="crud/recource/gambar_profile/<?= $gambar_profile ?>" alt="../assets/style/gambar/Profile_picture.png" width="200px" height="200px">
                </div>
                <div class="main_form m-auto" style="width: 100%;">
                    <div class="input-group my-3">
                        <span class="input-group-text" id="addon-wrapping">Nama</span>
                        <input type="text" value="<?= $username ?>" class="form-control" placeholder="Nama" aria-label="Nama" aria-describedby="addon-wrapping" readonly>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="addon-wrapping">Email</span>
                        <input type="email" value="<?= $email ?>" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="addon-wrapping" readonly>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="addon-wrapping">Role</span>
                        <input type="text" value="<?= $role ?>" class="form-control" placeholder="Role" aria-label="Role" aria-describedby="addon-wrapping" readonly>
                    </div>
                    <?php
                    if ($tampil_user['role'] == "super admin") {
                        echo
                        "
                        <div class='input-group mb-3'>
                        <span class='input-group-text' id='addon-wrapping'>Password(MD5)</span>
                        <input type='text' value='" . $password . "' class='form-control' placeholder='Password' aria-label='Password' aria-describedby='addon-wrapping' readonly>
                    </div>
                        ";
                    }
                    ?>
                    <div class="d-flex justify-content-between flex-row-reverse mb-2">
                        <?php
                        if ($tampil_user['username'] == $username or $tampil_user["role"] == "super admin") {
                            echo "<a href='crud/form/edit_profile.php?id=" . $userId . "' class='btn btn-primary'>Edit Profil</a>";
                        }
                        if ($tampil_user['username'] == $username or $tampil_user["role"] == "super admin") {
                            echo "<a href='crud/aksi/hapus_profile.php?id=" . $userId . "' class='btn btn-danger' onclick='return confirm(`Anda yakin mau menghapus akun ini ?`)'>Hapus Profil</a>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
    include "../assets/shortcut/link.php";
    ?>
</body>

</html>