<?php
require "../koneksi.php";
session_start();

if (!isset($_SESSION['id_user'])) {
    header("Location: ../admin/login.php");
    exit;
}

if (!isset($_POST['selected_items']) || empty($_POST['selected_items'])) {
    echo "Tidak ada barang yang dipilih untuk dihapus.";
    exit;
}

$id_user = $_SESSION['id_user'];
$selected_items = $_POST['selected_items'];

foreach ($selected_items as $id_cart) {
    mysqli_query($con, "DELETE FROM cart WHERE id_cart = $id_cart AND id_user = $id_user");
}

header("Location: shopping_cart.php");
exit;
?>
