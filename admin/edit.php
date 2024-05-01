<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/base.css">
    <title>GaleryTek | Form Edit</title>
</head>

<body>
    <?php
    $id = $_GET["id"];
    include "koneksi.php";
    $query = mysqli_query($koneksi, "SELECT * FROM user WHERE id='$id'");
    while ($tampil = mysqli_fetch_array($query)) {
    ?>
        <form action="aksi_edit.php" method="post" enctype="multipart/form-data">
            <table>
                <input type="text" name="id" id="" value="<?php echo $tampil["id"]; ?>" hidden readonly>
                <tr>
                    <td>Gambar lama</td>
                    <td>
                        <img src="gambar/<?php echo $tampil['gambar'] ?>" alt="">
                    </td>
                </tr>
                <tr>
                    <td>Nama</td>
                    <td><input value="<?php echo $tampil['nama']; ?>" type="text" name="nama"></td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td><input value="<?php echo $tampil['alamat']; ?>" type="text" name="alamat"></td>
                </tr>
                <tr>
                    <td>Gambar baru</td>
                    <td>
                        <input type="file" name="gambar" id="" value="<?php $tampil['gambar']; ?>">
                        </br><input type="checkbox" name="upt" value="true">ubah foto
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" value="Edit" name="save"></td>
                </tr>
            </table>
        </form>
    <?php } ?>
</body>

</html>