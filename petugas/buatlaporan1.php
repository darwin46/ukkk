<?php
include "../function.php"; // Sertakan file koneksi ke database

// Mulai session jika belum dimulai
session_start();

// Tangani pencarian jika ada
if (isset($_GET['cari'])) {
    $pencaharian = $_GET['cari'];
    $query = "SELECT * FROM buku WHERE BukuID LIKE '%$pencaharian%' OR Judul LIKE '%$pencaharian%' OR Penulis LIKE '%$pencaharian%' OR Penerbit LIKE '%$pencaharian%' OR TahunTerbit LIKE '%$pencaharian%' ORDER BY BukuID ASC";
} else {
    $query = "SELECT * FROM buku ORDER BY BukuID ASC";
}

$tampil = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan Digital</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            color: #495057;
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 75%;
            margin-left: 5%;
            margin-right: 5%;
        }

        h2 {
            text-align: center;
            margin-top: 3%;
        }

        .table-container {
            margin-top: 20px;
            width: 120%;
        }

        .table-actions {
            width: 120px;
        }

        .dropdown-container {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 20px;
        }

        .search-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .search-bar label {
            margin-right: 30px;
        }


        .navbar-box {
            background-color: #ffffff;
            padding: 10px;
            border-bottom: 3px solid #ddd;
        }

        .navbar-logo {
            max-height: 40px;
            margin-right: 10px;
        }

        .btn1 {
            background-color: #52a5fe;
            color: #fff;
            border: 1px solid #52a5fe;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            border-radius: 0.25rem;
            cursor: pointer;
        }

        .btn1:hover {
            background-color: #0056b3;
            border-color: #0056b3;
            color: #fff;
        }

        .navbar .ms-2 {
            display: flex;
            align-items: center;
        }

        .navbar .ms-2 .btn {
            margin-right: 20px;
        }

        .navbar .ms-2 .btn1 {
            margin-right: 20px;
            /* Memberikan jarak 20px di sebelah kanan tombol "Pendataan Barang" */
        }

        .Tbuku {
            margin-left: 5%;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-box sticky-top">
        <div class="container-fluid">
            <img src="img/Book.png" alt="Logo" class="navbar-logo">
            <a class="navbar-brand" href="admin.html">Perpustakaan Digital</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div class="d-flex align-items-center ms-auto">
                    <div class="flex-grow-1"></div>
                    <div class="ms-2">
                        <button class="btn1" onclick="window.location.href='buatlaporan1.php'">Buat
                            Laporan</button>
                        <button class="btn btn-primary" onclick="window.location.href='pendataanbarang1.php'">Pendataan
                            Barang</button>
                        <button class="btn btn-primary" onclick="window.location.href='dataanggota.php'">Data
                            Anggota</button>
                        <button class="btn btn-danger" onclick="window.location.href='../home.php'">Log
                            out</button>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <h2>BUAT LAPORAN</h2>
    <div class="container">
        <form method="GET" action="buatlaporan1.php">
            <div class="search-bar">
                <label for="cari">Pencaharian:</label>
                <div class="input-group">
                    <input type="text" id="cari" name="cari" class="form-control" value="<?php echo isset($_GET['cari']) ? $_GET['cari'] : ''; ?>" placeholder="Cari...">
                </div>
            </div>
            <div class="table-container">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Buku ID</th>
                            <th>Nama Buku</th>
                            <th>Penulis</th>
                            <th>Penerbit</th>
                            <th>TahunTerbit</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($data = mysqli_fetch_array($tampil)) {
                            $BukuID = $data['BukuID'];
                            $NamaBuku = $data['Judul'];
                            $Penulis = $data['Penulis'];
                            $Penerbit = $data['Penerbit'];
                            $TahunTerbit = $data['TahunTerbit'];
                            $Status = $data['status'];
                            $TanggalHariIni = $data['TanggalHariIni'];
                            
                            $StatusTanggal = $Status . ($TanggalHariIni ? " " . $TanggalHariIni : "");
                            
                        ?>
                            <tr>
                                <td><?= $BukuID; ?></td>
                                <td><?= $NamaBuku; ?></td>
                                <td><?= $Penulis; ?></td>
                                <td><?= $Penerbit; ?></td>
                                <td><?= $TahunTerbit; ?></td>
                                <td><?= $StatusTanggal; ?></td>
                            </tr>
                        <?php
                        };
                        ?>
                    </tbody>
                </table>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <div style="text-align: center; margin-bottom: 20px;">
        <br>
        <a href="cetak.php" target="_blank">cetak</a>
    </div>
</body>

</html>