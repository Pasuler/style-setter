<?php
require "../koneksi.php";
session_start();

if (!isset($_SESSION['id_user'])) {
    header("Location: ../admin/login.php");
    exit;
}

$id_user = $_SESSION['id_user'];

$query_orders = mysqli_query($con, "SELECT orders.*, user.username 
                                FROM orders 
                                JOIN user ON orders.id_user = user.id_user 
                                WHERE orders.id_user = $id_user");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
    <title>My Orders</title>
    <style>
        .content-wrapper {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <?php
    include "../components/navbar_home.php";
    ?>
    <div class="container content mt-5">
        <h1 class="mb-4">My Orders</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Total Harga</th>
                    <th>Status</th>
                    <th>Order Date</th>
                    <th>Detail Order</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($order = mysqli_fetch_assoc($query_orders)) : ?>
                    <tr>
                        <td><?php echo $order['id_order']; ?></td>
                        <td>Rp. <?php echo number_format($order['total_harga'], 0, ',', '.'); ?></td>
                        <td><?php echo $order['status']; ?></td>
                        <td><?php echo $order['created_at']; ?></td>
                        <td>
                            <a href="order_confirmation.php?id_order=<?php echo $order['id_order']; ?>&return_url=user_orders.php" class="btn btn-info btn-sm">Lihat Detail</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
    <?php
    include "../components/footer_home.php";
    ?>
</body>

<script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../fontawesome/js/all.min.js"></script>

</html>