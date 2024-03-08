<?php
require '../function.php';

$notif = ""; // Initialize notification variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assuming $conn is your database connection

    // Retrieve form data
    $NamaBuku = $_POST["Judul"];
    $Status = "Tambah";
    $Penulis = $_POST["Penulis"];
    $Penerbit = $_POST["Penerbit"];
    $TahunTerbit = $_POST["TahunTerbit"];
    $Deskripsi = $_POST["Deskripsi"];
    $kategoribuku = $_POST["kategori"];

    // Query to retrieve category ID
    $id_kategori = mysqli_query($conn, "SELECT KategoriID FROM kategoribuku WHERE NamaKategori='$kategoribuku'");
    if ($id_kategori) {
        $idnya = mysqli_fetch_assoc($id_kategori)["KategoriID"];
        // Fetch category ID from result
    } else {
        // Handle error if query fails
        $notif = "Error fetching category ID: " . mysqli_error($conn);
    }
    

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
        $sql = "INSERT INTO buku (gambar, Judul, status, Penulis, Penerbit, TahunTerbit, Deskripsi) 
                VALUES ('$Gambar', '$NamaBuku', '$Status', '$Penulis', '$Penerbit', '$TahunTerbit' ,'$Deskripsi')";

        // Execute query
        if (mysqli_query($conn, $sql)) {
            $notif = "Buku berhasil ditambahkan.";

            // Retrieve the ID of the inserted book
            $id_buku = mysqli_insert_id($conn);

            // Insert into book-category relationship table
            $insert_relasi = mysqli_query($conn, "INSERT INTO kategoribuku_relasi (BukuID, KategoriId) VALUES ('$id_buku','$idnya')");
            if (!$insert_relasi) {
                // Handle error if query fails
                $notif = "Error: " . mysqli_error($conn);
            }
        } else {
            $notif = "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {
        $notif = "Pilih file gambar yang akan diupload.";
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            width: 50%;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            text-align: center;
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
    <div class="container">
        <?php if ($notif) : ?>
            <div class="message-box">
                <?php echo $notif; ?>
            </div>
            <button class="btn-back" onclick="goBack()">Kembali</button>
        <?php else : ?>
            <div class="message-box">
                Daftar berhasil
            </div>
            <button class="btn-back" onclick="goBack()">Kembali</button>
        <?php endif; ?>
    </div>
    <script>
        function goBack() {
            window.location.href = 'tambahbuku.html'; // Redirect to the form page
        }
    </script>
</body>

</html>