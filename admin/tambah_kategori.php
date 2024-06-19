<?php
include "../koneksi.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_kategori = $_POST['nama_kategori'];
    $errors = [];
    $success = 0;

    foreach ($nama_kategori as $kategori) {
        $kategori = $con->real_escape_string($kategori);
        $check_query = "SELECT * FROM kategori WHERE nama_kategori = '$kategori'";
        $check_result = $con->query($check_query);

        if ($check_result->num_rows > 0) {
            $errors[] = "Kategori '$kategori' sudah ada.";
        } else {
            $sql = "INSERT INTO kategori(nama_kategori) VALUES ('$kategori')";
            if ($con->query($sql) === true) {
                $success++;
            } else {
                $errors[] = "Error: " . $con->error;
            }
        }
    }
    $pesan = $success > 0 ? "$success kategori berhasil ditambahkan." : '';
    if (!empty($errors)) {
        $pesan .= " " . implode(" ", $errors);
    }
    header("Location: kategori.php?pesan=" . urlencode($pesan));
    exit();
}
?>
