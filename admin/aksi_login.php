<?php
session_start();
include "../koneksi.php";

$op = isset($_GET['op']) ? $_GET['op'] : '';

if ($op == "in") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $username = mysqli_real_escape_string($con, $username);
    $password = mysqli_real_escape_string($con, $password);

    $sql = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
    $query = $con->query($sql);

    if (mysqli_num_rows($query) == 1) {
        $dt_jenis = $query->fetch_array();
        $_SESSION['login'] = true;
        $_SESSION['username'] = $dt_jenis['username'];
        $_SESSION['id_user'] = $dt_jenis['id_user'];
        $_SESSION['role'] = $dt_jenis['role'];

        $id_user = $dt_jenis['id_user'];
        $cek_pelanggan = $con->query("SELECT * FROM pelanggan WHERE id_user = '$id_user'");
        
        if ($cek_pelanggan->num_rows == 0) {
            header('Location: input_profile.php');
        } else {
            if ($dt_jenis['role'] == "Admin") {
                header("Location: index.php");
            } elseif ($dt_jenis['role'] == "user") {
                header("Location: ../user/index.php");
            } else {
                die("Role tidak dikenali <a href=\"javascript:history.back()\">kembali</a>");
            }
        }
        exit();
    } else {
        header("Location: login.php?error=1");
    }
} else if ($op == "out") {
    session_destroy();
    header("Location: login.php");
}
?>
