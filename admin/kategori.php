<?php
require "../koneksi.php";

$query_kategori = mysqli_query($con, "SELECT * FROM kategori");
$jumlahkategori = mysqli_num_rows($query_kategori);
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
    <title>Kategori</title>
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
                    <i class="fas fa-list"></i> Kategori
                </li>
            </ol>
        </nav>

        <h2 class="mt-3">List Kategori</h2>
        <?php if ($pesan) : ?>
            <div class="alert alert-info"><?= htmlspecialchars($pesan); ?></div>
        <?php endif; ?>
        <div class="my-5">
            <div class="mt-4">
                <form action="tambah_kategori.php" method="POST">
                    <div id="kategori-container">
                        <div class="mb-3 kategori-input">
                            <input type="text" class="form-control" placeholder="Nama Kategori" name="nama_kategori[]" required>
                        </div>
                    </div>
                    <button type="button" class="btn btn-secondary mb-3" id="add-kategori">Tambah Kategori Lain</button>
                    <button type="submit" class="btn btn-primary mb-3">Tambah Kategori</button>
                </form>
            </div>
            <div class="table-responsive mt-3">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kategori</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($jumlahkategori == 0) {
                            echo '<tr><td colspan="3" class="text-center">Data Kosong</td></tr>';
                        } else {
                            $no = 1;
                            while ($kategori = mysqli_fetch_assoc($query_kategori)) {
                        ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= htmlspecialchars($kategori['nama_kategori']); ?></td>
                                    <td>
                                        <a href="edit_kategori.php?id=<?= $kategori['id_kategori']; ?>" class="btn btn-warning">Edit</a>
                                        <form action="delete_kategori.php" method="post" onsubmit="return confirm('Are you sure you want to delete this category?');" style="display: inline-block;">
                                            <input type="hidden" name="id_kategori" value="<?= $kategori['id_kategori']; ?>">
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                        <form action="tambah_gambar_kategori.php" method="POST" enctype="multipart/form-data" style="display: inline-block;">
                                            <input type="hidden" name="id_kategori" value="<?= $kategori['id_kategori']; ?>">
                                            <div class="input-group">
                                                <input type="file" name="fileToUpload" id="fileToUpload" class="form-control" required>
                                                <button type="submit" value="Upload Image" name="submit" class="btn btn-primary">Upload Image</button>
                                            </div>
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
        </div>
    </div>

    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../fontawesome/js/all.min.js"></script>
    <script>
        document.getElementById('add-kategori').addEventListener('click', function() {
            var container = document.getElementById('kategori-container');
            var newInput = document.createElement('div');
            newInput.classList.add('mb-3', 'kategori-input');
            newInput.innerHTML = '<input type="text" class="form-control" placeholder="Nama Kategori" name="nama_kategori[]" required>';
            container.appendChild(newInput);
        });
    </script>
</body>

</html>
