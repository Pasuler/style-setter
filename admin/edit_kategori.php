<?php
include "../koneksi.php";

$id_kategori = $_GET['id'];
$sql = "SELECT * FROM kategori WHERE id_kategori = '$id_kategori'";
$result = $con->query($sql);
if ($result->num_rows == 1) {
    $kategori = $result->fetch_assoc();
} else {
    header('Location: kategori.php?pesan=Kategori tidak ditemukan');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
    <title>Edit Kategori</title>
    <style>
        .breadcrumb a {
            text-decoration: none;
            color: inherit;
        }
    </style>
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
                <a href="kategori.php"><i class="fas fa-list"></i> Kategori</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                <i class="fa-solid fa-pen-to-square"></i> Edit
            </li>
        </ol>
    </nav>
    <h2>Edit Kategori</h2>
    <form action="aksi_edit_kategori.php" method="post">
        <input type="hidden" name="id_kategori" value="<?= $id_kategori; ?>">
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="nama_kategori" class="form-label">Nama Kategori</label>
                    <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" value="<?= htmlspecialchars($kategori['nama_kategori']); ?>" required>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Update Kategori</button>
    </form>
</div>
<script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../fontawesome/js/all.min.js"></script>
</body>
</html>
