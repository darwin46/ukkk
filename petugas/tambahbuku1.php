<?php
require '../function.php';

$notif = ""; // Initialize notification variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assuming $conn is your database connection

    // Retrieve form data
    $NamaBuku = $_POST["Judul"];
    $Status = "Tambah";
    $TanggalHariIni = date("Y-m-d");
    $Penulis = $_POST["Penulis"];
    $Penerbit = $_POST["Penerbit"];
    $TahunTerbit = $_POST["TahunTerbit"];
    $Deskripsi = $_POST["Deskripsi"];
    $kategori = $_POST["NamaKategori"];

    // Handle file upload
    if (isset($_FILES["gambar"]) && $_FILES["gambar"]["error"] == UPLOAD_ERR_OK) {
        $namaFile = $_FILES["gambar"]["name"];
        $ukuranFile = $_FILES["gambar"]["size"];
        $tmpName = $_FILES["gambar"]["tmp_name"];
        $tipeFile = $_FILES["gambar"]["type"];

        // Convert image to base64 encoded string
        $gambarBase64 = base64_encode(file_get_contents($tmpName));
        $Gambar = "data:$tipeFile;base64,$gambarBase64";

        // Query to insert book data into database
        $sql = "INSERT INTO buku (gambar, Judul, status, Penulis, Penerbit, TahunTerbit, Deskripsi,TanggalHariIni, NamaKategori) 
                VALUES ('$Gambar', '$NamaBuku', '$Status', '$Penulis', '$Penerbit', '$TahunTerbit' ,'$Deskripsi', '$TanggalHariIni', '$kategori')";

        // Execute query
        if (mysqli_query($conn, $sql)) {
            $notif = "Buku berhasil ditambahkan.";
        } else {
            $notif = "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {
        $notif = "Pilih file gambar yang akan diupload.";
    }
}

// Query to get book categories
$sql_kategori = "SELECT * FROM kategoribuku";
$result_kategori = mysqli_query($conn, $sql_kategori);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>buat buku</title>
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

        .title {
            text-align: center;
            margin-top: 20px;
        }

        .message-box {
            padding: 20px;
            background-color: #f2f2f2;
            border: 1px solid #ddd;
            margin-bottom: 20px;
        }

        .btn-back {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-box">
        <div class="container-fluid">
            <img src="img/Book.png" alt="Logo" class="navbar-logo">
            <a class="navbar-brand" href="#" onclick="window.location.href='admin.html';">Perpustakaan
                Digital</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            </div>
        </div>
    </nav>

    <div class="title">
        <h1 class="text-center text-black">
            TAMBAH BUKU
        </h1>
    </div>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3" class="input">
                <form method="POST" action="tambahbuku.php" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="gambar">Pilih Gambar:</label>
                        <div>
                            <input type="file" name="gambar" id="gambar">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="Judul" class="form-label">Nama Buku</label>
                        <div>
                            <input type="text" class="form-control" id="Judul" name="Judul" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="Penulis" class="form-label">Penulis</label>
                        <div>
                            <input type="text" class="form-control" id="Penulis" name="Penulis" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="Penerbit" class="form-label">Penerbit</label>
                        <div>
                            <input type="text" class="form-control" id="Penerbit" name="Penerbit" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="TahunTerbit" class="form-label">TahunTerbit</label>
                        <div>
                            <input type="date" class="form-control" id="TahunTerbit" name="TahunTerbit" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="Deskripsi" class="form-label">Deskripsi</label>
                        <div>
                            <input type="text" class="form-control" id="Deskripsi" name="Deskripsi" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="NamaKategori" class="form-label">Kategori</label>
                        <div>
                            <select class="form-select" $kategori="NamaKategori" name="NamaKategori">
                                <option value="">Pilih Kategori</option>
                                <?php
                                if ($result_kategori && mysqli_num_rows($result_kategori) > 0) {
                                    while ($row_kategori = mysqli_fetch_assoc($result_kategori)) {
                                        echo "<option value='" . $row_kategori['NamaKategori'] . "'>" . $row_kategori['NamaKategori'] . "</option>";
                                    }
                                } else {
                                    echo "<option value=''>Tidak ada kategori</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <button type="submit" name="tambah" class="btn btn-primary">Tambah</button>
                </form>
                <div class="d-flex justify-content-center mb-3">
                    <div class="text-center mt-3">
                        <button type="button" class="btn btn-primary" onclick="window.location.href='pendataanbarang1.php';">Kembali</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>