<?php
require "../koneksi.php";
session_start();

if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'Admin') {
    header("Location: ../admin/login.php");
    exit;
}

if (isset($_POST['delete_order'])) {
    $id_order = $_POST['id_order'];
    $query_delete_items = mysqli_query($con, "DELETE FROM order_items WHERE id_order = $id_order");

    if ($query_delete_items) {
        $query_delete_order = mysqli_query($con, "DELETE FROM orders WHERE id_order = $id_order");

        if ($query_delete_order) {
            $_SESSION['message'] = "Order berhasil dihapus.";
        } else {
            $_SESSION['message'] = "Gagal menghapus order.";
        }
    } else {
        $_SESSION['message'] = "Gagal menghapus item order terkait.";
    }

    header("Location: confirm_order_admin.php");
    exit;
}
?>
