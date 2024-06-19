<?php
require "../koneksi.php";
session_start();

if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'Admin') {
    header("Location: ../admin/login.php");
    exit;
}

if (isset($_POST['confirm_payment'])) {
    $id_order = $_POST['id_order'];
    $query_update = mysqli_query($con, "UPDATE orders SET status='Pembayaran Berhasil' WHERE id_order=$id_order");
    if ($query_update) {
        $_SESSION['message'] = "Pembayaran berhasil dikonfirmasi.";
        header("Location: confirm_order_admin.php");
        exit;
    } else {
        $_SESSION['message'] = "Gagal mengkonfirmasi pembayaran.";
        header("Location: confirm_order_admin.php");
        exit;
    }
}

if (isset($_POST['reject_payment'])) {
    $id_order = $_POST['id_order'];
    $query_update = mysqli_query($con, "UPDATE orders SET status='Pembayaran Ditolak' WHERE id_order=$id_order");
    if ($query_update) {
        $_SESSION['message'] = "Pembayaran berhasil ditolak.";
        header("Location: confirm_order_admin.php");
        exit;
    } else {
        $_SESSION['message'] = "Gagal menolak pembayaran.";
        header("Location: confirm_order_admin.php");
        exit;
    }
}

$message = '';
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']);
}

$query_orders = mysqli_query($con, "SELECT orders.*, user.username 
                                FROM orders 
                                JOIN user ON orders.id_user = user.id_user");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
    <title>Confirm Order</title>
</head>
<body>
    <!-- Navbar -->
    <?php include "../components/navbar.php"; ?>
    <div class="container content mt-5">
        <h1 class="mb-4">Order Confirmation</h1>
        <?php if ($message) : ?>
            <div class="alert alert-info">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Username</th>
                    <th>Total Harga</th>
                    <th>Status</th>
                    <th>Order Date</th>
                    <th>Bukti Pembayaran</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($order = mysqli_fetch_assoc($query_orders)) : ?>
                    <tr>
                        <td><?php echo $order['id_order']; ?></td>
                        <td><?php echo $order['username']; ?></td>
                        <td>Rp. <?php echo number_format($order['total_harga'], 0, ',', '.'); ?></td>
                        <td><?php echo $order['status']; ?></td>
                        <td><?php echo $order['created_at']; ?></td>
                        <td>
                            <?php if (!empty($order['payment_proof'])) : ?>
                                <?php
                                $file_path = $order['payment_proof'];
                                if (file_exists($file_path) && filesize($file_path) <= 2 * 1024 * 1024) {
                                ?>
                                    <a href="<?php echo $file_path; ?>" download class="btn btn-primary btn-sm">Download Bukti Pembayaran</a>
                                <?php } else { ?>
                                    <span class="text-danger">File tidak tersedia atau melebihi 2 MB</span>
                                <?php } ?>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if ($order['status'] == 'Pending' && !empty($order['payment_proof'])) : ?>
                                <form action="confirm_order_admin.php" method="post" style="display: inline;">
                                    <input type="hidden" name="id_order" value="<?php echo $order['id_order']; ?>">
                                    <button type="submit" name="confirm_payment" class="btn btn-success btn-sm">Terima</button>
                                </form>
                                <form action="confirm_order_admin.php" method="post" style="display: inline;">
                                    <input type="hidden" name="id_order" value="<?php echo $order['id_order']; ?>">
                                    <button type="submit" name="reject_payment" class="btn btn-danger btn-sm">Tolak</button>
                                </form>
                            <?php elseif ($order['status'] != 'Pending') : ?>
                                <form action="delete_order.php" method="post" style="display: inline;">
                                    <input type="hidden" name="id_order" value="<?php echo $order['id_order']; ?>">
                                    <button type="submit" name="delete_order" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <div class="mb-5">
            <a href="index.php" class="btn btn-secondary">Kembali ke Dashboard</a>
        </div>
    </div>
</body>
</html>
