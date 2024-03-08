<?php
require 'koneksi.php';
$Email = $_POST["Email"];
$Password = $_POST["Password"];

$query_sql = "SELECT * FROM daftar 
            WHERE Email = '$Email' AND Password = '$Password'";

$result = mysqli_query($conn, $query_sql);

if (mysqli_num_rows($result) > 0) {
    header("Location: halutama.html");
} else {
    echo "<center><h1>Email atau Password Anda Salah. Silahkan Coba Login Kembali.</h1>
            <button><strong><a href='login.html'>Login</a></strong></button></center>";
}