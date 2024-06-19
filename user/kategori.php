<?php
require "../koneksi.php";
session_start();

$query_kategori = mysqli_query($con, "SELECT * FROM kategori LIMIT 5");

$barang = [];
if (isset($_GET['id_kategori'])) {
    $id_kategori = $_GET['id_kategori'];
    $query_barang = mysqli_query($con, "SELECT detail_barang.id_detail_barang, detail_barang.harga, detail_barang.gambar, barang.nama_barang 
                                        FROM detail_barang 
                                        JOIN barang ON detail_barang.id_barang = barang.id_barang
                                        WHERE detail_barang.id_kategori = $id_kategori ");
    while ($row = mysqli_fetch_assoc($query_barang)) {
        $barang[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Source+Sans+3:wght@200..900&display=swap" rel="stylesheet">
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
            border-radius: 15px;
            object-fit: cover;
        }

        .card-custom {
            border-radius: 15px;
            box-shadow: rgba(0, 0, 0, 0.1) 0px 1px 2px 0px;
        }

        .alert-custom {
            background-color: #000;
            color: #fff;
        }
    </style>
    <title>Document</title>
</head>

<body>
    <!-- Navbar -->
    <?php
    require "../components/navbar_home.php";
    ?>

    <!-- Carousel -->
    <?php
    require "../components/carousel.php";
    ?>

    <div class="container mt-4 bg-dark" style="border-radius: 15px;">
        <div class="row text-white text-center pb-5 ">
            <h1 class="pt-5 mt-3 source-sans-3-700 display-4">List Kategori</h1><br>
            <h5 class="mt-2 mb-3">Choose <span class="text-warning"></span> Kategori</h5>
        </div>
        <div class="row pb-5 mb-3">
            <div class="col-1"></div>
            <?php while ($kategori = mysqli_fetch_assoc($query_kategori)) : ?>
                <div class="col-2">
                    <a href="?id_kategori=<?php echo $kategori['id_kategori']; ?>">
                        <img src="../assets/img/<?php echo $kategori['gambar']; ?>" alt="<?php echo $kategori['nama_kategori']; ?>" style="width: 100%; height: 220px;  border-radius: 15px;">
                    </a>
                </div>
            <?php endwhile; ?>
            <div class="col-1"></div>
        </div>
    </div>

    <div class="container mt-4">
        <div class="row">
            <?php if (!empty($barang)) : ?>
                <?php foreach ($barang as $data) : ?>
                    <div class="col-md-3 mb-4">
                        <div class="card card-custom">
                            <img src="../assets/img/<?php echo $data['gambar'] ?>" class="card-img-top" alt="..." style="height: 330px;">
                            <div class="card-body mb-2">
                                <h5 class="card-title source-sans-3-600"><?php echo $data['nama_barang'] ?></h5>
                                <h5 class="pt-1 text-muted source-sans-3-600"><?php echo $data['harga'] ?></h5>
                                <div class="mt-3 d-grid gap-2 source-sans-3-700">
                                    <a href="detail_produk.php?id_detail_barang=<?php echo $data['id_detail_barang'] ?>" class="btn btn-primary" style="border-radius: 13px;">Detail Produk</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
            <?php endif; ?>
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