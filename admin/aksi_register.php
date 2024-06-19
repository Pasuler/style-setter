<?php
include "../koneksi.php";
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$role = $_POST['role'];
$sql = "INSERT INTO user(username, email, password, role) VALUES ('" . $username . "', '" . $email . "', '" . $password . "', '" . $role . "')"; 
$query = $con->query($sql);
if ($query === true) {
    header('location: login.php');
} else {
    echo "Errrooooor";  
}   