<?php
include "../koneksi.php";
session_start();

if (isset($_GET['id'])) {
    $id_user = $_GET['id'];

    if ($id_user == $_SESSION['id_user']) {
        header('Location: pelanggan.php?pesan=Error: Anda tidak bisa menghapus akun yang sedang login.');
        exit();
    }

    $check_orders_query = "SELECT COUNT(*) AS order_count FROM orders WHERE id_user = '$id_user'";
    $check_orders_result = $con->query($check_orders_query);
    $order_data = $check_orders_result->fetch_assoc();

    if ($order_data['order_count'] > 0) {
        header('Location: pelanggan.php?pesan=Error: Hapus Order User Ini Terlebih Dahulu.');
        exit();
    }

    $delete_pelanggan_query = "DELETE FROM pelanggan WHERE id_user = '$id_user'";
    $delete_pelanggan_result = $con->query($delete_pelanggan_query);

    $delete_user_query = "DELETE FROM user WHERE id_user = '$id_user'";
    $delete_user_result = $con->query($delete_user_query);

    if ($delete_pelanggan_result === true && $delete_user_result === true) {
        header('Location: pelanggan.php?pesan=Pelanggan berhasil dihapus');
    } else {
        header('Location: pelanggan.php?pesan=Error: ' . $con->error);
    }
    exit();
} else {
    header('Location: pelanggan.php?pesan=Invalid request');
    exit();
}
?>
