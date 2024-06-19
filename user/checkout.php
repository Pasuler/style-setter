<?php
require "../koneksi.php";
session_start();

if (!isset($_SESSION['id_user'])) {
    header("Location: ../admin/login.php");
    exit;
}

if (!isset($_POST['selected_items']) || empty($_POST['selected_items'])) {
    echo "Tidak ada barang yang dipilih untuk checkout.";
    exit;
}

$id_user = $_SESSION['id_user'];
$selected_items = $_POST['selected_items'];
$total_harga = 0;

foreach ($selected_items as $id_cart) {
    $query = mysqli_query($con, "SELECT * FROM cart WHERE id_cart = $id_cart AND id_user = $id_user");
    $item = mysqli_fetch_assoc($query);
    $total_harga += $item['total_harga'];
}

if ($total_harga == 0) {
    echo "Keranjang belanja Anda kosong.";
    exit;
}

mysqli_query($con, "INSERT INTO orders (id_user, total_harga, created_at) VALUES ($id_user, $total_harga, CURDATE())");
$id_order = mysqli_insert_id($con);

foreach ($selected_items as $id_cart) {
    $query = mysqli_query($con, "SELECT * FROM cart WHERE id_cart = $id_cart AND id_user = $id_user");
    $item = mysqli_fetch_assoc($query);
    $id_detail_barang = $item['id_detail_barang'];
    $jumlah_barang = $item['jumlah_barang'];
    $harga = $item['total_harga'];

    mysqli_query($con, "INSERT INTO order_items (id_order, id_detail_barang, jumlah_barang, harga) 
                        VALUES ($id_order, $id_detail_barang, $jumlah_barang, $harga)");

    mysqli_query($con, "DELETE FROM cart WHERE id_cart = $id_cart AND id_user = $id_user");
}

header("Location: order_confirmation.php?id_order=$id_order");
exit;
?>
