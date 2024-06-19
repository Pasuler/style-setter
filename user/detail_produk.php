<?php
require "../koneksi.php";
session_start();

if (isset($_GET['id_detail_barang'])) {
    $id_detail_barang = $_GET['id_detail_barang'];
    $query = mysqli_query($con, "SELECT detail_barang.*, barang.nama_barang 
                                FROM detail_barang 
                                JOIN barang ON detail_barang.id_barang = barang.id_barang
                                WHERE detail_barang.id_detail_barang = $id_detail_barang");

    $data = mysqli_fetch_assoc($query);
} else {
    echo "ID Detail Barang tidak ditemukan.";
    exit;
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
    <title>Detail Produk</title>
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

        .card-custom-2 {
            border-radius: 15px;
            box-shadow: rgba(0, 0, 0, 0.1) 0px 1px 2px 0px;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <?php
    require "../components/navbar_home.php";
    ?>

    <!-- Content -->
    <div class="container">
        <div class="row ps-1">
            <div class="col-12 mt-4">
                <h1 class="text-start source-sans-3-700">Detail Produk</h1>
            </div>
        </div>
        <div class="row mt-2 mb-4">
            <div class="row mx-1 mb-4">
                <div class="card card-custom">
                    <div class="card-body">
                        <div class="row my-4">
                            <div class="col-lg-4">
                                <img class="ms-1" src="../assets/img/<?php echo $data['gambar'] ?>" alt="<?php echo $data['nama_barang'] ?>" style="width: 100%; border-radius: 18px;">
                            </div>
                            <div class="col-lg-8 ps-3 poppins-semibold">
                                <div class="wrapper-bradcumb mt-2">
                                    <ol class="breadcrumb 0">
                                        <li class="breadcrumb-item source-sans-3-600">Home</li>
                                        <li class="breadcrumb-item source-sans-3-600">Kategori</li>
                                        <li class="breadcrumb-item active source-sans-3-600" aria-current="page">Detail Produk</li>
                                    </ol>
                                </div>
                                <div class="row pt-1">
                                    <h1 class="source-sans-3-700"><?php echo $data['nama_barang'] ?></h1>
                                    <h3 class="source-sans-3-600 text-muted mt-3 mb-4">Rp. <?php echo number_format($data['harga'], 0, ',', '.') ?></h3>
                                </div>
                                <div class="row mb-3 me-1">
                                    <div class="custom-border mt-3 ms-3 mb-3">
                                        <h5 class="poppins-semibold pb-1">Deskripsi</h5>
                                    </div>
                                    <p class="poppins-regular ms-1"><?php echo $data['detail'] ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mx-1 mb-3">
                <div class="card card-custom">
                    <div class="card-body">
                        <div class="row mt-3 mb-3 source-sans-3-700">
                            <div class="col-12 custom-border ms-3 mb-2">
                                <h5 class="poppins-semibold pb-1">Atur Jumlah dan Total Harga</h5>
                            </div>
                            <form action="add_to_cart.php" method="post">
                                <input type="hidden" name="id_detail_barang" value="<?php echo $data['id_detail_barang']; ?>">
                                <div class="row px-1">
                                    <div class="col-6 mb-3">
                                        <label for="exampleNumber" class="col-form-label">Jumlah Barang</label>
                                        <div class="input-group">
                                            <button class="btn btn-outline-secondary" type="button" id="button-decrement">-</button>
                                            <input type="number" name="jumlah_barang" class="form-control text-center" id="exampleNumber" value="1" min="1" max="100">
                                            <button class="btn btn-outline-secondary" type="button" id="button-increment">+</button>
                                        </div>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label for="totalHarga" class="col-form-label">Harga Per PCS</label>
                                        <input type="text" readonly class="form-control-plaintext" id="totalHarga" value="Rp.<?php echo number_format($data['harga'], 0, ',', '.'); ?>">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary mt-2" style="border-radius: 13px; width: 100%;">Tambah Ke Keranjang</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <?php
    require "../components/footer_home.php";
    ?>
</body>

<script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../fontawesome/js/all.min.js"></script>
<script>
    document.getElementById('button-decrement').addEventListener('click', function() {
        var input = document.getElementById('exampleNumber');
        var currentValue = parseInt(input.value);
        if (!isNaN(currentValue) && currentValue > parseInt(input.min)) {
            input.value = currentValue - 1;
        }
    });

    document.getElementById('button-increment').addEventListener('click', function() {
        var input = document.getElementById('exampleNumber');
        var currentValue = parseInt(input.value);
        if (!isNaN(currentValue) && currentValue < parseInt(input.max)) {
            input.value = currentValue + 1;
        }
    });
</script>

</html>
