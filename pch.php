<?php
include "function.php"; // Sertakan file koneksi ke database

// Mulai session jika belum dimulai
session_start();

// Tangani pencarian jika ada
if (isset($_GET['cari'])) {
    $pencaharian = $_GET['cari'];
    $query = "SELECT * FROM buku WHERE BukuID LIKE '%$pencaharian%' OR Judul LIKE '%$pencaharian%' OR Penulis LIKE '%$pencaharian%' OR Penerbit LIKE '%$pencaharian%' ORDER BY BukuID ASC";
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa;
            color: #495057;
            font-family: Arial, sans-serif;
            margin: 0;
            padding-top: 100px;
        }

        .navbar-box {
            background-color: #ffffff;
            padding: 10px;
            border-bottom: 3px solid #ddd;
            position: absolute;
            width: 100%;
            top: 0;
        }

        .navbar-logo {
            max-height: 40px;
            margin-right: 10px;
        }

        .profile-container {
            text-align: center;
            margin-top: 5%;
        }

        .profile-image {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            margin-right: 5px;
        }

        .container {
            max-width: 90%;
            margin-left: 5%;
            margin-right: 5%;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        table {
            width: 100%;
        }

        button {
            padding: 5px 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        .navbar-collapse {
            display: flex;
            justify-content: flex-end;
        }

        .navbar-brand {
            margin-right: auto;
        }

        .search-text {
            margin-right: 10px;
            /* Adjust the spacing between text and input */
        }

        .table-container {
            width: 100%;
            overflow-x: auto;
            /* Add horizontal scroll if the table overflows */
        }

        .search-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-box">
        <div class="container-fluid">
            <img src="img/Book.png" alt="Logo" class="navbar-logo">
            <a class="navbar-brand" href="home.php">Perpustakaan Digital</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div class="d-flex align-items-center ms-auto">
                    <div class="flex-grow-1"></div>
                    <form method="GET" action="pch.php" class="input-group">
                        <input type="text" id="cari" name="cari" class="form-control" value="<?php echo isset($_GET['cari']) ? $_GET['cari'] : ''; ?>" placeholder="Cari...">
                    </form>
                    <div class="login ms-2">
                        <div class="btn-group">
                            <button class="btn btn-primary" onclick="window.location.href='login.html';">Login</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <div class="container">
        <form method="GET" action="pch.php">
            <div class="search-bar">
                <div class="input-group">
                    <input type="text" id="cari" name="cari" class="form-control" value="<?php echo isset($_GET['cari']) ? $_GET['cari'] : ''; ?>" placeholder="Cari...">
                    <button type="submit" class="btn btn-primary">Cari</button>
                </div>
            </div>
        </form>
        <table class="bookTable">
            <thead>
                <tr>
                    <th>Buku ID</th>
                    <th>Nama Buku</th>
                    <th>Penulis</th>
                    <th>Penerbit</th>
                    <th>Gambar</th>
                    <th>Deskripsi</th>
                    <th>Koleksi</th>
                    <th class="table-actions">Aksi</th>
                </tr>
            </thead>
            <tbody class="tbl">
                <?php
                while ($data = mysqli_fetch_array($tampil)) {
                    $BukuID = $data['BukuID'];
                    $NamaBuku = $data['Judul'];
                    $Penulis = $data['Penulis'];
                    $Penerbit = $data['Penerbit'];
                    $Gambar = $data['gambar'];
                    $Deskripsi = $data['Deskripsi'];
                ?>
                    <tr>
                        <td><?= $BukuID; ?></td>
                        <td><?= $NamaBuku; ?></td>
                        <td><?= $Penulis; ?></td>
                        <td><?= $Penerbit; ?></td>
                        <td><img src="<?= $Gambar; ?>" style="width: 100px; height: auto;"></td>
                        <td><?= $Deskripsi; ?></td>
                        <td><button class="btn btn-sm btn-primary" onclick="window.location.href='daftar.html'">Koleksi</button>
                        <td><button onclick="goToPinjamPage()">Buka</button></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

    <script>
        function goToPinjamPage() {
            window.location.href = 'daftar.html';
        }
    </script>

</body>

</html>