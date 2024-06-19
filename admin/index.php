<?php
require "../koneksi.php";
require "session.php";

$query_kategori = $con->query("SELECT * FROM kategori");
$jumlahkategori = mysqli_num_rows($query_kategori);

$query_barang = $con->query("SELECT * FROM barang");
$jumlahbarang = mysqli_num_rows($query_barang);

$query_supplier = $con->query("SELECT * FROM stok");
$jumlahsupplier = mysqli_num_rows($query_supplier);

$query_pelanggan = $con->query("SELECT * FROM pelanggan");
$jumlahpelanggan = mysqli_num_rows($query_pelanggan);

$query_detail_produk = $con->query("SELECT * FROM detail_barang");
$jumlahdetailproduk = mysqli_num_rows($query_detail_produk);

$username = $_SESSION['username'];

$user_data = $con->query("SELECT user.id_user, pelanggan.nama FROM user 
JOIN pelanggan ON pelanggan.id_user=user.id_user WHERE username = '$username'");
$user = $user_data->fetch_array();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
    <title>Dashboard</title>
</head>

<style>
    .border-left-info {
        border-left: 0.25rem solid #36b9cc !important;
    }

    .border-left-primary {
        border-left: 0.25rem solid #4e73df !important;
    }

    .border-left-secondary {
        border-left: 0.25rem solid #858796 !important;
    }

    .border-left-success {
        border-left: 0.25rem solid #1cc88a !important;
    }

    .border-left-warning {
        border-left: 0.25rem solid #f6c23e !important;
    }

    .border-left-danger {
        border-left: 0.25rem solid #e74a3b !important;
    }

    .border-left-light {
        border-left: 0.25rem solid #f8f9fc !important;
    }

    .border-left-dark {
        border-left: 0.25rem solid #5a5c69 !important;
    }

    .kotak {
        border: 1px solid black;
    }

    .summary-kategori {
        background-color: #0a6b4a;
        border-radius: 15px;
    }

    .summary-produk {
        background-color: #0a516b;
        border-radius: 15px;
    }

    .summary-supplier {
        background-color: #6b0a39;
        border-radius: 15px;
    }

    .summary-pelanggan {
        background-color: #6b4a0a;
        border-radius: 15px;
    }

    .summary-detail-produk {
        background-color: #C73659;
        border-radius: 15px;
    }

    .summary-order-admin {
        background-color: #7B68EE;
        border-radius: 15px;
    }
</style>

<body>
    <?php require "../components/navbar.php"; ?>
    <div class="container mt-5">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">
                        <i class="fas fa-home"></i> Home
                    </li>
                </ol>
            </nav>
            <h2>Halo <?php echo htmlspecialchars($user['nama']); ?></h2>
        </div>
        <div class="container mt-4">
            <div class="row">
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs fw-bold text-success fs-4 mb-1">
                                        Kategori</div>
                                    <div class="h5 mb-0 text-muted"><?php echo $jumlahkategori; ?> Kategori</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fa-solid fa-list fa-2x text-success"></i>
                                </div>
                            </div>
                            <div class="row px-2 pt-3">
                                <a class="btn btn-success btn-sm text-white" href="kategori.php" role="button">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs fw-bold text-primary fs-4 mb-1">
                                        Produk</div>
                                    <div class="h5 mb-0 text-muted"><?php echo $jumlahbarang; ?> Produk</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fa-solid fa-shirt fa-2x text-primary"></i>
                                </div>
                            </div>
                            <div class="row px-2 pt-3">
                                <a class="btn btn-primary btn-sm text-white" href="produk.php" role="button">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs fw-bold text-info fs-4 mb-1">
                                        Supplier</div>
                                    <div class="h5 mb-0 text-muted"><?php echo $jumlahsupplier; ?> Supplier</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fa-solid fa-truck-ramp-box fa-2x text-info"></i>
                                </div>
                            </div>
                            <div class="row px-2 pt-3">
                                <a class="btn btn-info btn-sm text-white" href="supplier.php" role="button">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs fw-bold text-warning fs-4 mb-1">
                                        Pelanggan</div>
                                    <div class="h5 mb-0 text-muted"><?php echo $jumlahpelanggan; ?> Pelanggan</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fa-solid fa-users fa-2x text-warning"></i>
                                </div>
                            </div>
                            <div class="row px-2 pt-3">
                                <a class="btn btn-warning btn-sm text-white" href="pelanggan.php" role="button">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs fw-bold text-info fs-4 mb-1">
                                        Detail Produk</div>
                                    <div class="h5 mb-0 text-muted"><?php echo $jumlahdetailproduk; ?> Detail Produk</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fa-solid fa-eye fa-2x text-info"></i>
                                </div>
                            </div>
                            <div class="row px-2 pt-3">
                                <a class="btn btn-info btn-sm text-white" href="detail_produk.php" role="button">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs fw-bold text-primary fs-4 mb-1">
                                        Confirm Orders</div>
                                    <div class="h5 mb-0 text-muted">Manage Orders</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fa-solid fa-file-pen fa-2x text-primary"></i>
                                </div>
                            </div>
                            <div class="row px-2 pt-3">
                                <a class="btn btn-primary btn-sm text-white" href="confirm_order_admin.php" role="button">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="my-2">
                <a href="logout.php" class="btn btn-danger">Logout</a>
                <a href="../user/index.php" class="btn btn-primary">Home User</a>
            </div>
        </div>
        <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="../fontawesome/js/all.min.js"></script>
</body>

</html>