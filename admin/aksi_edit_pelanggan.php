<?php
require "../koneksi.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_user = $_POST['id_user'];
    $nama = $_POST['nama'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $telp = $_POST['telp'];
    $alamat = $_POST['alamat'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql_pelanggan = "UPDATE pelanggan SET nama='$nama', jenis_kelamin='$jenis_kelamin', telp='$telp', alamat='$alamat' WHERE id_user='$id_user'";
    $query_pelanggan = $con->query($sql_pelanggan);

    $sql_user = "UPDATE user SET username='$username', password='$password' WHERE id_user='$id_user'";
    $query_user = $con->query($sql_user);

    if ($query_pelanggan === true && $query_user === true) {
        header('Location: pelanggan.php?pesan=Pelanggan berhasil diupdate');
    } else {
        header('Location: pelanggan.php?pesan=Error: ' . $con->error);
    }
    exit();
}
?>
