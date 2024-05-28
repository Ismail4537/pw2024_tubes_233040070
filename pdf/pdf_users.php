<?php
require '../assets/function/function.php';
session_start();
if ($_SESSION['status'] != "login") {
    echo "Anda belum login";
    return;
}
$koneksi = koneksi();
$user = $_SESSION['user'];
$data_user = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$user' or email='$user'");
$tampil_user = mysqli_fetch_array($data_user);
if ($tampil_user['role'] != "super admin") {
    echo "Anda bukan super admin";
    return;
}
require_once '../vendor/autoload.php';

$query = query("SELECT * FROM user");

$mpdf = new \Mpdf\Mpdf();

$html =
    '<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/style/pdf.css">
    <title>GaleryTek</title>
</head>

<body>
    <div class="m-5">
    <table>
        <tr>
            <td>
                <h3>GaleryTek | Data Users</h3>
                <h2>' . date('d/m/Y') . '</h2>
            </td>
            <td style="text-align: right;">
                <img src="../assets/style/gambar/Tek.png" alt="" width="150px">
            </td>
        </tr>
    </table>
        <table width="100%" class="table table-striped">
            <thead>
            <tr>
                <th width="8%">#</th>
                <th width="20%">Gambar</th>
                <th>Username</th>
                <th width="20%">Role</th>
                <th>Password</th>
            </tr>
            </thead>
            <tbody>';
$no = 1;
while ($tampil = mysqli_fetch_array($query)) {
    if ($tampil['gambar']) {
        $gambar = $tampil['gambar'];
    } else {
        // jika tidak ada gambar
        $gambar = "Profile_picture.png";
    }
    $html .= '
                    <tr>
                        <th>' . $no++ . '</th>
                        <td>
                            <img width="114px" height="114px" src="../admin/crud/recource/gambar_profile/' . $gambar . '" alt="' . $tampil['gambar'] . '">
                        </td>
                        <td>' . $tampil['username'] . '</td>
                        <td>' . $tampil['role'] . '</td>
                        <td>' . $tampil['password'] . '</td>
                    </tr>';
}
$html .= '
            </tbody>
        </table>
    </div>
</body>

</html>
';
$mpdf->WriteHTML($html);
$mpdf->Output('GaleryTek - Data Users.pdf', \Mpdf\Output\Destination::DOWNLOAD);
