<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (!isset($_SESSION['users'])) {
        $_SESSION['users'] = [];
    }

    foreach ($_SESSION['users'] as $user) {
        if ($user['username'] == $username) {
            echo "<script>alert('Username sudah terdaftar! Silakan pilih username lain.'); window.location.href = 'register.html';</script>";
            exit();
        }
    }

    $_SESSION['users'][] = [
        'username' => $username,
        'password' => $password
    ];

    echo "<script>alert('Registrasi berhasil! Silakan login.'); window.location.href = 'tampilan.php';</script>";
}
?>
