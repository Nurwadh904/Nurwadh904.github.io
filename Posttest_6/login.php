<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (isset($_SESSION['users'])) {
        $isAuthenticated = false;

        foreach ($_SESSION['users'] as $user) {
            if ($user['username'] == $username && $user['password'] == $password) {
                $isAuthenticated = true;
                break;
            }
        }

        if ($isAuthenticated) {
            $_SESSION['isLoggedIn'] = true;
            echo "<script>alert('Login berhasil!'); window.location.href = 'index.html';</script>";
        } else {
            echo "<script>alert('Username atau password salah!'); window.location.href = 'login.html';</script>";
        }
    } else {
        echo "<script>alert('Belum ada pengguna yang terdaftar.'); window.location.href = 'register.html';</script>";
    }
}
?>
