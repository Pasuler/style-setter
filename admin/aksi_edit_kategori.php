<?php
include "../koneksi.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_kategori = $_POST['id_kategori'];
    $nama_kategori = $_POST['nama_kategori'];
    $check_query = "SELECT * FROM kategori WHERE nama_kategori = '$nama_kategori' AND id_kategori != '$id_kategori'";
    $check_result = $con->query($check_query);

    if ($check_result->num_rows > 0) {
        header('Location: kategori.php?id=' . $id_kategori . '&pesan=Kategori sudah ada');
    } else {
        $sql = "UPDATE kategori SET nama_kategori = '$nama_kategori' WHERE id_kategori = '$id_kategori'";
        $query = $con->query($sql);

        if ($query === true) {
            header('Location: kategori.php?pesan=Kategori berhasil diupdate');
        } else {
            header('Location: edit_kategori.php?id=' . $id_kategori . '&pesan=Error: ' . $con->error);
        }
    }
    exit();
}
?>
