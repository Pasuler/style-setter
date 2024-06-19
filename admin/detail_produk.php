<?php
require "../koneksi.php";

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id_barang'])) {
    $id_barang = $_GET['id_barang'];
    $query_stok = $con->query("SELECT qty FROM stok WHERE id_barang = '$id_barang'");
    $stok = mysqli_fetch_assoc($query_stok);
    echo json_encode($stok);
    exit();
}

$query_produk = $con->query("SELECT * FROM detail_barang");
$jumlahproduk = mysqli_num_rows($query_produk);

$query_kategori = $con->query("SELECT * FROM kategori");
$jumlahkategori = mysqli_num_rows($query_kategori);

$query_barang = $con->query("SELECT * FROM barang");
$jumlahbarang = mysqli_num_rows($query_barang);

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
    <title>Tambah Produk</title>
    <script>
        function toggle(source) {
            checkboxes = document.getElementsByName('delete_ids[]');
            for (var i = 0, n = checkboxes.length; i < n; i++) {
                checkboxes[i].checked = source.checked;
            }
        }

        function updateStok() {
            var idBarang = document.getElementById('id_barang').value;
            document.getElementById('id_stok').value = 0; // Set default value to 0 before making AJAX call
            var xhr = new XMLHttpRequest();
            xhr.open('GET', '<?= $_SERVER['PHP_SELF'] ?>?id_barang=' + idBarang, true);
            xhr.onload = function () {
                if (this.status == 200) {
                    var response = JSON.parse(this.responseText);
                    document.getElementById('id_stok').value = response.qty !== undefined ? response.qty : 0;
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
                <li class="breadcrumb-item active" aria-current="page">
                    <i class="fas fas fa-cube"></i> Detail Produk
                </li>
            </ol>
        </nav>

        <h2 class="mt-3">Tambah Produk</h2>
        <?php if ($pesan): ?>
            <div class="alert alert-info"><?= $pesan; ?></div>
        <?php endif; ?>
        <div class="my-5 col-12 md-4 lg-4">
            <div class="mt-4">
                <form action="tambah_detail_produk.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="id_barang" class="form-label">Barang</label>
                        <select class="form-control" id="id_barang" name="id_barang" onchange="updateStok()" required>
                            <?php while($barang = mysqli_fetch_assoc($query_barang)): ?>
                                <option value="<?= $barang['id_barang']; ?>"><?= $barang['nama_barang']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga</label>
                        <input type="number" class="form-control" id="harga" name="harga" required>
                    </div>
                    <div class="mb-3">
                        <label for="id_kategori" class="form-label">Kategori</label>
                        <select class="form-control" id="id_kategori" name="id_kategori" required>
                            <?php while($kategori = mysqli_fetch_assoc($query_kategori)): ?>
                                <option value="<?= $kategori['id_kategori']; ?>"><?= $kategori['nama_kategori']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="id_stok" class="form-label">Stok</label>
                        <input type="number" class="form-control" id="id_stok" name="id_stok" value="0" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="detail" class="form-label">Detail</label>
                        <textarea class="form-control" id="detail" name="detail" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="fileToUpload" class="form-label">Pilih gambar untuk diupload:</label>
                        <input type="file" name="fileToUpload" id="fileToUpload" class="form-control" required>
                    </div>
                    <input type="submit" value="Upload Image" name="submit" class="btn btn-primary">
                </form>
            </div>
        </div>

        <h2 class="mt-3">List Produk</h2>
        <form action="delete_detail_produk.php" method="POST">
            <div class="table-responsive mt-3">
                <table class="table">
                    <thead>
                        <tr>
                            <th><input type="checkbox" onclick="toggle(this);"></th>
                            <th>No</th>
                            <th>Barang</th>
                            <th>Harga</th>
                            <th>Kategori</th>
                            <th>Stok</th>
                            <th>Detail</th>
                            <th>Gambar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    if ($jumlahproduk == 0) {
                        ?>
                        <tr>
                            <td colspan="9" class="text-center">Data Kosong</td>
                        </tr>
                    <?php
                    } else {
                        $no = 1;
                        while ($produk = mysqli_fetch_assoc($query_produk)) {
                            $barang = mysqli_fetch_assoc(mysqli_query($con, "SELECT nama_barang FROM barang WHERE id_barang = " . $produk['id_barang']));
                            $kategori = mysqli_fetch_assoc(mysqli_query($con, "SELECT nama_kategori FROM kategori WHERE id_kategori = " . $produk['id_kategori']));
                            $stok = mysqli_fetch_assoc(mysqli_query($con, "SELECT qty FROM stok WHERE id_stok = " . $produk['id_stok']));
                    ?>
                            <tr>
                                <td><input type="checkbox" name="delete_ids[]" value="<?= $produk['id_detail_barang']; ?>"></td>
                                <td><?= $no++; ?></td>
                                <td><?= $barang['nama_barang']; ?></td>
                                <td><?= $produk['harga']; ?></td>
                                <td><?= $kategori['nama_kategori']; ?></td>
                                <td><?= $stok['qty']; ?></td>
                                <td><?= $produk['detail']; ?></td>
                                <td>
                                    <div style="border: 1px solid #ddd; padding: 5px; width: 150px; height: 150px; overflow: hidden;">
                                        <img src="../assets/img/<?= $produk['gambar']; ?>" alt="<?= $barang['nama_barang']; ?>" style="width: 100%;">
                                    </div>
                                </td>
                                <td>
                                    <a href="edit_detail_produk.php?id=<?= $produk['id_detail_barang']; ?>" class="btn btn-warning">Edit</a>
                                        <input type="hidden" name="id_barang" value="<?= $produk['id_detail_barang']; ?>">
                                    </form>
                                </td>
                            </tr> 
                    <?php
                        }
                    }
                    ?>
                    </tbody>
                </table>
            </div>
            <button type="submit" class="btn btn-danger">Delete Selected</button>
        </form>
    </div>
    
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../fontawesome/js/all.min.js"></script>
</body>

</html>
