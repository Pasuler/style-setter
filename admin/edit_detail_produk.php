<?php
require "../koneksi.php";

$id = $_GET['id'];
$query = $con->query("SELECT * FROM detail_barang WHERE id_detail_barang = $id");
$produk = mysqli_fetch_assoc($query);

$query_kategori = $con->query("SELECT * FROM kategori");
$query_barang = $con->query("SELECT * FROM barang");

$id_barang_produk = $produk['id_barang'];
$query_stok_produk = $con->query("SELECT * FROM stok WHERE id_barang = $id_barang_produk");
$stok_produk = mysqli_fetch_assoc($query_stok_produk);
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
    <script>
        function updateStok() {
            var idBarang = document.getElementById('id_barang').value;
            document.getElementById('qty').value = 0; 
            var xhr = new XMLHttpRequest();
            xhr.open('GET', '<?= $_SERVER['PHP_SELF'] ?>?id_barang=' + idBarang, true);
            xhr.onload = function () {
                if (this.status == 200) {
                    var response = JSON.parse(this.responseText);
                    document.getElementById('qty').value = response.qty !== undefined ? response.qty : 0;
                }
            };
            xhr.send();
        }
    </script>
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
                    <a href="detail_produk.php"><i class="fas fas fa-cube"></i> Detail Produk</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    <i class="fas fas fa-cube"></i> Edit Detail Produk
                </li>
            </ol>
        </nav>

        <h2 class="mt-3">Edit Produk</h2>
        <div class="my-5 col-12 md-4 lg-4">
            <div class="mt-4">
                <form action="aksi_edit_detail_produk.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $produk['id_detail_barang']; ?>">
                    <div class="mb-3">
                        <label for="id_barang" class="form-label">Barang</label>
                        <select class="form-control" id="id_barang" name="id_barang" onchange="updateStok()" required>
                            <?php while($barang = mysqli_fetch_assoc($query_barang)): ?>
                                <option value="<?= $barang['id_barang']; ?>" <?= ($barang['id_barang'] == $produk['id_barang']) ? 'selected' : ''; ?>><?= $barang['nama_barang']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga</label>
                        <input type="number" class="form-control" id="harga" name="harga" value="<?= $produk['harga']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="id_kategori" class="form-label">Kategori</label>
                        <select class="form-control" id="id_kategori" name="id_kategori" required>
                            <?php while($kategori = mysqli_fetch_assoc($query_kategori)): ?>
                                <option value="<?= $kategori['id_kategori']; ?>" <?= ($kategori['id_kategori'] == $produk['id_kategori']) ? 'selected' : ''; ?>><?= $kategori['nama_kategori']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="qty" class="form-label">Stok</label>
                        <input type="number" class="form-control" id="qty" name="qty" value="<?= $stok_produk['qty'] ?? 0; ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="detail" class="form-label">Detail</label>
                        <textarea class="form-control" id="detail" name="detail" required><?= $produk['detail']; ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="fileToUpload" class="form-label">Pilih gambar untuk diupload:</label>
                        <input type="file" name="fileToUpload" id="fileToUpload" class="form-control">
                        <small>Biarkan kosong jika tidak ingin mengganti gambar</small>
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

<?php
// AJAX handler
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id_barang'])) {
    $id_barang = $_GET['id_barang'];
    $query_stok = $con->query("SELECT qty FROM stok WHERE id_barang = '$id_barang'");
    $stok = mysqli_fetch_assoc($query_stok);
    echo json_encode($stok);
    exit();
}
?>
