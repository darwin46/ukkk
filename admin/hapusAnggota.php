<?php
include "../function.php"; // Sertakan file koneksi ke database

// Tangkap parameter BukuID dari URL
if(isset($_GET['UserID'])) {
    $UserID = $_GET['UserID'];

    // Buat query untuk menghapus buku dengan BukuID yang diterima
    $query = "DELETE FROM user WHERE UserID = '$UserID'";

    // Jalankan query
    $result = mysqli_query($conn, $query);

    // Periksa apakah penghapusan berhasil atau tidak
    if($result) {
        echo "";
    } else {
        echo "Gagal menghapus buku.";
    }
} else {
    echo "Buku tidak ditemukan.";
}
header("Location: dataanggota.php"); // Mengarahkan kembali pengguna ke halaman pendataanbarang.php
exit();
?>
