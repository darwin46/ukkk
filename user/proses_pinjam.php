<?php
include "../function.php";

// Periksa apakah permintaan POST berisi data buku yang akan dipinjam
if (isset($_POST['bukuID'])) {
    $bukuID = $_POST['bukuID'];

    $query = "INSERT INTO peminjaman (BukuID, Judul) VALUES ('$bukuID','$Judul' NOW())";

    // Eksekusi query
    $result = mysqli_query($stock, $query);

    // Periksa apakah query berhasil dieksekusi
    if ($result) {
        echo "Buku berhasil dipinjam.";
    } else {
        echo "Gagal meminjam buku. Silakan coba lagi.";
    }
} else {
    // Jika tidak ada data buku yang dipinjam, kirimkan pesan kesalahan
    echo "ID buku tidak ditemukan.";
}
?>
