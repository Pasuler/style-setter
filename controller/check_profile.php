<?php
session_start();

if (isset($_SESSION['id_user'])) {
    header("Location:../user/profil.php");
} else {
    header("Location:../admin/login.php");
    exit();
}
?>
