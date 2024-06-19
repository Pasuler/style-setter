<?php
require "../koneksi.php";

$id_barang = isset($_GET['id']) ? $_GET['id'] : '';
$query_produk = mysqli_query($con, "SELECT * FROM barang WHERE id_barang = '$id_barang'");
$produk = mysqli_fetch_assoc($query_produk);

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
    <title>Edit Produk</title>
</head>

<body>
    <?php require "../components/navbar.php"; ?>
    <div class="container mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="index.php"><i class="fas fa-home"></i> Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="produk.php"><i class="fas fa-cube"></i> produk</a>
                </li>
                <li class="breadcrumb-item active">
                    <a href=""><i class="fa-solid fa-pen-to-square"></i> Edit</a>
                </li>
            </ol>
        </nav>

        <h2 class="mt-3">Edit Produk</h2>
        <div class="my-5 col-12 md-4 lg-4">
            <div class="mt-4">
                <form action="aksi_edit_produk.php" method="POST">
                    <input type="hidden" name="id_barang" value="<?= $produk['id_barang']; ?>">
                    <div class="mb-3">
                        <label for="kode_barang" class="form-label">Kode Barang</label>
                        <input type="text" class="form-control" id="kode_barang" name="kode_barang" value="<?= $produk['kode_barang']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="nama_barang" class="form-label">Nama Barang</label>
                        <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="<?= $produk['nama_barang']; ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Produk</button>
                </form>
            </div>
        </div>
    </div>

    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../fontawesome/js/all.min.js"></script>
</body>

</html>
