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
    $id_user = $_POST['id_user'];
    $password = htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8');
    $email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
    $nama = htmlspecialchars($_POST['nama'], ENT_QUOTES, 'UTF-8');
    $jenis_kelamin = htmlspecialchars($_POST['jenis_kelamin'], ENT_QUOTES, 'UTF-8');
    $telp = htmlspecialchars($_POST['telp'], ENT_QUOTES, 'UTF-8');
    $alamat = htmlspecialchars($_POST['alamat'], ENT_QUOTES, 'UTF-8');

    $password = mysqli_real_escape_string($con, $password);
    $email = mysqli_real_escape_string($con, $email);
    $nama = mysqli_real_escape_string($con, $nama);
    $jenis_kelamin = mysqli_real_escape_string($con, $jenis_kelamin);
    $telp = mysqli_real_escape_string($con, $telp);
    $alamat = mysqli_real_escape_string($con, $alamat);

    $sql_user = "UPDATE user SET password = '$password', email = '$email' WHERE id_user = '$id_user'";
    $query_user = $con->query($sql_user);
    
    $query_pelanggan = "UPDATE pelanggan SET nama = '$nama', jenis_kelamin = '$jenis_kelamin', telp = '$telp', alamat = '$alamat'";

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
                $query_pelanggan .= ", gambar='$new_name'";
            } else {
                header("Location: profil.php?pesan=Gagal mengupload gambar");
                exit();
            }
        } else {
            header("Location: profil.php?pesan=File tidak sesuai");
            exit();
        }
    }

    $query_pelanggan .= " WHERE id_user='$id_user'";
    $result_pelanggan = mysqli_query($con, $query_pelanggan);

    if ($query_user === true && $result_pelanggan === true) {
        header("Location: profil.php?pesan=Profile berhasil diupdate");
    } else {
        header("Location: profil.php?pesan=Profile gagal diupdate");
    }
}
?>
