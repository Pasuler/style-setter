<?php
require "../koneksi.php";
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
    <title>Filter Fuzzy</title>
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
                    <i class="fas fa-filter"></i> Filter Fuzzy
                </li>
            </ol>
        </nav>

        <h2 class="mt-3">Filter Produk Menggunakan Fuzzy Tsukamoto</h2>
        <div class="my-5">
            <div class="mt-4">
                <form action="filter_action.php" method="POST">
                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga</label>
                        <input type="number" class="form-control" id="harga" name="harga" required>
                    </div>
                    <div class="mb-3">
                        <label for="rating" class="form-label">Rating</label>
                        <input type="number" step="0.1" class="form-control" id="rating" name="rating" min="0" max="5" required>
                    </div>
                    <div class="mb-3">
                        <label for="penjualan" class="form-label">Penjualan</label>
                        <input type="number" class="form-control" id="penjualan" name="penjualan" required>
                    </div>
                    <button type="submit" class="btn btn-primary mb-3">Filter Produk</button>
                </form>
            </div>
        </div>
    </div>

    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../fontawesome/js/all.min.js"></script>
</body>

</html>
