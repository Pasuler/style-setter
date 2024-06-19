<?php
require "../koneksi.php";

if (isset($_GET['id'])) {
    $id_stok = $_GET['id'];
    $sql = "DELETE FROM stok WHERE id_stok = '$id_stok'";
    $query = $con->query($sql);

    if ($query === true) {
        header('Location: supplier.php?pesan=Stok berhasil dihapus');
    } else {
        header('Location: supplier.php?pesan=Error: ' . $con->error);
    }
    exit();
} else {
    header('Location: supplier.php?pesan=ID stok tidak ditemukan');
    exit();
}
?>
