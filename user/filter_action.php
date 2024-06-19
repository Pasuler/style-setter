<?php
require "../koneksi.php";
session_start();

$harga = $_POST['harga'];
$rating = $_POST['rating'];
$penjualan = $_POST['penjualan'];

$fuzzy_value = null;

if ($harga < 0 || $rating < 0 || $rating > 5 || $penjualan < 0) {
    $z = "";
    echo "Maaf, data yang Anda masukkan tidak sesuai dengan rentang yang ditentukan!";
} else {
    if ($harga <= 50000) {
        $harga_murah = 1;
    } else if ($harga > 50000 && $harga < 150000) {
        $harga_murah = (150000 - $harga) / (150000 - 50000);
    } else if ($harga >= 150000) {
        $harga_murah = 0;
    }

    if ($harga <= 50000) {
        $harga_sedang = 0;
    } else if ($harga >= 250000) {
        $harga_sedang = 0;
    } else if ($harga > 50000 && $harga < 150000) {
        $harga_sedang = ($harga - 50000) / (150000 - 50000);
    } else if ($harga > 150000 && $harga < 250000) {
        $harga_sedang = (250000 - $harga) / (250000 - 150000);
    } else if ($harga == 150000) {
        $harga_sedang = 1;
    }

    if ($harga <= 150000) {
        $harga_mahal = 0;
    } else if ($harga > 150000 && $harga < 250000) {
        $harga_mahal = ($harga - 150000) / (250000 - 150000);
    } else if ($harga >= 250000) {
        $harga_mahal = 1;
    }

    if ($rating <= 2.5) {
        $rating_rendah = 1;
    } else if ($rating > 2.5 && $rating < 3.5) {
        $rating_rendah = (3.5 - $rating) / (3.5 - 2.5);
    } else if ($rating >= 3.5) {
        $rating_rendah = 0;
    }

    if ($rating <= 2.5) {
        $rating_sedang = 0;
    } else if ($rating >= 4.5) {
        $rating_sedang = 0;
    } else if ($rating > 2.5 && $rating < 3.5) {
        $rating_sedang = ($rating - 2.5) / (3.5 - 2.5);
    } else if ($rating > 3.5 && $rating < 4.5) {
        $rating_sedang = (4.5 - $rating) / (4.5 - 3.5);
    } else if ($rating == 3.5) {
        $rating_sedang = 1;
    }

    if ($rating <= 3.5) {
        $rating_tinggi = 0;
    } else if ($rating > 3.5 && $rating < 4.5) {
        $rating_tinggi = ($rating - 3.5) / (4.5 - 3.5);
    } else if ($rating >= 4.5) {
        $rating_tinggi = 1;
    }

    if ($penjualan <= 100) {
        $penjualan_rendah = 1;
    } else if ($penjualan > 100 && $penjualan < 300) {
        $penjualan_rendah = (300 - $penjualan) / (300 - 100);
    } else if ($penjualan >= 300) {
        $penjualan_rendah = 0;
    }
    
    if ($penjualan <= 100) {
        $penjualan_sedang = 0;
    } else if ($penjualan >= 500) {
        $penjualan_sedang = 0;
    } else if ($penjualan > 100 && $penjualan < 300) {
        $penjualan_sedang = ($penjualan - 100) / (300 - 100);
    } else if ($penjualan > 300 && $penjualan < 500) {
        $penjualan_sedang = (500 - $penjualan) / (500 - 300);
    } else if ($penjualan == 300) {
        $penjualan_sedang = 1;
    }

    if ($penjualan <= 300) {
        $penjualan_tinggi = 0;
    } else if ($penjualan > 300 && $penjualan < 500) {
        $penjualan_tinggi = ($penjualan - 300) / (500 - 300);
    } else if ($penjualan >= 500) {
        $penjualan_tinggi = 1;
    }

    $z1 = 0;
    $z2 = 0;
    $z3 = 0;
    $z4 = 0;
    $z5 = 0;
    $z6 = 0;

    $a1 = min($harga_murah, $rating_rendah, $penjualan_rendah); 
    $z1 = 100000 - $a1 * (100000 - 50000);

    $a2 = min($harga_murah, $rating_sedang, $penjualan_sedang); 
    $z2 = 100000 - $a2 * (100000 - 50000);

    $a3 = min($harga_sedang, $rating_rendah, $penjualan_rendah);
    $z3 = 100000 - $a3 * (100000 - 50000);

    $a4 = min($harga_sedang, $rating_sedang, $penjualan_sedang); 
    $z4 = $a4 * (100000 - 50000) + 50000;

    $a5 = min($harga_mahal, $rating_tinggi, $penjualan_rendah); 
    $z5 = $a5 * (100000 - 50000) + 50000;

    $a6 = min($harga_mahal, $rating_sedang, $penjualan_sedang);
    $z6 = $a6 * (100000 - 50000) + 50000;

    $total_AiZi = ($a1 * $z1) + ($a2 * $z2) + ($a3 * $z3) + ($a4 * $z4) + ($a5 * $z5) + ($a6 * $z6);
    $total_a = $a1 + $a2 + $a3 + $a4 + $a5 + $a6;

    if ($total_a != 0) {
        $z = $total_AiZi / $total_a;
        $fuzzy_value = $z;

        $id_detail_barang = 7; 
        $query_insert_fuzzy = "INSERT INTO fuzzy (id_detail_barang, harga, rating, penjualan, fuzzy_value) VALUES ('$id_detail_barang', '$harga', '$rating', '$penjualan', '$fuzzy_value')";
        mysqli_query($con, $query_insert_fuzzy);
    } else {
        $fuzzy_value = 0;
    }
}

$query_all_products = mysqli_query($con, "SELECT detail_barang.*, fuzzy.fuzzy_value, barang.nama_barang FROM detail_barang JOIN fuzzy ON detail_barang.id_detail_barang = fuzzy.id_detail_barang JOIN barang ON detail_barang.id_barang = barang.id_barang");
$products = [];
while ($row = mysqli_fetch_assoc($query_all_products)) {
    $distance = sqrt(pow(($row['harga'] - $harga), 2) + pow(($row['rating'] - $rating), 2) + pow(($row['penjualan'] - $penjualan), 2));
    $row['distance'] = $distance;
    $products[] = $row;
}

usort($products, function($a, $b) {
    return $a['distance'] <=> $b['distance'];
});
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
        .card-img-top {
            border-radius: 50px;
            padding: 17px;
        }

        .card-custom {
            border-radius: 30px;
            box-shadow: rgba(0, 0, 0, 0.1) 0px 1px 2px 0px;
        }
    </style>
    <title>Hasil Filter Fuzzy</title>
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
                    <a href="filter_form.php"><i class="fas fa-filter"></i> Filter Fuzzy</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    <i class="fas fa-list"></i> Hasil Filter
                </li>
            </ol>
        </nav>

        <h2 class="mt-3">Hasil Filter Produk</h2>

        <div class="table-responsive mt-3">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Variabel</th>
                        <th>Nilai</th>
                        <th>Derajat Keanggotaan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Harga</td>
                        <td>Rp <?php echo number_format($harga, 2, ",", "."); ?></td>
                        <td>
                            <span class="badge bg-primary">Murah (<?php echo round($harga_murah, 2); ?>)</span>
                            <span class="badge bg-warning">Sedang (<?php echo round($harga_sedang, 2); ?>)</span>
                            <span class="badge bg-danger">Mahal (<?php echo round($harga_mahal, 2); ?>)</span>
                        </td>
                    </tr>
                    <tr>
                        <td>Rating</td>
                        <td><?php echo number_format($rating, 2, ",", "."); ?></td>
                        <td>
                            <span class="badge bg-primary">Rendah (<?php echo round($rating_rendah, 2); ?>)</span>
                            <span class="badge bg-warning">Sedang (<?php echo round($rating_sedang, 2); ?>)</span>
                            <span class="badge bg-danger">Tinggi (<?php echo round($rating_tinggi, 2); ?>)</span>
                        </td>
                    </tr>
                    <tr>
                        <td>Penjualan</td>
                        <td><?php echo number_format($penjualan, 2, ",", "."); ?></td>
                        <td>
                            <span class="badge bg-primary">Rendah (<?php echo round($penjualan_rendah, 2); ?>)</span>
                            <span class="badge bg-warning">Sedang (<?php echo round($penjualan_sedang, 2); ?>)</span>
                            <span class="badge bg-danger">Tinggi (<?php echo round($penjualan_tinggi, 2); ?>)</span>
                        </td>
                    </tr>
                    <tr>
                        <td>Perolehan Fuzzy Value</td>
                        <td>Rp <?php echo number_format($fuzzy_value, 2, ",", "."); ?></td>
                        <td>
                            <span class="badge bg-success">Fuzzy Value (<?php echo round($fuzzy_value, 2); ?>)</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="table-responsive mt-3">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Rule</th>
                        <th>Kondisi</th>
                        <th>Derajat Harga</th>
                        <th>Derajat Rating</th>
                        <th>Derajat Penjualan</th>
                        <th>Alpha (αi)</th>
                        <th>Zi</th>
                        <th>αi×Zi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>R1</td>
                        <td>Jika Harga <b>Murah</b> dan Rating <b>Rendah</b> dan Penjualan <b>Rendah</b></td>
                        <td><?php echo round($harga_murah, 2); ?></td>
                        <td><?php echo round($rating_rendah, 2); ?></td>
                        <td><?php echo round($penjualan_rendah, 2); ?></td>
                        <td><?php echo round($a1, 2); ?></td>
                        <td><?php echo round($z1, 2); ?></td>
                        <td><?php echo round($a1 * $z1, 2); ?></td>
                    </tr>
                    <tr>
                        <td>R2</td>
                        <td>Jika Harga <b>Murah</b> dan Rating <b>Sedang</b> dan Penjualan <b>Sedang</b></td>
                        <td><?php echo round($harga_murah, 2); ?></td>
                        <td><?php echo round($rating_sedang, 2); ?></td>
                        <td><?php echo round($penjualan_sedang, 2); ?></td>
                        <td><?php echo round($a2, 2); ?></td>
                        <td><?php echo round($z2, 2); ?></td>
                        <td><?php echo round($a2 * $z2, 2); ?></td>
                    </tr>
                    <tr>
                        <td>R3</td>
                        <td>Jika Harga <b>Sedang</b> dan Rating <b>Rendah</b> dan Penjualan <b>Rendah</b></td>
                        <td><?php echo round($harga_sedang, 2); ?></td>
                        <td><?php echo round($rating_rendah, 2); ?></td>
                        <td><?php echo round($penjualan_rendah, 2); ?></td>
                        <td><?php echo round($a3, 2); ?></td>
                        <td><?php echo round($z3, 2); ?></td>
                        <td><?php echo round($a3 * $z3, 2); ?></td>
                    </tr>
                    <tr>
                        <td>R4</td>
                        <td>Jika Harga <b>Sedang</b> dan Rating <b>Sedang</b> dan Penjualan <b>Sedang</b></td>
                        <td><?php echo round($harga_sedang, 2); ?></td>
                        <td><?php echo round($rating_sedang, 2); ?></td>
                        <td><?php echo round($penjualan_sedang, 2); ?></td>
                        <td><?php echo round($a4, 2); ?></td>
                        <td><?php echo round($z4, 2); ?></td>
                        <td><?php echo round($a4 * $z4, 2); ?></td>
                    </tr>
                    <tr>
                        <td>R5</td>
                        <td>Jika Harga <b>Mahal</b> dan Rating <b>Tinggi</b> dan Penjualan <b>Rendah</b></td>
                        <td><?php echo round($harga_mahal, 2); ?></td>
                        <td><?php echo round($rating_tinggi, 2); ?></td>
                        <td><?php echo round($penjualan_rendah, 2); ?></td>
                        <td><?php echo round($a5, 2); ?></td>
                        <td><?php echo round($z5, 2); ?></td>
                        <td><?php echo round($a5 * $z5, 2); ?></td>
                    </tr>
                    <tr>
                        <td>R6</td>
                        <td>Jika Harga <b>Mahal</b> dan Rating <b>Sedang</b> dan Penjualan <b>Sedang</b></td>
                        <td><?php echo round($harga_mahal, 2); ?></td>
                        <td><?php echo round($rating_sedang, 2); ?></td>
                        <td><?php echo round($penjualan_sedang, 2); ?></td>
                        <td><?php echo round($a6, 2); ?></td>
                        <td><?php echo round($z6, 2); ?></td>
                        <td><?php echo round($a6 * $z6, 2); ?></td>
                    </tr>
                    <tr>
                        <td>Jumlah</td>
                        <td colspan="5"></td>
                        <td><?php echo round($total_a, 2); ?></td>
                        <td><?php echo round($total_AiZi, 2); ?></td>
                    </tr>
                    <tr>
                        <td colspan="8">Perolehan Fuzzy Value = ∑(αi×Zi) / ∑(αi) = <?php echo round($total_AiZi, 2) . " / " . round($total_a, 2); ?> = <b>Rp <?php echo number_format($fuzzy_value, 2, ",", "."); ?></b></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="row row-cols-1 row-cols-md-4 g-4 py-4">
            <?php
            if (count($products) > 0) {
                $closest_products = array_slice($products, 0, 4);
                foreach ($closest_products as $produk) {
            ?>
                    <div class="col">
                        <div class="card card-custom">
                            <img src="../assets/img/<?php echo $produk['gambar'] ?>" class="card-img-top" alt="..." style="height: 330px;">
                            <div class="card-body mb-2 ">
                                <h5 class="card-title source-sans-3-600"><?php echo $produk['nama_barang'] ?></h5>
                                <h5 class="pt-1 text-muted source-sans-3-600"><?php echo $produk['harga'] ?></h5>
                                <div class="mt-3 d-grid gap-2 source-sans-3-700">
                                    <a href="detail_produk.php?id_detail_barang=<?php echo $produk['id_detail_barang'] ?>" class="btn btn-primary" style="border-radius: 13px;">Detail Produk</a>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo '<div class="col"><p class="text-center">Tidak ada produk yang sesuai</p></div>';
            }
            ?>
        </div>
    </div>

    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../fontawesome/js/all.min.js"></script>
</body>

</html>
