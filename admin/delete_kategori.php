<?php
require "../koneksi.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_kategori'])) {
    $id_kategori = $_POST['id_kategori'];
    $id_kategori = mysqli_real_escape_string($con, $id_kategori);
    $query_check_barang = "SELECT * FROM barang WHERE id_kategori = '$id_kategori'";
    
    $sql = "DELETE FROM kategori WHERE id_kategori = '$id_kategori'";
    $result = mysqli_query($con, $sql);
        if ($result) {
            header("Location: kategori.php?pesan=Kategori berhasil dihapus");
        } else {
            header("Location: kategori.php?pesan=Gagal menghapus kategori");
        }
    exit();
} else {
    header("Location: kategori.php");
    exit();
}
?>
