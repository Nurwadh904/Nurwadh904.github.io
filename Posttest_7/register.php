<?php
session_start();
require 'koneksi_db.php'; 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $hashed_password);

    if ($stmt->execute()) {
        echo "Registrasi berhasil. Silakan <a href='login.html'>login</a>";
    } else {
        echo "Registrasi gagal.";
    }
}
?>