<?php
require "../koneksi.php";
session_start();

if (!isset($_SESSION['id_user'])) {
    header("Location: login.php");
    exit;
}

if (isset($_GET['id_cart'])) {
    $id_cart = $_GET['id_cart'];
    $query = "DELETE FROM cart WHERE id_cart = $id_cart";
    mysqli_query($con, $query);

    header("Location: shopping_cart.php");
    exit;
} else {
    echo "ID Cart tidak ditemukan.";
    exit;
}
?>
