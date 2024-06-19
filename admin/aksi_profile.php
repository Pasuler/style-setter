<?php
require "../koneksi.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_user = $_POST['id_user'];
    $nama = htmlspecialchars($_POST['nama'], ENT_QUOTES, 'UTF-8');
    $jenis_kelamin = htmlspecialchars($_POST['jenis_kelamin'], ENT_QUOTES, 'UTF-8');
    $telp = htmlspecialchars($_POST['telp'], ENT_QUOTES, 'UTF-8');
    $alamat = htmlspecialchars($_POST['alamat'], ENT_QUOTES, 'UTF-8');

    $nama = mysqli_real_escape_string($con, $nama);
    $jenis_kelamin = mysqli_real_escape_string($con, $jenis_kelamin);
    $telp = mysqli_real_escape_string($con, $telp);
    $alamat = mysqli_real_escape_string($con, $alamat);

    $sql = "INSERT INTO pelanggan(id_user, nama, jenis_kelamin, telp, alamat) VALUES ('$id_user', '$nama', '$jenis_kelamin', '$telp', '$alamat')";
    $query = $con->query($sql);

    if ($query === true) {
        $role_query = $con->query("SELECT role FROM user WHERE id_user = '$id_user'");
        $role_data = $role_query->fetch_assoc();
        $role = $role_data['role'];

        if ($role == 'Admin') {
            header('Location: index.php?pesan=Profile berhasil ditambahkan');
        } elseif ($role == 'user') {
            header('Location: ../user/index.php?pesan=Profile berhasil ditambahkan');
        }
    } else {
        header('Location: input_profile.php?pesan=Error: ' . $con->error);
    }
    exit();
}
?>
