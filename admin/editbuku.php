<?php
include "../function.php";

if (isset($_GET['BukuID'])) {
    $BukuID = $_GET['BukuID'];

    $query = "SELECT * FROM buku WHERE BukuID = '$BukuID'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Edit Buku</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
            <style>
                .navbar-box {
                    background-color: #ffffff;
                    padding: 10px;
                    border-bottom: 3px solid #ddd;
                }

                .navbar-logo {
                    max-height: 40px;
                    margin-right: 10px;
                }

                .title {
                    text-align: center;
                    margin-top: 20px;
                }
            </style>
        </head>

        <body>

            <nav class="navbar navbar-expand-lg navbar-box">
                <div class="container-fluid">
                    <img src="img/Book.png" alt="Logo" class="navbar-logo">
                    <a class="navbar-brand" href="#" onclick="window.location.href='admin.html';">Perpustakaan Digital</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    </div>
                </div>
            </nav>

            <div class="title">
                <h1 class="text-center text-black">
                    EDIT BUKU
                </h1>
            </div>
            <div class="container mt-5">
                <div class="row">
                    <div class="col-md-6 offset-md-3" class="input">
                        <form method="POST" action="proses_edit.php" enctype="multipart/form-data">
                            <input type="hidden" name="BukuID" value="<?php echo $data['BukuID']; ?>">

                            <div class="mb-3">
                                <label for="gambar">Gambar</label>
                                <div class="input-group">
                                    <img src="<?php echo $data['gambar']; ?>" class="img-fluid" style="width: 100px; height: auto;">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="Judul" class="form-label">Nama Buku</label>
                                <div>
                                    <input type="text" class="form-control" id="Judul" name="Judul" value="<?php echo $data['Judul']; ?>" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="Penulis" class="form-label">Penulis</label>
                                <div>
                                    <input type="text" class="form-control" id="Penulis" name="Penulis" value="<?php echo $data['Penulis']; ?>" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="Penerbit" class="form-label">Penerbit</label>
                                <div>
                                    <input type="text" class="form-control" id="Penerbit" name="Penerbit" value="<?php echo $data['Penerbit']; ?>" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="TahunTerbit" class="form-label">TahunTerbit</label>
                                <div>
                                    <input type="date" class="form-control" id="TahunTerbit" name="TahunTerbit" value="<?php echo $data['TahunTerbit']; ?>" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="Deskripsi" class="form-label">Deskripsi</label>
                                <div>
                                    <input type="text" class="form-control" id="Deskripsi" name="Deskripsi" value="<?php echo $data['Deskripsi']; ?>" required>
                                </div>
                            </div>
                            <button type="submit" name="laporan" class="btn btn-primary">Simpan Perubahan</button>
                        </form>
                        <div class="d-flex justify-content-center mb-3">
                            <div class="text-center mt-3">
                                <button type="button" class="btn btn-primary" onclick="window.location.href='pendataanbarang.php';">Kembali</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        </body>

        </html>
<?php
    } else {
        echo "Data buku tidak ditemukan.";
    }
}
