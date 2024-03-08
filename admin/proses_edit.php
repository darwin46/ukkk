<?php
include "../function.php";

// Assuming $conn is your database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $BukuID = $_POST["BukuID"];
    $NamaBuku = $_POST["Judul"];
    $Penulis = $_POST["Penulis"];
    $Penerbit = $_POST["Penerbit"];
    $TahunTerbit = $_POST["TahunTerbit"];
    $status = "EDIT";

    // Corrected SQL query for UPDATE operation
    $query = "UPDATE buku SET Judul='$NamaBuku', Penulis='$Penulis', Penerbit='$Penerbit', status='$status', TahunTerbit='$TahunTerbit' WHERE BukuID='$BukuID'";

    if (mysqli_query($conn, $query)) {
        $notif = "Buku berhasil diperbarui.";
    } else {
        $notif = "Error: " . $query . "<br>" . mysqli_error($conn);
    }
} else {
    $notif = "Pilih file gambar yang akan diupload.";
}

if ($notif) {
    header("Location: pendataanbarang.php?pesan=update_berhasil");
    exit();
} else {
    header("Location: editbuku.php?BukuID=$BukuID&pesan=update_gagal");
    exit();
}
?>
