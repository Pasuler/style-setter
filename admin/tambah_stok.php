<?php
include "../koneksi.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_supplier = $_POST['id_supplier'];
    $id_barang = $_POST['id_barang'];
    $tanggal = $_POST['tanggal'];
    $qty = $_POST['qty'];

    $cek_stok = $con->query("SELECT * FROM stok WHERE id_barang = '$id_barang'");
    if ($cek_stok->num_rows > 0) {
        $stok_lama = $cek_stok->fetch_assoc();
        $qty_baru = $stok_lama['qty'] + $qty;
        $sql = "UPDATE stok SET qty = '$qty_baru', tanggal = '$tanggal' WHERE id_barang = '$id_barang'";
    } else {
        $sql = "INSERT INTO stok(id_supplier, id_barang, tanggal, qty) VALUES ('$id_supplier', '$id_barang', '$tanggal', '$qty')";
    }
    
    $query = $con->query($sql);

    if ($query === true) {
        header('Location: supplier.php?pesan=Stok berhasil ditambahkan atau diupdate');
    } else {
        header('Location: supplier.php?pesan=Error: ' . $con->error);
    }
    exit();
}
?>
