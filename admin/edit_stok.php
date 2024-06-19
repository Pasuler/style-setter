<?php
require "../koneksi.php";

$id_stok = $_GET['id'];
$query_stok = $con->query("SELECT * FROM stok WHERE id_stok = '$id_stok'");
$stok = mysqli_fetch_assoc($query_stok);

$query_supplier = $con->query("SELECT * FROM supplier");
$query_barang = $con->query("SELECT * FROM barang");

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
    <title>Edit Stok</title>
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
                    <a href="supplier.php"><i class="fas fa-truck"></i> Home</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    <i class="fa-solid fa-pen-to-square"></i> Edit Stok
                </li>
            </ol>
        </nav>
        
        <h2 class="mt-3">Edit Stok</h2>
        <div class="my-5 col-12 md-4 lg-4">
            <div class="mt-4">
                <form action="aksi_edit_stok.php" method="POST">
                    <input type="hidden" name="id_stok" value="<?= $stok['id_stok']; ?>">
                    <div class="mb-3">
                        <label for="id_supplier" class="form-label">Supplier</label>
                        <select class="form-control" id="id_supplier" name="id_supplier" required>
                            <?php while ($supplier = mysqli_fetch_assoc($query_supplier)) { ?>
                                <option value="<?= $supplier['id_supplier']; ?>" <?= $supplier['id_supplier'] == $stok['id_supplier'] ? 'selected' : ''; ?>>
                                    <?= $supplier['nama_supplier']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="id_barang" class="form-label">Produk</label>
                        <select class="form-control" id="id_barang" name="id_barang" required>
                            <?php while ($barang = mysqli_fetch_assoc($query_barang)) { ?>
                                <option value="<?= $barang['id_barang']; ?>" <?= $barang['id_barang'] == $stok['id_barang'] ? 'selected' : ''; ?>>
                                    <?= $barang['nama_barang']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="tanggal" class="form-label">Tanggal</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?= $stok['tanggal']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="qty" class="form-label">Qty</label>
                        <input type="number" class="form-control" id="qty" name="qty" value="<?= $stok['qty']; ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Stok</button>
                </form>
            </div>
        </div>
    </div>
    
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../fontawesome/js/all.min.js"></script>
</body>

</html>
