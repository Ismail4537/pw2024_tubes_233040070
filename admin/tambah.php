<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/base.css">
    <link rel="stylesheet" href="style/form.css">
    <link rel="stylesheet" href="style/nav.css">
    <link rel="stylesheet" href="style/bootstrap.min.css">
    <title>GaleryTek | Form Tambah</title>
    <style>
    </style>
</head>

<body>
    <nav class="navbar bg-dark border-bottom border-body position-fixed" data-bs-theme="dark">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1">Navbar</span>
        </div>
    </nav>
    <div class="main">
        <form action="aksi_tambah.php" method="post" enctype="multipart/form-data" class="d-flex flex-column border rounded text-center">
            <h2 class="rounded-top text-white p-1">Form Tambah Data</h2>
            <table class="table table-responsive table-sm">
                <tr>
                    <td class="input-group flex-nowrap">
                        <span class="input-group-text" id="addon-wrapping">Nama</span>
                        <input name="nama" type="text" class="form-control" placeholder="Nama" aria-label="Nama" aria-describedby="addon-wrapping">
                    </td>
                </tr>
                <tr>
                    <td class="input-group flex-nowrap">
                        <span class="input-group-text" id="addon-wrapping">Deskripsi</span>
                        <input name="deskripsi" type="text" class="form-control" placeholder="Deskripsi" aria-label="Deskripsi" aria-describedby="addon-wrapping">
                    </td>
                </tr>
                <tr>
                    <td class="input-group flex-nowrap">
                        <span class="input-group-text" id="addon-wrapping">Harga rata-rata pasaran(IDR)</span>
                        <input name="avg_price" type="text" class="form-control" placeholder="Harga rata-rata pasaran(IDR)" aria-label="Harga rata-rata pasaran(IDR)" aria-describedby="addon-wrapping">
                    </td>
                </tr>
                <tr>
                    <td class="input-group">
                        <label class="input-group-text" for="gambar">Gambar</label>
                        <input name="gambar" type="file" class="form-control" id="gambar">
                    </td>
                </tr>
            </table>
            <input type="submit" value="Tambah" name="save" class="btn btn-primary mx-5 mb-3 rounded-pill">
        </form>
    </div>
    <p class="text-center bg-black text-bg-dark mb-0 mt-5">&copy; 2024 - GaleryTek</p>
    <script src="script/bootstrap.min.js"></script>
</body>

</html>