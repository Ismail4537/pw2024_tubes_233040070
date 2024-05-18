<?php

require_once '../vendor/autoload.php';

require '../assets/function/function.php';
$query = query("SELECT * FROM hardware");

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
                <h3>GaleryTek | Data Harga</h3>
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
                <th class="align-content-center" width="8%">#</th>
                <th class="align-content-center" width="20%">Gambar</th>
                <th class="align-content-center">Nama</th>
                <th class="align-content-center" width="20%">Kategori</th>
                <th class="align-content-center">Deskripsi</th>
            </tr>
            </thead>
            <tbody>';
$no = 1;
while ($tampil = mysqli_fetch_array($query)) {
    $html .= '
                    <tr>
                        <th>' . $no++ . '</th>
                        <td>
                            <img width="114px" height="114px" src="../admin/crud/recource/gambar/' . $tampil['gambar'] . '" alt="' . $tampil['gambar'] . '">
                        </td>
                        <td>' . $tampil['nama'] . '</td>
                        <td>' . $tampil['kategori'] . '</td>
                        <td>' . $tampil['deskripsi'] . '</td>
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
$mpdf->Output('GaleryTek - Data Hardware.pdf', \Mpdf\Output\Destination::DOWNLOAD);
