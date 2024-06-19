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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $id_barang = htmlspecialchars($_POST['id_barang']);
    $harga = htmlspecialchars($_POST['harga']);
    $id_kategori = htmlspecialchars($_POST['id_kategori']);
    $qty = htmlspecialchars($_POST['qty']);
    $detail = htmlspecialchars($_POST['detail']);

    $stok_check_query = "SELECT id_stok FROM stok WHERE id_barang = '$id_barang' AND qty = '$qty'";
    $stok_check_result = mysqli_query($con, $stok_check_query);

    if (mysqli_num_rows($stok_check_result) == 0) {
        header("Location: edit_detail_produk.php?id=$id&pesan=Stok tidak valid");
        exit();
    }
    
    $stok_data = mysqli_fetch_assoc($stok_check_result);
    $id_stok = $stok_data['id_stok'];

    $query = "UPDATE detail_barang SET id_barang='$id_barang', harga='$harga', id_kategori='$id_kategori', id_stok='$id_stok', detail='$detail'";

    if (!empty($_FILES["fileToUpload"]["name"])) {
        $nama_file = basename($_FILES["fileToUpload"]["name"]);
        $target_dir = "../assets/img/";
        $imageFileType = strtolower(pathinfo($nama_file, PATHINFO_EXTENSION));
        $image_size = $_FILES["fileToUpload"]["size"];

        $random_name = generateRandomString();
        $new_name = $random_name . '.' . $imageFileType;
        $target_file = $target_dir . $new_name;
        
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];

        if ($image_size <= 500000 && in_array($imageFileType, $allowed_types)) {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                $query .= ", gambar='$new_name'";
            } else {
                header("Location: edit_detail_produk.php?id=$id&pesan=Gagal mengupload gambar");
                exit();
            }
        } else {
            header("Location: edit_detail_produk.php?id=$id&pesan=File tidak sesuai");
            exit();
        }
    }

    $query .= " WHERE id_detail_barang='$id'";
    $result = mysqli_query($con, $query);

    if ($result) {
        header("Location: detail_produk.php?pesan=Produk berhasil diupdate");
    } else {
        header("Location: edit_detail_produk.php?id=$id&pesan=Produk gagal diupdate");
    }
}
?>
