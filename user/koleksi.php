<?php
include "../function.php";

session_start();

if (isset($_GET['cari'])) {
    $pencaharian = $_GET['cari'];
    $query = "SELECT * FROM koleksipribadi WHERE KoleksiID LIKE '%$pencaharian%' OR Judul LIKE '%$pencaharian%' OR Status LIKE '%$pencaharian%' ORDER BY BukuID ASC";
} else {
    $query = "SELECT * FROM koleksipribadi ORDER BY KoleksiID ASC";
}

$tampil = mysqli_query($conn, $query);

if (!$tampil) {
    die('Error: ' . mysqli_error($conn));
}

// Tambahkan parameter $conn pada fungsi hapusData
function hapusData($conn, $BukuID)
{
    $query = "DELETE FROM koleksipribadi WHERE BukuID = $BukuID";
    $result = mysqli_query($conn, $query);
    if ($result) {
        echo "<script>alert('Data berhasil dihapus.'); window.location.href = 'koleksi.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus data.');</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Koleksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        .navbar-box {
            background-color: #ffffff;
            padding: 10px;
            border-bottom: 3px solid #ddd;
        }

        .navbar-logo {
            max-height: 40px;
            margin-right: 10px;
        }

        body {
            background-color: #f8f9fa;
        }

        .profile-container {
            text-align: center;
            margin-top: auto;
        }

        .profile-logo {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
        }

        .table1 {
            margin: 5%;
            margin-top: 20px;
            /* tambahkan margin top pada tabel */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            text-align: center;
            background-color: #f2f2f2;
        }

        .button-container {
            display: flex;
            justify-content: flex-end;
            /* ubah menjadi flex-end */
        }

        .button-container button {
            padding: 5px 10px;
            cursor: pointer;
        }
    </style>


</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-box">
        <div class="container-fluid">
            <img src="img/Book.png" alt="Logo" class="navbar-logo">
            <a class="navbar-brand" href="home_login.php">Perpustakaan Digital</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div class="d-flex align-items-center ms-auto">
                    <div class="flex-grow-1"></div>
                    <form method="GET" action="pch.php">
                        <div class="search-bar">
                            <div class="input-group">
                                <input type="text" id="cari" name="cari" class="form-control" value="<?php echo isset($_GET['cari']) ? $_GET['cari'] : ''; ?>" placeholder="Cari...">
                            </div>
                        </div>
                    </form>
                    <div class="login ms-2">
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Profil
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href='profil.php'>Profil</a>
                                <a class="dropdown-item" href='pch.php'>Cari Buku</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item btn btn-danger" href="../home.php">Keluar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
            </div>
        </div>
    </div>

    <div class="table1">
        <h2>Koleksi Kamu</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>User ID</th>
                    <th>Buku ID</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody class="tbl">
                <?php
                while ($data = mysqli_fetch_array($tampil)) {
                    $Judul = $data['Judul'];
                    $UserID = $data['UserID'];
                    $BukuID = $data['BukuID'];
                ?>
                    <tr>
                        <td><?= $Judul; ?></td>
                        <td><?= $BukuID; ?></td>
                        <td><?= $UserID; ?></td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center">
                                <button class="btn btn-sm btn-primary me-2"><a href="pinjam.php?id_buku=<?= $BukuID; ?>" style="color:  white;">Buka</a></button>
                                <button class="btn btn-sm btn-danger" onclick="hapusData(<?= $BukuID; ?>)">Hapus</button>
                            </div>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script>
        function hapusData(BukuID) {
            if (confirm('Apakah Anda yakin ingin menghapus buku ini?')) {
                window.location.href = 'hapusbuku.php?BukuID=' + BukuID;
            }
        }
    </script>
</body>

</html>