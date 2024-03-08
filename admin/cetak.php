<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Buku</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h2 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px auto;
        }

        th,
        td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .container {
            max-width: 90%;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>LAPORAN BUKU</h2>
        <form method="GET" action="buatlaporan.php">
            <table>
                <thead>
                    <tr>
                        <th>Buku ID</th>
                        <th>Nama Buku</th>
                        <th>Penulis</th>
                        <th>Penerbit</th>
                        <th>TahunTerbit</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include "../function.php";
                    $query = "SELECT * FROM buku ORDER BY BukuID ASC";
                    $tampil = mysqli_query($conn, $query);
                    while ($data = mysqli_fetch_array($tampil)) {
                        echo "<tr>";
                        echo "<td>" . $data['BukuID'] . "</td>";
                        echo "<td>" . $data['Judul'] . "</td>";
                        echo "<td>" . $data['Penulis'] . "</td>";
                        echo "<td>" . $data['Penerbit'] . "</td>";
                        echo "<td>" . $data['TahunTerbit'] . "</td>";
                        echo "<td>" . $data['status'] . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </form>
    </div>
    <script>
        window.print();
    </script>
</body>

</html>