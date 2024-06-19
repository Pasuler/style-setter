<?php
require "../koneksi.php";
session_start();

if (!isset($_SESSION['id_user'])) {
    header("Location: ../admin/login.php");
    exit;
}

if (isset($_POST['id_detail_barang']) && isset($_POST['jumlah_barang'])) {
    $id_user = $_SESSION['id_user'];
    $id_detail_barang = $_POST['id_detail_barang'];
    $jumlah_barang = $_POST['jumlah_barang'];

    $query = mysqli_query($con, "SELECT harga FROM detail_barang WHERE id_detail_barang = $id_detail_barang");
    $data = mysqli_fetch_assoc($query);
    $harga = $data['harga'];

    $total_harga = $harga * $jumlah_barang;

    $query = "INSERT INTO cart (id_user, id_detail_barang, jumlah_barang, total_harga) 
            VALUES ($id_user, $id_detail_barang, $jumlah_barang, $total_harga)";
    mysqli_query($con, $query);

    header("Location: shopping_cart.php");
    exit;
} else {
    echo "ID Detail Barang atau Jumlah Barang tidak ditemukan.";
    exit;
}
?>
