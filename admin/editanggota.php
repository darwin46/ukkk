<?php
include "../function.php"; 

if (isset($_GET['UserID'])) {
    $UserID = $_GET['UserID'];

    $query = "SELECT * FROM user WHERE UserID = '$UserID'";
    $result = mysqli_query($conn, $query);

    // Check if data is found
    if (mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Edit Anggota</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
            <style>
                .navbar-box {
                    background-color: #ffffff;
                    padding: 10px;
                    border-bottom: 3px solid #ddd;
                    /* Added border-bottom for separation */
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
                        <!-- Removed the search input and button -->
                    </div>
                </div>
            </nav>

            <!-- Rest of your content -->
            <div class="title">
                <h1 class="text-center text-black">
                    EDIT ANGGOTA
                </h1>
            </div>

            <div class="container mt-5">
                <div class="row">
                    <div class="col-md-6 offset-md-3" class="input">
                        <form action="edit_proses.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="UserID" value="<?php echo $data['UserID']; ?>">

                            <div class="mb-3">
                                <label for="fullName" class="form-label">Nama Lengkap</label>
                                <div>
                                    <input type="text" class="form-control" id="NamaLengkap" name="NamaLengkap" value="<?php echo $data['NamaLengkap']; ?>" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="username" class="form-label">Nama Pengguna</label>
                                <div>
                                    <input type="text" class="form-control" id="NamaPengguna" name="Username" value="<?php echo $data['Username']; ?>" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Alamat Email</label>
                                <div>
                                    <input type="email" class="form-control" id="Email" aria-describedby="emailHelp" name="Email" value="<?php echo $data['Email']; ?>" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Kata Sandi</label>
                                <input type="password" class="form-control" id="Password" name="Password" value="<?php echo $data['Password']; ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="address" class="form-label">Tempat Tinggal</label>
                                <div>
                                    <input type="text" class="form-control" id="Alamat" name="Alamat" value="<?php echo $data['Alamat']; ?>" required>
                                </div>
                            </div>

                            <a>
                                <button type="submit" name="laporan" class="btn btn-primary">Simpan Perubahan</button>
                            </a>

                        </form>
                        <div class="text-center mt-3">
                            <button type="button" class="btn btn-primary" onclick="window.location.href='dataanggota.php';">Kembali</button>
                        </div>
                    </div>
                </div>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
            </script>

        </body>

        </html>
<?php
    } else {
        echo "Data anggota tidak ditemukan.";
    }
}
?>