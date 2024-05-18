<?php

require_once '../vendor/autoload.php';

require '../assets/function/function.php';
$query = query("SELECT * FROM harga INNER JOIN hardware ON harga.id_hardware = hardware.id_hardware");

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
                    <th width="8%">#</th>
                    <th>Hardware</th>
                    <th>Harga rata-rata</th>
                    <th width="15%">Tanggal Rekap</th>
                </tr>
            </thead>
            <tbody>';
$no = 1;
while ($tampil = mysqli_fetch_array($query)) {
    $date = date_create($tampil['tanggal']);
    $html .= '
                    <tr>
                        <th>' . $no++ . '</th>
                        <td>' . $tampil['nama'] . '</td>
                        <td>Rp,' . number_format($tampil['avg_price'], 0, '', '.') . ',00</td>
                        <td>' . date_format($date, "d/m/Y") . '</td>
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
$mpdf->Output('GaleryTek - Data Harga.pdf', \Mpdf\Output\Destination::DOWNLOAD);
