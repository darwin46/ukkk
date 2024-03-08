<?php
include "../function.php";

if (isset($_GET['id_buku'])) {
    $BukuID = $_GET['id_buku'];

    $query = "SELECT * FROM buku WHERE BukuID = '$BukuID'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $id = $row['BukuID'];
        $Judul = $row['Judul'];
        $Penulis = $row['Penulis'];
        $Penerbit = $row['Penerbit'];
        $Gambar = $row['gambar'];
    } else {
        echo "Buku tidak ditemukan.";
        exit();
    }
} else {
    echo "BukuID tidak tersedia dalam URL.";
    exit();
}
function tambahUlasanBuku($conn, $BukuID, $Ulasan, $rating)
{
    $query = "INSERT INTO ulasanbuku (BukuID, Ulasan, Rating) VALUES ('$BukuID', '$Ulasan', '$rating')";
    mysqli_query($conn, $query);
}

function hitungRataRataRating($conn, $BukuID)
{
    $query = "SELECT AVG(Rating) AS RataRata FROM ulasanbuku WHERE BukuID = '$BukuID'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    return $row['RataRata'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['Ulasan'])) {
        $Ulasan = $_POST['Ulasan'];
        $rating = $_POST['rating'];
        tambahUlasanBuku($conn, $BukuID, $Ulasan, $rating);
    }
}

$rata_rata_rating = hitungRataRataRating($conn, $BukuID);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pinjam Buku</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 50px;
        }

        .card {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            transition: 0.3s;
            border-radius: 10px;
        }

        .card:hover {
            box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
        }

        .card-img-top {
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            height: 300px;
            object-fit: cover;
        }

        .card-body {
            padding: 20px;
        }

        .btn {
            margin-top: 10px;
        }

        .table-responsive {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-6">
                <h2 class="text-center mb-4">Informasi Buku</h2>
                <div class="card">
                    <img src="<?= $Gambar; ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?= $Judul; ?></h5>
                        <p class="card-text"><strong>Penulis:</strong> <?= $Penulis; ?></p>
                        <p class="card-text"><strong>Penerbit:</strong> <?= $Penerbit; ?></p>
                        <p class="card-text"><strong>Rata-rata Rating:</strong> <?= $rata_rata_rating; ?></p>
                        <form method="post">
                            <div class="form-group">
                                <label for="Ulasan">Komentar:</label>
                                <textarea class="form-control" id="Ulasan" name="Ulasan" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="rating">Rating:</label>
                                <select class="form-control" id="rating" name="rating">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                            <button type="submit" name="submit_komentar_rating" class="btn btn-primary">Submit</button>
                        </form>
                        <hr>
                        <form action="pinjaman.php?id_buku=<?= $id; ?>" method="post">
                            <button type="submit" class="btn btn-primary">Pinjam</a></button>
                        </form>
                        
                        <a href="pch.php" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="table-responsive">
                    <h3 class="text-center mb-3">Ulasan Buku</h3>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Ulasan</th>
                                <th>Rating</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query_ulasan = "SELECT * FROM ulasanbuku WHERE BukuID = '$BukuID'";
                            $result_ulasan = mysqli_query($conn, $query_ulasan);
                            $count = 1;
                            while ($row_ulasan = mysqli_fetch_assoc($result_ulasan)) {
                                echo "<tr>";
                                echo "<td>" . $count++ . "</td>";
                                echo "<td>" . $row_ulasan['Ulasan'] . "</td>";
                                echo "<td>" . $row_ulasan['Rating'] . "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>