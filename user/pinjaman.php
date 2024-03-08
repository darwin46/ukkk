<?php
session_start();
include "../function.php";

$Username = $_SESSION['Username'];
$TanggalPeminjam = date("Y-m-d");
$TanggalPengembalian = date("Y-m-d", strtotime("+7 days"));
$StatusPeminjaman = "DiPinjam";
$id = $_GET['id_buku'];
$Judul = $_GET['Judul'];

$id_user_query = mysqli_query($conn, "SELECT UserID FROM user WHERE Username='$Username'");
$id_user_data = mysqli_fetch_assoc($id_user_query);
$id_user = $id_user_data['UserID'];

$cek = mysqli_query($conn, "SELECT * FROM peminjam WHERE BukuID=$id");
$jumlah = mysqli_num_rows($cek);

if ($jumlah > 0) {
    echo '<div class="message-box">';
    echo 'Buku Sudah Di Pinjam Sebelumnya';
    echo '</div>';
    echo '<button class="btn-back" onclick="goBack()">Kembali</button>';
} else {
    $insert = mysqli_query($conn, "INSERT INTO peminjam (UserID, BukuID, TanggalPeminjaman, TanggalPengembalian, StatusPeminjam) 
    VALUES ($id_user, $id, '$TanggalPeminjaman', '$TanggalPengembalian', '$StatusPeminjaman')");


    if ($insert) {
        header("location:pch.php");
        exit(); // Menghentikan eksekusi skrip setelah melakukan redirect
    } else {
        echo "Gagal memasukkan data";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notification</title>
    <style>
        .message-box {
            padding: 20px;
            background-color: #f2f2f2;
            border: 1px solid #ddd;
            margin-bottom: 20px;
            text-align: center;
            /* Pusatkan teks di dalam kotak notifikasi */
        }

        .btn-back {
            background-color: #4CAF50;
            /* Warna hijau */
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        .btn-back:hover {
            background-color: #45a049;
            /* Warna hijau lebih gelap saat hover */
        }
    </style>
</head>

<body>
    <script>
        function goBack() {
            window.location.href = 'pch.php'; // Redirect to the form page
        }
    </script>
</body>

</html>