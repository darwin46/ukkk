<?php
include "../function.php";

session_start();

if (isset($_GET['cari'])) {
    $pencaharian = $_GET['cari'];
    $query = "SELECT * FROM buku WHERE (BukuID LIKE '%$pencaharian%' OR Judul LIKE '%$pencaharian%' OR Penulis LIKE '%$pencaharian%' OR Penerbit LIKE '%$pencaharian%' OR TahunTerbit LIKE '%$pencaharian%') ORDER BY BukuID ASC";
} else {
    $query = "SELECT * FROM buku ORDER BY BukuID ASC";
}

$tampil = mysqli_query($conn, $query);

$sql = "SELECT buku.BukuID, buku.Judul, kategoribuku.KategoriID, kategoribuku.NamaKategori
        FROM buku
        INNER JOIN kategoribuku_relasi ON buku.BukuID = kategoribuku_relasi.BukuID
        INNER JOIN kategoribuku ON kategoribuku.KategoriID = kategoribuku_relasi.KategoriID";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "BukuID: " . $row["BukuID"] . " - Judul: " . $row["Judul"] . " - KategoriID: " . $row["KategoriID"] . " - NamaKategori: " . $row["NamaKategori"] . "<br>";
    }
}

if (isset($_GET['kategori'])) {
    $kategori = $_GET['kategori'];
    $query = "SELECT buku.BukuID, buku.Judul, buku.Penulis, buku.Penerbit, buku.TahunTerbit, buku.gambar, buku.Deskripsi
              FROM buku 
              INNER JOIN kategoribuku_relasi ON buku.BukuID = kategoribuku_relasi.BukuID
              INNER JOIN kategoribuku ON kategoribuku.KategoriID = kategoribuku_relasi.KategoriID
              WHERE kategoribuku.NamaKategori = '$kategori'
              ORDER BY buku.BukuID ASC";
} else {
    $query = "SELECT * FROM buku ORDER BY BukuID ASC";
}

$tampil = mysqli_query($conn, $query);

// Query to get book categories
$sql_kategori = "SELECT * FROM kategoribuku";
$result_kategori = mysqli_query($conn, $sql_kategori);
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
            max-width: 95%;
            /* Mengubah lebar maksimum kontainer */
            margin-left: auto;
            /* Mengubah margin kiri menjadi otomatis */
            margin-right: auto;
            /* Mengubah margin kanan menjadi otomatis */
        }

        h2 {
            text-align: center;
            margin-top: 3%;
        }

        .table-container {
            margin-top: 20px;
            overflow-x: auto;
            /* Menambahkan overflow-x untuk mengatasi tabel yang melebihi lebar layar */
        }

        .search-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .search-bar label {
            margin-right: 15px;
            /* Mengurangi jarak antara label dan input */
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

        .Tbuku {
            margin-left: 5%;
        }

        /* Menambah gaya untuk elemen tabel */
        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            padding: 8px;
            /* Menambah padding pada sel tabel */
            text-align: left;
            border-bottom: 1px solid #ddd;
            /* Menambah garis bawah pada setiap sel */
        }

        .table th {
            background-color: #f2f2f2;
            /* Menambah latar belakang untuk header tabel */
        }

        .table-actions {
            width: 120px;
        }

        .dropdown-container {
            margin-top: 10px;
        }

        /* Menyesuaikan gaya tombol dalam dropdown container */
        .dropdown-container button {
            margin-left: 10px;
            /* Menambah jarak antara tombol dalam dropdown */
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
                        <button class="btn btn-primary" onclick="window.location.href='buatlaporan.php'">Buat Laporan</button>
                        <button class="btn1" onclick="window.location.href='pendataanbarang.php'">Pendataan Barang</button>
                        <button class="btn btn-primary" onclick="window.location.href='dataanggota.php'">Data Anggota</button>
                        <button class="btn btn-danger" onclick="window.location.href='../home.php'">Logout</button>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <h2>PENDATAAN BARANG</h2>
    <div class="container">
        <form method="GET" action="pendataanbarang.php">
            <div class="search-bar">
                <label for="cari">Pencaharian:</label>
                <div class="input-group">
                    <input type="text" id="cari" name="cari" class="form-control" value="<?php echo isset($_GET['cari']) ? $_GET['cari'] : ''; ?>" placeholder="Cari...">
                    <button type="submit" class="btn btn-primary">Cari</button>
                </div>
            </div>
        </form>
        <div style="display: flex; justify-content: space-between; align-items: center; margin-right: 20px; margin-left: 20px;">
            <button type="submit" class="btn btn-primary" onclick="window.location.href='tambahbuku.php'">Tambah Barang</button>
            <div class="dropdown-container">
                <div style="display: flex; align-items: center;">
                    <form method="GET" action="pendataanbarang.php">
                        <select name="kategori" class="form-select" onchange="this.form.submit()">
                            <option value="">Pilih Kategori</option>
                            <?php
                            if ($result_kategori && mysqli_num_rows($result_kategori) > 0) {
                                while ($row_kategori = mysqli_fetch_assoc($result_kategori)) {
                                    $selected = ($_GET['NamaKategori'] ?? '') == $row_kategori['NamaKategori'] ? 'selected' : '';
                                    echo "<option value='" . $row_kategori['NamaKategori'] . "' $selected>" . $row_kategori['NamaKategori'] . "</option>";
                                }
                            } else {
                                echo "<option value=''>Tidak ada kategori</option>";
                            }
                            ?>
                        </select>
                    </form>
                    <button class="btn btn-primary ms-2" onclick="window.location.href='tambahKategori.php'">Tambah Kategori</button>
                </div>
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
                        <th>Gambar</th>
                        <th>Deskripsi</th>
                        <th class="table-actions">Aksi</th>
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
                        $gambarBase64 = $data['gambar'];
                        $Deskripsi = $data['Deskripsi'];
                    ?>
                        <tr>
                            <td><?= $BukuID; ?></td>
                            <td><?= $NamaBuku; ?></td>
                            <td><?= $Penulis; ?></td>
                            <td><?= $Penerbit; ?></td>
                            <td><?= $TahunTerbit; ?></td>
                            <td><img src="<?= $gambarBase64; ?>" alt="Gambar Buku" style="max-width: 100px; max-height: 100px;"></td>
                            <td><?= $Deskripsi; ?></td>
                            <td>
                                <button class="btn btn-sm btn-primary" onclick="window.location.href='editbuku.php?BukuID=<?= $BukuID; ?>'">Edit</button>
                                <button class="btn btn-sm btn-danger" onclick="hapusData(<?= $BukuID; ?>)">Hapus</button>
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
        function hapusData(BukuID) {
            if (confirm('Apakah Anda yakin ingin menghapus buku ini?')) {
                window.location.href = 'hapusbuku.php?BukuID=' + BukuID;
            }
        }
    </script>

</body>


</html>