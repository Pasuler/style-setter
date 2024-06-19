<?php
require "../koneksi.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_barang = $_POST['id_barang'];
    $kode_barang = $_POST['kode_barang'];
    $nama_barang = $_POST['nama_barang'];

    $query_update = mysqli_query($con, "UPDATE barang SET 
        kode_barang = '$kode_barang',
        nama_barang = '$nama_barang'
        WHERE id_barang = '$id_barang'");

    if ($query_update) {
        header("Location: produk.php?pesan=Produk berhasil diupdate");
    } else {
        header("Location: edit_produk.php?id=$id_barang&pesan=Gagal mengupdate produk");
    }
}
?>
