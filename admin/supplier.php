<?php
require "../koneksi.php";

$query_supplier = $con->query("SELECT * FROM supplier");
$jumlahsupplier = mysqli_num_rows($query_supplier);

$query_barang = $con->query("SELECT * FROM barang");
$jumlahbarang = mysqli_num_rows($query_barang);

$query_stok = $con->query("SELECT stok.*, supplier.nama_supplier, barang.nama_barang FROM stok 
                        JOIN supplier ON stok.id_supplier = supplier.id_supplier 
                        JOIN barang ON stok.id_barang = barang.id_barang");

$jumlahstok = mysqli_num_rows($query_stok);

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
    <title>Input Stok</title>
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
                    <i class="fas fa-truck"></i> Stok
                </li>
            </ol>
        </nav>
        
        <h2 class="mt-3">Tambah Stok</h2>
        <?php if ($pesan): ?>
            <div class="alert alert-info"><?= $pesan; ?></div>
        <?php endif; ?>
        <div class="my-5 col-12 md-4 lg-4">
            <div class="mt-4">
                <form action="tambah_stok.php" method="POST">
                    <div class="mb-3">
                        <label for="id_supplier" class="form-label">Supplier</label>
                        <select class="form-control" id="id_supplier" name="id_supplier" required>
                            <?php while ($supplier = mysqli_fetch_assoc($query_supplier)) { ?>
                                <option value="<?= $supplier['id_supplier']; ?>"><?= $supplier['nama_supplier']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="id_barang" class="form-label">Produk</label>
                        <select class="form-control" id="id_barang" name="id_barang" required>
                            <?php while ($barang = mysqli_fetch_assoc($query_barang)) { ?>
                                <option value="<?= $barang['id_barang']; ?>"><?= $barang['nama_barang']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="tanggal" class="form-label">Tanggal</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                    </div>
                    <div class="mb-3">
                        <label for="qty" class="form-label">Qty</label>
                        <input type="number" class="form-control" id="qty" name="qty" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Tambah Stok</button>
                </form>
            </div>
        </div>
        
        <h2 class="mt-3">List Stok</h2>
        <div class="table-responsive mt-3">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Supplier</th>
                        <th>Produk</th>
                        <th>Tanggal</th>
                        <th>Qty</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                if ($jumlahstok == 0) {
                    ?>
                    <tr>
                        <td colspan="6" class="text-center">Data Kosong</td>
                    </tr>
                <?php
                } else {
                    $no = 1;
                    while ($stok = mysqli_fetch_assoc($query_stok)) {
                ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $stok['nama_supplier']; ?></td>
                            <td><?= $stok['nama_barang']; ?></td>
                            <td><?= $stok['tanggal']; ?></td>
                            <td><?= $stok['qty']; ?></td>
                            <td>
                                <a href="edit_stok.php?id=<?= $stok['id_stok']; ?>" class="btn btn-warning">Edit</a>
                                <a href="delete_stok.php?id=<?= $stok['id_stok']; ?>" class="btn btn-danger">Hapus</a>
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
