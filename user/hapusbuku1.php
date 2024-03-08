<?php
include "../function.php"; 

if(isset($_GET['BukuID'])) {
    $BukuID = $_GET['BukuID'];

    $query = "DELETE FROM peminjam WHERE BukuID = '$BukuID'";

    $result = mysqli_query($conn, $query);

    if($result) {
        echo "Buku berhasil dihapus.";
    } else {
        echo "Gagal menghapus buku.";
    }
} else {
    echo "Buku tidak ditemukan.";
}
header("Location: koleksi.php");
exit();
?>
