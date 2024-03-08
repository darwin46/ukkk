<?php
include "../function.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['rating']) && !empty($_POST['komentar'])) {
        $rating = $_POST['rating'];
        $comment = $_POST['komentar'];
        $BukuID = $_POST['BukuID'];

        // Periksa apakah BukuID sudah ada di database
        $check_query = "SELECT * FROM laporan WHERE BukuID = '$BukuID'";
        $check_result = mysqli_query($conn, $check_query);

        if (mysqli_num_rows($check_result) > 0) {
            // Jika BukuID sudah ada, tambahkan rating yang baru dengan rating yang sudah ada dalam database
            $existing_data = mysqli_fetch_assoc($check_result);
            $existing_rating = $existing_data['rating'];
            $new_rating = ($existing_rating + $rating) / 2; // Bagi hasilnya dengan 2

            // Update rating yang ada dengan nilai baru
            $update_query = "UPDATE laporan SET rating = '$new_rating' WHERE BukuID = '$BukuID'";
            if (mysqli_query($conn, $update_query)) {
                echo "Rating berhasil diperbarui.";
                // Redirect ke halaman pinjam.php atau halaman lain sesuai kebutuhan
                header("Location: pinjam.php");
                exit();
            } else {
                echo "Error: " . $update_query . "<br>" . mysqli_error($conn);
            }
        } else {
            // Jika BukuID belum ada, lakukan proses penyimpanan seperti biasa
            $query = "INSERT INTO laporan (BukuID, rating, Komentar) VALUES ('$BukuID', '$rating', '$comment')";

            if (mysqli_query($conn, $query)) {
                echo "Data berhasil disimpan.";
                // Redirect ke halaman pinjam.php atau halaman lain sesuai kebutuhan
                header("Location: pinjam.php");
                exit();
            } else {
                echo "Error: " . $query . "<br>" . mysqli_error($conn);
            }
        }
    } else {
        echo "Rating dan komentar harus diisi.";
        echo "<a href='javascript:history.back()' class='btn btn-primary'>Kembali</a>";
        exit();
    }
} else {
    echo "Akses tidak valid.";
}
