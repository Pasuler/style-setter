<?php
require "../koneksi.php";

$query_produk = mysqli_query($con, "SELECT * from barang;");
$jumlahproduk = mysqli_num_rows($query_produk);

$pesan = isset($_GET['pesan']) ? $_GET['pesan'] : '';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
    <style>
        .breadcrumb a {
            text-decoration: none;
            color: inherit;
        }
    </style>
    <title>Tambah Produk</title>
</head>

<body>
    <?php require "../components/navbar.php"; ?>
    <div class="container mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="index.php"><i class="fas fa-home"></i> Home</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    <i class="fas fas fa-cube"></i> Produk
                </li>
            </ol>
        </nav>
        
        <h2 class="mt-3">Tambah Produk</h2>
        <?php if ($pesan): ?>
            <div class="alert alert-info"><?= $pesan; ?></div>
        <?php endif; ?>
        <div class="my-5 col-12 md-4 lg-4">
            <div class="mt-4">
                <form action="tambah_produk.php" method="POST">
                    <div class="mb-3">
                        <label for="kode_barang" class="form-label">Kode Barang</label>
                        <input type="text" class="form-control" id="kode_barang" name="kode_barang" required>
                    </div>
                    <div class="mb-3">
                        <label for="nama_barang" class="form-label">Nama Barang</label>
                        <input type="text" class="form-control" id="nama_barang" name="nama_barang" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Tambah Produk</button>
                </form>
            </div>
        </div>
        
        <h2 class="mt-3">List Produk</h2>
        <div class="table-responsive mt-3">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                if ($jumlahproduk == 0) {
                    ?>
                    <tr>
                        <td colspan="6" class="text-center">Data Kosong</td>
                    </tr>
                <?php
                } else {
                    $no = 1;
                    while ($produk = mysqli_fetch_assoc($query_produk)) {
                ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $produk['kode_barang']; ?></td>
                            <td><?= $produk['nama_barang']; ?></td>
                            <td>
                                <a href="edit_produk.php?id=<?= $produk['id_barang']; ?>" class="btn btn-warning">Edit</a>
                                <form action="delete_produk.php" method="POST" style="display:inline;">
                                    <input type="hidden" name="id_barang" value="<?= $produk['id_barang']; ?>">
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                <?php
                    }
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
    
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../fontawesome/js/all.min.js"></script>
</body>

</html>
