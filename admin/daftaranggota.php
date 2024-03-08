<?php
require '../function.php';
$NamaLengkap = $_POST["NamaLengkap"];
$Username = $_POST["Username"];
$Email = $_POST["Email"];
$Password = $_POST["Password"];
$Alamat = $_POST["Alamat"];
$level = "PETUGAS"; 
$notif = "";

// Mendapatkan data dari form
$nama_pengguna = $_POST['Username'];
$password = $_POST['Password'];

// Query untuk memeriksa apakah nama pengguna sudah ada dalam tabel
$check_query = "SELECT * FROM user WHERE Username = '$Username'";
$check_result = mysqli_query($conn, $check_query);

// Memeriksa apakah ada baris hasil query
if (mysqli_num_rows($check_result) > 0) {
    // Jika ada, maka nama pengguna sudah digunakan
    $notif = "Nama Pengguna telah digunakan";
} else {
    // Jika tidak ada, maka nama pengguna belum digunakan, lakukan penambahan data ke dalam tabel
    $insert_query = "INSERT INTO user (NamaLengkap, Username, Email, Password, Alamat, level) 
    VALUES ('$NamaLengkap', '$Username', '$Email', '$Password', '$Alamat', '$level')";
    if (mysqli_query($conn, $insert_query)) {
        echo $notif;
    } else {
        $notif = "Error: " . $insert_query . "<br>" . mysqli_error($conn);
    }
}

// Menutup koneksi
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifikasi</title>
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
            window.location.href = 'daftaranggota.html';
        }
    </script>
</body>

</html>