<?php
// Memeriksa apakah data tanggal pinjam dikirimkan melalui metode POST
if(isset($_POST['tanggalPinjam'])) {
    // Mendapatkan tanggal pinjam dari data yang dikirimkan
    $tanggalPinjam = $_POST['tanggalPinjam'];

    // Menghitung tanggal kembali (7 hari setelah tanggal pinjam)
    $tanggalKembali = date("Y-m-d", strtotime($tanggalPinjam . "+7 days"));

    // Menampilkan tanggal peminjaman dan tanggal kembali
    echo "Tanggal Pinjam: " . $tanggalPinjam . "<br>";
    echo "Tanggal Kembali: " . $tanggalKembali;
} else {
    // Jika data tanggal pinjam tidak dikirimkan, tampilkan pesan kesalahan
    echo "Error: Tanggal pinjam tidak ditemukan.";
}
?>
