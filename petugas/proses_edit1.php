<?php
include "../function.php"; 

$BukuID = $_POST["BukuID"];
$NamaBuku = $_POST["Judul"];
$Penulis = $_POST["Penulis"];
$Penerbit = $_POST["Penerbit"];
$status = "EDIT";

if ($_FILES["gambar"]["error"] == UPLOAD_ERR_OK) {
    $targetDir = "uploads/"; 
    $targetFile = $targetDir . basename($_FILES["gambar"]["name"]);
    if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $targetFile)) {
        $query = "UPDATE laporan SET Judul='$NamaBuku', Penulis='$Penulis', Penerbit='$Penerbit', status='$status', Gambar='$targetFile' WHERE BukuID='$BukuID'";
    } else {
        $query = "UPDATE laporan SET Judul='$NamaBuku', Penulis='$Penulis', Penerbit='$Penerbit', status='$status' WHERE BukuID='$BukuID'";
    }
} else {
    $query = "UPDATE laporan SET Judul='$NamaBuku', Penulis='$Penulis', Penerbit='$Penerbit', status='$status' WHERE BukuID='$BukuID'";
}

$result = mysqli_query($conn, $query);

if ($result) {
    header("Location: pendataanbarang1.php?pesan=update_berhasil");
    exit();
} else {
    header("Location: editbuku1.php?BukuID=$BukuID&pesan=update_gagal");
    exit();
}
