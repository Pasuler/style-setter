<?php
require "../koneksi.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_barang'])) {
    $id_barang = $_POST['id_barang'];
    $id_barang = mysqli_real_escape_string($con, $id_barang);
    $query_check_stok = "SELECT * FROM stok WHERE id_barang = '$id_barang'";
    $result_check_stok = mysqli_query($con, $query_check_stok);
    
    if (mysqli_num_rows($result_check_stok) > 0) {
        header("Location: produk.php?pesan=Barang tidak bisa dihapus karena digunakan di table stok");
    } else {
        $sql = "DELETE FROM barang WHERE id_barang = '$id_barang'";
        $result = mysqli_query($con, $sql);
        if ($result) {
            header("Location: produk.php?pesan=Produk berhasil dihapus");
        } else {
            header("Location: produk.php?pesan=Gagal menghapus produk");
        }
    }
    exit();
} else {
    header("Location: produk.php");
    exit();
}
?>
