<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kategori</title>
</head>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f0f0f0;
        padding: 20px;
    }

    .container {
        max-width: 400px;
        margin: 0 auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    h2 {
        margin-top: 0;
    }

    label {
        font-weight: bold;
    }

    input[type="text"],
    input[type="submit"] {
        width: 100%;
        padding: 10px;
        margin: 5px 0 15px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    input[type="submit"] {
        background-color: #4CAF50;
        color: white;
        border: none;
        cursor: pointer;
    }

    input[type="submit"]:hover {
        background-color: #45a049;
    }

    a {
        display: block;
        margin-top: 15px;
        text-align: center;
        text-decoration: none;
        color: #333;
    }
</style>
</style>

<body>
    <h2>Tambah Kategori Buku</h2>
    <form action="" method="post">
        <label for="nama_kategori">Nama Kategori:</label><br>
        <input type="text" id="nama_kategori" name="nama_kategori"><br><br>
        <input type="submit" value="Tambah" name="submit">
    </form>

    <a href="pendataanbarang.php">Kembali</a>

    <?php
    // Memasukkan file function.php untuk koneksi ke database
    include '../function.php';

    if (isset($_POST['submit'])) {
        $nama_kategori = $_POST['nama_kategori'];

        // Query untuk menambahkan data ke tabel kategoribuku
        $sql = "INSERT INTO kategoribuku (NamaKategori) VALUES ('$nama_kategori')";

        if ($conn->query($sql) === TRUE) {
            echo "Data kategori berhasil ditambahkan.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    $conn->close(); // Tutup koneksi setelah selesai
    ?>
</body>

</html>