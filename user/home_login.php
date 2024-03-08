<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan Digital</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa;
            color: #495057;
        }

        .navbar-box {
            background-color: #ffffff;
            padding: 10px;
            border-bottom: 3px solid #ddd;
        }

        .navbar-logo {
            max-height: 40px;
            margin-right: 10px;
        }

        .container {
            max-width: 100%;
            width: 300%;
            margin-top: 10%;
            margin-left: 5px;
            display: flex;
            justify-content: flex-start;
            align-content: center;
        }

        .text-content {
            text-align: left;
            margin-left: 10%;
            font-size: 18px;
            max-width: 600px;

        }

        .image-container {
            width: auto;
            height: auto;
        }

        .image-container img {
            width: 50%;
            height: auto;
            display: block;
            margin-left: 30%;
        }

        h2 {
            margin-bottom: 10px;
        }

        p {
            margin-bottom: 20px;
        }

        button {
            padding: 10px 15px;
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        .profile-image {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 5px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-box sticky-top">
        <div class="container-fluid">
            <img src="img/Book.png" alt="Logo" class="navbar-logo">
            <a class="navbar-brand" href="home_login.php">Perpustakaan Digital</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div class="d-flex align-items-center ms-auto">
                    <div class="flex-grow-1"></div>
                    <form method="GET" action="pch.php">
                        <div class="search-bar">
                            <div class="input-group">
                                <input type="text" id="cari" name="cari" class="form-control" value="<?php echo isset($_GET['cari']) ? $_GET['cari'] : ''; ?>" placeholder="Cari...">
                            </div>
                        </div>
                    </form>
                    <div class="login ms-2">
                        <div class="btn-group">
                            <button class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="img/icon.png" alt="" class="profile-image">
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href='profil.php'>Profil Saya</a>
                                <a class="dropdown-item" href='koleksi.php'>Koleksi</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item btn btn-danger" href="../home.php">Keluar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <div>
        <div class="container">
            <div class="text-content">
                <h2>PERPUSTAKAAN DIGITAL</h2>
                <p>Menghadirkan opsi membaca secara online dengan akses instan atau pilihan membaca jangka panjang,
                    perpustakaan digital kami menyediakan berbagai cara untuk memenuhi kebutuhan literasi pengguna.
                    menjadikan pengalaman perpustakaan digital lebih efisien dan nyaman.</p>
                <button class="btn btn-primary" onclick="goToSearchPage()"> Cari Buku </button>
            </div>
            <div class="image-container">
                <img src="img/1.png" alt="">
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

    <script>
        function goToSearchPage() {
            window.location.href = 'pch.php';
        }
    </script>
</body>

</html>