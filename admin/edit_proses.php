<?php
include "../function.php"; // Sertakan file koneksi ke database

// Tangkap parameter yang dikirimkan dari form
$UserID = $_POST['UserID'];
$NamaLengkap = $_POST['NamaLengkap'];
$Username = $_POST['Username'];
$Email = $_POST['Email'];
$Password = $_POST['Password'];
$Alamat = $_POST['Alamat'];

// Query untuk melakukan update data anggota berdasarkan id
$query = "UPDATE user SET NamaLengkap='$NamaLengkap', Username='$Username', Email='$Email', Password='$Password', Alamat='$Alamat' WHERE UserID='$UserID'";

// Jalankan query update
$result = mysqli_query($conn, $query);

// Periksa apakah query berhasil dijalankan atau tidak
if ($result) {
    // Jika berhasil, kembalikan pengguna ke halaman data anggota dengan pesan sukses
    header("Location: dataanggota.php?pesan=update_berhasil");
    exit();
} else {
    // Jika gagal, kembalikan pengguna ke halaman edit dengan pesan kesalahan
    header("Location: editanggota.php?UserID=$UserID&pesan=update_gagal");
    exit();
}
?>