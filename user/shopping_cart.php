<?php
require "../koneksi.php";
session_start();
if (!isset($_SESSION['id_user'])) {
    header("Location: ../admin/login.php");
    exit;
}

$id_user = $_SESSION['id_user'];

$query = mysqli_query($con, "SELECT cart.*, detail_barang.id_barang, detail_barang.harga, detail_barang.gambar, barang.nama_barang 
                            FROM cart 
                            JOIN detail_barang ON cart.id_detail_barang = detail_barang.id_detail_barang 
                            JOIN barang ON detail_barang.id_barang = barang.id_barang
                            WHERE cart.id_user = $id_user");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
    <title>Keranjang Belanja</title>
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
    <?php include "../components/navbar_home.php"; ?>

    <div class="container content mt-5">
        <h1 class="mb-4">Keranjang Belanja</h1>
        <form action="checkout.php" method="post">
            <table class="table">
                <thead>
                    <tr>
                        <th>Pilih</th>
                        <th>Gambar</th>
                        <th>Nama Barang</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Total Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (mysqli_num_rows($query) > 0) : ?>
                        <?php while ($row = mysqli_fetch_assoc($query)) : ?>
                            <tr>
                                <td><input type="checkbox" name="selected_items[]" value="<?php echo $row['id_cart']; ?>"></td>
                                <td><img src="../assets/img/<?php echo $row['gambar']; ?>" alt="<?php echo $row['nama_barang']; ?>" style="width: 100px; height: auto;"></td>
                                <td><?php echo $row['nama_barang']; ?></td>
                                <td>Rp. <?php echo number_format($row['harga'], 0, ',', '.'); ?></td>
                                <td><?php echo $row['jumlah_barang']; ?></td>
                                <td>Rp. <?php echo number_format($row['total_harga'], 0, ',', '.'); ?></td>
                                <td>
                                    <a href="remove_from_cart.php?id_cart=<?php echo $row['id_cart']; ?>" class="btn btn-danger">Hapus</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else : ?>
                        <tr>
                            <td class="table-empty" colspan="7">Keranjang belanja Anda kosong.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
            <?php if (mysqli_num_rows($query) > 0) : ?>
                <div class="mb-5 d-flex justify-content-between">
                    <button type="submit" name="remove_selected" class="btn btn-danger">Hapus Barang Terpilih</button>
                    <button type="submit" name="checkout_selected" class="btn btn-primary">Checkout</button>
                </div>
            <?php endif; ?>
        </form>
    </div>

    <!-- Footer -->
    <?php include "../components/footer_home.php"; ?>


</body>
<script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../fontawesome/js/all.min.js"></script>

</html>