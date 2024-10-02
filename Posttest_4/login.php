<?php
session_start();

// Cek apakah form login disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Cek apakah data user ada di session
    if (isset($_SESSION['users'])) {
        $isAuthenticated = false;

        // Loop untuk memeriksa apakah username dan password sesuai dengan data di session
        foreach ($_SESSION['users'] as $user) {
            if ($user['username'] == $username && $user['password'] == $password) {
                $isAuthenticated = true;
                break;
            }
        }

        if ($isAuthenticated) {
            // Jika login berhasil
            $_SESSION['isLoggedIn'] = true; // Menyimpan status login
            echo "<script>alert('Login berhasil!'); window.location.href = 'index.html';</script>";
        } else {
            // Jika login gagal
            echo "<script>alert('Username atau password salah!'); window.location.href = 'login.html';</script>";
        }
    } else {
        // Jika tidak ada pengguna yang terdaftar
        echo "<script>alert('Belum ada pengguna yang terdaftar.'); window.location.href = 'register.html';</script>";
    }
}
?>
