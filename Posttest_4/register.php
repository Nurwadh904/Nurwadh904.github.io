<?php
session_start();

// Cek apakah form registrasi disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Jika session 'users' belum ada, buat array kosong
    if (!isset($_SESSION['users'])) {
        $_SESSION['users'] = [];
    }

    // Cek apakah username sudah ada
    foreach ($_SESSION['users'] as $user) {
        if ($user['username'] == $username) {
            echo "<script>alert('Username sudah terdaftar! Silakan pilih username lain.'); window.location.href = 'register.html';</script>";
            exit();
        }
    }

    // Simpan username dan password ke session 'users'
    $_SESSION['users'][] = [
        'username' => $username,
        'password' => $password
    ];

    echo "<script>alert('Registrasi berhasil! Silakan login.'); window.location.href = 'tampilan.php';</script>";
}
?>
