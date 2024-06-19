<?php
require "../koneksi.php";
session_start();

$query_produk = mysqli_query($con, "SELECT detail_barang.id_detail_barang, detail_barang.harga, detail_barang.gambar, barang.nama_barang 
                                    FROM detail_barang 
                                    JOIN barang ON detail_barang.id_barang = barang.id_barang 
                                    LIMIT 16");

$produk = [];
while ($row = mysqli_fetch_assoc($query_produk)) {
    $produk[] = $row;
}

$produk_baju_pria = array_slice($produk, 0, 4);
$produk_baju_wanita = array_slice($produk, 4, 4);
$produk_tas = array_slice($produk, 8, 8);
$produk_sepatu = array_slice($produk, 12, 12);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Source+Sans+3:wght@200..900&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        .poppins-regular {
            font-family: "Poppins", sans-serif;
            font-weight: 400;
            font-style: normal;
        }

        .poppins-semibold {
            font-family: "Poppins", sans-serif;
            font-weight: 600;
            font-style: normal;
        }

        .source-sans-3-600 {
            font-family: "Source Sans 3", sans-serif;
            font-optical-sizing: auto;
            font-weight: 600;
            font-style: normal;
        }

        .source-sans-3-700 {
            font-family: "Source Sans 3", sans-serif;
            font-optical-sizing: auto;
            font-weight: 700;
            font-style: normal;
        }

        .custom-border {
            position: relative;
            padding-left: 20px;
        }

        .custom-border::before {
            content: "";
            position: absolute;
            left: 0;
            top: 40%;
            transform: translateY(-50%);
            width: 5px;
            height: 80%;
            background-color: #54ccff;
            border-radius: 5px;
        }

        .card-img-top {
            border-radius: 50px;
            padding: 17px;
        }

        .card-custom {
            border-radius: 30px;
            box-shadow: rgba(0, 0, 0, 0.1) 0px 1px 2px 0px;
        }
    </style>
    <title>Document</title>
</head>

<body>
    <!-- Navbar -->
    <?php
    require "../components/navbar_home.php"
    ?>
    <?php
    require "../components/carousel.php"
    ?>
    <div class="container">
        <div class="row">
            <div class="custom-border mt-5 ms-3">
                <h3 class="poppins-semibold">New Arrivals</h3>
            </div>
        </div>
        <div class="row row-cols-1 row-cols-md-4 g-4 py-4">
            <?php foreach ($produk_baju_pria as $data) { ?>
                <div class="col">
                    <div class="card card-custom">
                        <img src="../assets/img/<?php echo $data['gambar'] ?>" class="card-img-top" alt="..." style="height: 330px;">
                        <div class="card-body mb-2 ">
                            <h5 class="card-title source-sans-3-600"><?php echo $data['nama_barang'] ?></h5>
                            <h5 class="pt-1 text-muted source-sans-3-600"><?php echo $data['harga'] ?></h5>
                            <div class="mt-3 d-grid gap-2 source-sans-3-700">
                                <a href="detail_produk.php?id_detail_barang=<?php echo $data['id_detail_barang'] ?>" class="btn btn-primary" style="border-radius: 13px;">Detail Produk</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <div class="container mt-4 bg-dark" style="border-radius: 15px;">
        <div class="row text-white text-center pb-5">
            <h1 class="pt-5 mt-3 source-sans-3-700 display-4">Top Ketegori</h1><br>
            <h5 class="mt-2 mb-3">Up To <span class="text-warning">60%</span> off on brands</h5>
        </div>
        <div class="row pb-5">
            <div class="col-1"></div>
            <div class="col-2">
                <a href="kategori.php">
                    <img src="../assets/img/tas.jpg" alt="" style="width: 100%; height: 220px;  border-radius: 15px;">
                </a>
            </div>
            <div class="col-2">
                <a href="kategori.php">
                    <img src="../assets/img/shoes.jpg" alt="" style="width: 100%;  height: 220px; border-radius: 15px;">
                </a>
            </div>
            <div class="col-2">
                <a href="kategori.php">
                    <img src="../assets/img/rolex.jpg" alt="" style="width: 100%; height: 220px;  border-radius: 15px;">
                </a>
            </div>
            <div class="col-2">
                <a href="kategori.php">
                    <img src="../assets/img/women.jpg" alt="" style="width: 100%;  height: 220px; border-radius: 15px;">
                </a>
            </div>
            <div class="col-2">
                <a href="kategori.php">
                    <img src="../assets/img/boy.jpg" alt="" style="width: 100%;  height: 220px; border-radius: 15px;">
                </a>
            </div>
            <div class="col-1"></div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="custom-border mt-3 ms-3">
                <h3 class="poppins-semibold">Big Saving Zone</h3>
            </div>
        </div>
        <div class="row row-cols-1 row-cols-md-4 g-4 py-4">
            <?php foreach ($produk_baju_wanita as $data) { ?>
                <div class="col">
                    <div class="card card-custom">
                        <img src="../assets/img/<?php echo $data['gambar'] ?>" class="card-img-top" alt="..." style="height: 330px;">
                        <div class="card-body mb-2 ">
                            <h5 class="card-title source-sans-3-600"><?php echo $data['nama_barang'] ?></h5>
                            <h5 class="pt-1 text-muted source-sans-3-600"><?php echo $data['harga'] ?></h5>
                            <div class="mt-3 d-grid gap-2 source-sans-3-700">
                                <a href="detail_produk.php?id_detail_barang=<?php echo $data['id_detail_barang'] ?>" class="btn btn-primary" style="border-radius: 13px;">Detail Produk</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="custom-border mt-5 ms-3">
                <h3 class="poppins-semibold">New Arrivals</h3>
            </div>
        </div>
        <div class="row row-cols-1 row-cols-md-4 g-4 py-4">
            <?php foreach ($produk_sepatu as $data) { ?>
                <div class="col">
                    <div class="card card-custom">
                        <img src="../assets/img/<?php echo $data['gambar'] ?>" class="card-img-top" alt="..." style="height: 330px;">
                        <div class="card-body mb-2 ">
                            <h5 class="card-title source-sans-3-600"><?php echo $data['nama_barang'] ?></h5>
                            <h5 class="pt-1 text-muted source-sans-3-600"><?php echo $data['harga'] ?></h5>
                            <div class="mt-3 d-grid gap-2 source-sans-3-700">
                                <a href="detail_produk.php?id_detail_barang=<?php echo $data['id_detail_barang'] ?>" class="btn btn-primary" style="border-radius: 13px;">Detail Produk</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <!-- Footer -->
    <?php 
    require "../components/footer_home.php";
    ?>
</body>

<script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../fontawesome/js/all.min.js"></script>

</html>
