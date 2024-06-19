<?php
require "../koneksi.php";
session_start();

if (!isset($_SESSION['id_user'])) {
    header("Location: ../admin/login.php");
    exit;
}

if (!isset($_GET['id_order'])) {
    echo "Order tidak ditemukan.";
    exit;
}

$id_order = $_GET['id_order'];

if (isset($_POST['upload_payment'])) {
    $target_dir = "../assets/payment_proof/";
    $target_file = $target_dir . basename($_FILES["payment_proof"]["name"]);
    move_uploaded_file($_FILES["payment_proof"]["tmp_name"], $target_file);

    $stmt = $con->prepare("UPDATE orders SET status=?, payment_proof=? WHERE id_order=?");
    $status = 'Pending';
    $stmt->bind_param('ssi', $status, $target_file, $id_order);

    if ($stmt->execute()) {
        header("Location: order_confirmation.php?id_order=$id_order");
        exit;
    } else {
        echo "Gagal mengupload bukti pembayaran.";
    }
}
?>
