<?php
require "../koneksi.php";

$id_user = $_GET['id'];
$query_pelanggan = $con->query("
    SELECT pelanggan.*, user.username, user.password 
    FROM pelanggan 
    JOIN user ON pelanggan.id_user = user.id_user
    WHERE pelanggan.id_user = '$id_user'
");
$pelanggan = mysqli_fetch_assoc($query_pelanggan);
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
    <title>Edit Pelanggan</title>
</head>

<body>
    <?php require "../components/navbar.php"; ?>
    <div class="container mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="index.php"><i class="fas fa-home"></i> Home</a>
                </li><li class="breadcrumb-item">
                    <a href="pelanggan.php"><i class="fas fa-users"></i> Pelanggan</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    <i class="fa-solid fa-pen-to-square"></i> Edit Pelanggan
                </li>
            </ol>
        </nav>
        
        <h2 class="mt-3">Edit Pelanggan</h2>
        <div class="my-5 col-12 md-4 lg-4">
            <div class="mt-4">
                <form action="aksi_edit_pelanggan.php" method="POST">
                    <input type="hidden" name="id_user" value="<?= $pelanggan['id_user']; ?>">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="<?= $pelanggan['nama']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                        <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                            <option value="Laki-laki" <?= $pelanggan['jenis_kelamin'] == 'Laki-laki' ? 'selected' : ''; ?>>Laki-laki</option>
                            <option value="Perempuan" <?= $pelanggan['jenis_kelamin'] == 'Perempuan' ? 'selected' : ''; ?>>Perempuan</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="telp" class="form-label">Telepon</label>
                        <input type="text" class="form-control" id="telp" name="telp" value="<?= $pelanggan['telp']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $pelanggan['alamat']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" value="<?= $pelanggan['username']; ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" value="<?= $pelanggan['password']; ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Pelanggan</button>
                </form>
            </div>
        </div>
    </div>
    
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../fontawesome/js/all.min.js"></script>
</body>

</html>
