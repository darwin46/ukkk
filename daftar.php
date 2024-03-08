<?php
require 'function.php';
$NamaLengkap = $_POST["NamaLengkap"];
$Username = $_POST["Username"];
$Email = $_POST["Email"];
$Password = $_POST["Password"];
$Alamat = $_POST["Alamat"];

$notif = "";

$nama_pengguna = $_POST['Username'];
$password = $_POST['Password'];

$check_query = "SELECT * FROM user WHERE Username = '$Username'";
$check_result = mysqli_query($conn, $check_query);

if (mysqli_num_rows($check_result) > 0) {
    $notif = "Nama Pengguna telah digunakan";
} else {
    $insert_query = "INSERT INTO user (NamaLengkap, Username, Email, Password, Alamat) 
    VALUES ('$NamaLengkap', '$Username', '$Email', '$Password', '$Alamat')";
    if (mysqli_query($conn, $insert_query)) {
        header("Location: login.html");
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
        <div class="message-box">
            <?php echo $notif; ?>
        </div>
        <button class="btn-back" onclick="goBack()">Kembali</button>
    </div>

    <script>
    function goBack() {
        window.history.back();
    }
    </script>
</body>

</html>