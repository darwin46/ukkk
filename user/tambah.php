<?php
include "../function.php";

if (isset($_POST['tambah'])) {
    // Ambil data dari laporan berdasarkan BukuID
    $BukuID = $_POST['BukuID'];
    $NamaBuku = $_POST['Judul'];
    $Penulis = $_POST['Penulis'];
    $Rating = $_POST['Rating'];

    // Query untuk memasukkan data ke dalam tabel koleksi.koleksi
    $insert_query = "INSERT INTO koleksi (BukuID, Judul, Penulis, Rating) VALUES ('$BukuID', '$NamaBuku', '$Penulis', '$Rating')";

    // Lakukan query untuk memasukkan data menggunakan koneksi $koleksi
    $insert_result = mysqli_query($koleksi, $insert_query);

    // Cek jika query berhasil
    if ($insert_result) {
        echo "<script>alert('Data berhasil ditambahkan ke koleksi.');</script>";
        echo "<script>window.location.href = 'pch.php';</script>";
        exit();
    } else {
        echo "<script>alert('Gagal menambahkan data ke koleksi.');</script>";
    }
}
