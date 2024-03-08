<?php
session_start();
include 'function.php';

$Username = $_POST['Username'];
$Password = $_POST['Password'];

$stmt = $conn->prepare("SELECT * FROM user WHERE Username=? AND Password=?");
$stmt->bind_param("ss", $Username, $Password);

$stmt->execute();

$result = $stmt->get_result();

$data = $result->fetch_assoc();

$cek = $result->num_rows;

if ($cek > 0) {
    if ($data['level'] == "ADMIN") {
        $_SESSION['Username'] = $Username;
        $_SESSION['level'] = "ADMIN";
        header("location:admin/admin.html");
    } elseif ($data['level'] == "PETUGAS") {
        $_SESSION['Username'] = $Username;
        $_SESSION['level'] = "PETUGAS";
        header("location:petugas/petugas.html");
    } elseif ($data['level'] == "") {
        $_SESSION['Username'] = $Username;
        header("location:user/home_login.php");
    } else {
        header("location:login.html?pesan=gagal");
    }
} else {
    header("location:login.html?pesan=gagal");
}

$stmt->close();

$function->close();
?>
