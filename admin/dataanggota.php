<?php
include "../function.php"; // Sertakan file koneksi ke database

// Mulai session jika belum dimulai
session_start();

// Tangani pencarian jika ada
if (isset($_GET['cari'])) {
    $pencaharian = $_GET['cari'];
    $query = "SELECT * FROM user WHERE (UserID LIKE '%$pencaharian%' OR NamaLengkap LIKE '%$pencaharian%' OR Email LIKE '%$pencaharian%' OR Password LIKE '%$pencaharian%' OR Alamat LIKE '%$pencaharian%') ORDER BY UserID ASC";
} else {
    $query = "SELECT * FROM user ORDER BY UserID ASC";
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
                        <button class="btn btn-primary" onclick="window.location.href='buatlaporan.php'">Buat
                            Laporan</button>
                        <button class="btn btn-primary" onclick="window.location.href='pendataanbarang.php'">Pendataan
                            Barang</button>
                        <button class="btn1" onclick="window.location.href='dataanggota.php'">Data
                            Petugas</button>
                        <button class="btn btn-danger" onclick="window.location.href='../home.php'">Log
                            out</button>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <h2>DATA PETUGAS</h2>
    <div class="container">
        <form method="GET" action="dataanggota.php">
            <div class="search-bar">
                <label for="cari">Pencaharian:</label>
                <div class="input-group">
                    <input type="text" id="cari" name="cari" class="form-control" value="<?php echo isset($_GET['cari']) ? $_GET['cari'] : ''; ?>" placeholder="Cari...">
                    <button type="submit" class="btn btn-primary">Cari</button>
                </div>
            </div>
        </form>
        <button class="btn btn-primary" onclick="window.location.href='daftaranggota.html'">Buat Akun Petugas</button>
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>UserID</th>
                        <th>Nama Lengkap</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Alamat</th>
                        <th>Role</th>
                        <th class="table-actions">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($data = mysqli_fetch_array($tampil)) {
                        $UserID = $data['UserID'];
                        $NamaLengkap = $data['NamaLengkap'];
                        $Email = $data['Email'];
                        $Password = $data['Password'];
                        $Alamat = $data['Alamat'];
                        $level = $data['level'];
                    ?>
                        <tr>
                            <td><?= $UserID; ?></td>
                            <td><?= $NamaLengkap; ?></td>
                            <td><?= $Email; ?></td>
                            <td><?= $Password; ?></td>
                            <td><?= $Alamat; ?></td>
                            <td><?= $level; ?></td>
                            <td>
                                <button class="btn btn-sm btn-primary" onclick="window.location.href='editanggota.php?UserID=<?= $UserID; ?>'">Edit</button>
                                <button class="btn btn-sm btn-danger" onclick="hapusData(<?= $UserID; ?>)">Hapus</button>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function hapusData(UserID) {
            if (confirm('Apakah Anda yakin ingin menghapus buku ini?')) {
                window.location.href = 'hapusAnggota.php?UserID=' + UserID;
            }
        }
    </script>
</body>

</html>