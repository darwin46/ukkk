<?php
include "../function.php"; // Sertakan file koneksi ke database

// Check if BukuID is set in the URL
if (isset($_GET['BukuID'])) {
    $BukuID = $_GET['BukuID'];

    // Query to select book data based on BukuID
    $query = "SELECT * FROM laporan WHERE BukuID = '$BukuID'";
    $result = mysqli_query($stock, $query);

    // Check if data is found
    if (mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);

        // Jika tombol "Suka" diklik
        if (isset($_POST['suka'])) {
            // Ambil data dari laporan berdasarkan BukuID
            $BukuID = $_POST['BukuID'];
            $NamaBuku = $_POST['NamaBuku'];
            $Gambar = $_POST['Gambar'];

            // Query untuk memasukkan data ke dalam tabel koleksi
            $insert_query = "INSERT IGNORE INTO koleksi (BukuID, NamaBuku, Gambar) VALUES ('$BukuID', '$NamaBuku', '$Gambar')";

            // Lakukan query untuk memasukkan data
            $insert_result = mysqli_query($koleksi, $insert_query); // Menggunakan variabel $koleksi sebagai koneksi

            // Cek jika query berhasil
            if ($insert_result) {
                if (mysqli_affected_rows($koleksi) > 0) {
                    echo "<script>alert('Data berhasil ditambahkan ke koleksi.');</script>";
                    echo "<script>window.location.href = 'pch.php';</script>";
                    exit();
                } else {
                    echo "<script>alert('Buku sudah ada dalam koleksi.');</script>";
                }
            } else {
                echo "<script>alert('Gagal menambahkan data ke koleksi.');</script>";
            }
        }

?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Detail Buku</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        </head>

        <body>
            <div class="container mt-5">
                <h1 class="text-center mb-4">Detail Buku</h1>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">BukuID</th>
                            <th scope="col">Nama Buku</th>
                            <th scope="col">Gambar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo $data['BukuID']; ?></td>
                            <td><?php echo $data['NamaBuku']; ?></td>
                            <td><?php echo $data['Gambar']; ?></td>
                        </tr>
                        <tr>
                            <form method="post">
                                <input type="hidden" name="BukuID" value="<?php echo $data['BukuID']; ?>">
                                <input type="hidden" name="NamaBuku" value="<?php echo $data['NamaBuku']; ?>">
                                <input type="hidden" name="Gambar" value="<?php echo $data['Gambar']; ?>">
                                <td colspan="4">
                                    <button class="btn btn-primary" type="submit" name="suka">Tambah</button>
                                </td>
                            </form>
                        </tr>
                    </tbody>
                </table>
                <button class="btn btn-danger" onclick="window.location.href='pch.php'">Batalkan</button>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        </body>

        </html>
<?php
    } else {
        echo "Data buku tidak ditemukan.";
    }
}
?>
