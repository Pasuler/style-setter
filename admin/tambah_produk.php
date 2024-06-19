<?php
include "../koneksi.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kode_barang = $_POST['kode_barang'];
    $nama_barang = $_POST['nama_barang'];
    $check_query = "SELECT * FROM barang WHERE nama_barang = '$nama_barang'";
    $check_result = $con->query($check_query);

    if ($check_result->num_rows > 0) {
        header('Location: produk.php?pesan=Nama barang sudah ada');
    } else {
        $sql = "INSERT INTO barang(kode_barang, nama_barang) VALUES ('$kode_barang', '$nama_barang')";
        $query = $con->query($sql);
        if ($query === true) {
            header('Location: produk.php?pesan=Produk berhasil ditambahkan');
        } else {
            header('Location: produk.php?pesan=Error: ' . $con->error);
        }
    }
    exit();
}
?>
