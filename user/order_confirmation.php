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

$query = mysqli_query($con, "SELECT orders.*, user.username 
                            FROM orders 
                            JOIN user ON orders.id_user = user.id_user 
                            WHERE orders.id_order = $id_order");
$order = mysqli_fetch_assoc($query);

$query_items = mysqli_query($con, "SELECT order_items.*, detail_barang.id_barang, detail_barang.gambar, barang.nama_barang 
                                FROM order_items 
                                JOIN detail_barang ON order_items.id_detail_barang = detail_barang.id_detail_barang 
                                JOIN barang ON detail_barang.id_barang = barang.id_barang
                                WHERE order_items.id_order = $id_order");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
    <title>Order Confirmation</title>
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
    <?php require "../components/navbar_home.php"; ?>

    <div class="container content mt-5">
        <h1 class="mb-4">Order Confirmation</h1>
        <div class="mb-4">
            <h4>Order ID: <?php echo $order['id_order']; ?></h4>
            <h4>Username: <?php echo $order['username']; ?></h4>
            <h4>Total Harga: Rp. <?php echo number_format($order['total_harga'], 0, ',', '.'); ?></h4>
            <h4>Status: <?php echo $order['status']; ?></h4>
            <h4>Order Date: <?php echo $order['created_at']; ?></h4>
        </div>
        <h4>Order Items:</h4>
        <table class="table">
            <thead>
                <tr>
                    <th>Gambar</th>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($item = mysqli_fetch_assoc($query_items)) : ?>
                    <tr>
                        <td><img src="../assets/img/<?php echo $item['gambar']; ?>" alt="<?php echo $item['nama_barang']; ?>" style="width: 100px; height: auto;"></td>
                        <td><?php echo $item['nama_barang']; ?></td>
                        <td><?php echo $item['jumlah_barang']; ?></td>
                        <td>Rp. <?php echo number_format($item['harga'], 0, ',', '.'); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <?php if ($order['status'] != 'Pembayaran Berhasil') : ?>
            <div class="mb-5">
                <form action="aksi_order_confirmation.php?id_order=<?php echo $id_order; ?>" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="payment_proof" class="form-label">Upload Bukti Pembayaran</label>
                        <input type="file" class="form-control" id="payment_proof" name="payment_proof" required>
                    </div>
                    <button type="submit" name="upload_payment" class="btn btn-primary">Upload Pembayaran</button>
                </form>
            </div>
        <?php endif; ?>
        <div class="mb-5">
            <a href="index.php" class="btn btn-secondary">Kembali ke Beranda</a>
        </div>
    </div>

    <!-- Footer -->
    <?php require "../components/footer_home.php"; ?>

    <!-- Bootstrap JS -->
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../fontawesome/js/all.min.js"></script>
</body>

</html>
