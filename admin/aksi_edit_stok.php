<?php
require "../koneksi.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_stok = $_POST['id_stok'];
    $id_supplier = $_POST['id_supplier'];
    $id_barang = $_POST['id_barang'];
    $tanggal = $_POST['tanggal'];
    $qty = $_POST['qty'];

    $sql = "UPDATE stok SET id_supplier='$id_supplier', id_barang='$id_barang', tanggal='$tanggal', qty='$qty' WHERE id_stok='$id_stok'";
    $query = $con->query($sql);

    if ($query === true) {
        header('Location: supplier.php?pesan=Stok berhasil diupdate');
    } else {
        header('Location: supplier.php?pesan=Error: ' . $con->error);
    }
    exit();
}
?>
