<?php
require 'koneksi.php';
$NamaLengkap = $_POST['NamaLengkap'];
$Username = $_POST['Username'];
$Email = $_POST['Email'];
$Password = $_POST['Password'];
$Alamat = $_POST['Alamat'];

$query_sql = "INSERT INTO daftar (NamaLengkap, Username, Alamat, Email, Password) 
            VALUES ('$NamaLengkap', '$Username', '$Alamat', '$Email', '$Password')";

if (mysqli_query($conn, $query_sql)) {
    header("Location: login.html");
} else {
    echo "Pendaftaran Gagal : " . mysqli_error($conn);
}
