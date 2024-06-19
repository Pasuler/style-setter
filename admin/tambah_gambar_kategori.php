<?php
require "../koneksi.php";
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

if (!empty($_FILES["fileToUpload"]["name"])) {
    $nama_file = basename($_FILES["fileToUpload"]["name"]);
    $target_dir = "../assets/img/";
    $imageFileType = strtolower(pathinfo($nama_file, PATHINFO_EXTENSION));
    $image_size = $_FILES["fileToUpload"]["size"];

    $random_name = generateRandomString();
    $new_name = $random_name . '.' . $imageFileType;
    $target_file = $target_dir . $new_name;

    $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];

    if ($image_size <= 200000 && in_array($imageFileType, $allowed_types)) {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            $id = $_POST['id_kategori'];
            $query = "UPDATE kategori SET gambar='$new_name' WHERE id_kategori='$id'";
            mysqli_query($con, $query);
            header("Location: kategori.php?pesan=Gambar berhasil diupload");
            exit();
        } else {
            header("Location: kategori.php?pesan=Gagal mengupload gambar");
            exit();
        }
    } else {
        header("Location: kategori.php?pesan=File tidak sesuai");
        exit();
    }
} else {
    header("Location: kategori.php?pesan=Tidak ada file yang diupload");
    exit();
}
