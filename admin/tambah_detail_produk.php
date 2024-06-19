<?php
require "../koneksi.php";

function generateRandomString($length = 20) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_barang = htmlspecialchars($_POST['id_barang']);
    $harga = htmlspecialchars($_POST['harga']);
    $id_kategori = htmlspecialchars($_POST['id_kategori']);
    $qty = htmlspecialchars($_POST['id_stok']);
    $detail = htmlspecialchars($_POST['detail']);

    $stok_check_query = "SELECT id_stok FROM stok WHERE id_barang = '$id_barang' AND qty = '$qty'";
    $stok_check_result = mysqli_query($con, $stok_check_query);

    if (mysqli_num_rows($stok_check_result) == 0) {
        header("Location: detail_produk.php?pesan=Stok tidak valid untuk barang yang dipilih");
        exit();
    }

    $stok_data = mysqli_fetch_assoc($stok_check_result);
    $id_stok = $stok_data['id_stok'];

    $nama_file = basename($_FILES["fileToUpload"]["name"]);
    $target_dir = "../assets/img/";
    $imageFileType = strtolower(pathinfo($nama_file, PATHINFO_EXTENSION));
    $image_size = $_FILES["fileToUpload"]["size"];

    $random_name = generateRandomString();
    $new_name = $random_name . '.' . $imageFileType;
    $target_file = $target_dir . $new_name;

    $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];

    if ($nama_file != '') {
        if ($image_size <= 500000) {
            if (in_array($imageFileType, $allowed_types)) {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    $query = "INSERT INTO detail_barang (id_barang, harga, id_kategori, id_stok, detail, gambar) VALUES ('$id_barang', '$harga', '$id_kategori', '$id_stok', '$detail', '$new_name')";
                    $result = mysqli_query($con, $query);

                    if ($result) {
                        header("Location: detail_produk.php?pesan=Produk berhasil ditambahkan");
                    } else {
                        header("Location: detail_produk.php?pesan=Produk gagal ditambahkan");
                    }
                } else {
                    header("Location: detail_produk.php?pesan=Gagal mengupload gambar");
                }
            } else {
                echo '<div class="alert alert-warning mt-3" role="alert">File wajib bertipe jpg, jpeg, png, atau gif</div>';
            }
        } else {
            echo '<div class="alert alert-warning mt-3" role="alert">File tidak boleh lebih dari 500 KB</div>';
        }
    } else {
        header("Location: detail_produk.php?pesan=Nama file tidak boleh kosong");
    }
}
?>
