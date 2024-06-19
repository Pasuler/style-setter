<?php
require "../koneksi.php";

$query_pelanggan = $con->query("SELECT pelanggan.*, user.username, user.password 
                                FROM pelanggan 
                                JOIN user ON pelanggan.id_user = user.id_user");
                                
$jumlahpelanggan = mysqli_num_rows($query_pelanggan);

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
    <title>Data Pelanggan</title>
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
                    <i class="fas fa-users"></i> Pengguna
                </li>
            </ol>
        </nav>
        
        <h2 class="mt-3">List Pengguna</h2>
        <?php if ($pesan): ?>
            <div class="alert alert-info"><?= $pesan; ?></div>
        <?php endif; ?>
        
        <div class="table-responsive mt-3">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Jenis Kelamin</th>
                        <th>Telepon</th>
                        <th>Alamat</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                if ($jumlahpelanggan == 0) {
                    ?>
                    <tr>
                        <td colspan="8" class="text-center">Data Kosong</td>
                    </tr>
                <?php
                } else {
                    $no = 1;
                    while ($pelanggan = mysqli_fetch_assoc($query_pelanggan)) {
                ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $pelanggan['nama']; ?></td>
                            <td><?= $pelanggan['jenis_kelamin']; ?></td>
                            <td><?= $pelanggan['telp']; ?></td>
                            <td><?= $pelanggan['alamat']; ?></td>
                            <td><?= $pelanggan['username']; ?></td>
                            <td><?= $pelanggan['password']; ?></td>
                            <td>
                                <a href="edit_pelanggan.php?id=<?= $pelanggan['id_user']; ?>" class="btn btn-warning">Edit</a>
                                <a href="delete_pelanggan.php?id=<?= $pelanggan['id_user']; ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus pelanggan ini?');">Hapus</a>
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
    
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../fontawesome/js/all.min.js"></script>
</body>

</html>
