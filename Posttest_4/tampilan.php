<?php
session_start();

// Cek apakah ada data pengguna yang tersimpan di session
if (isset($_SESSION['users']) && count($_SESSION['users']) > 0) {
    echo "<h2>Data Pengguna Terdaftar:</h2><br>";

    // Loop melalui array 'users' dan tampilkan data
    foreach ($_SESSION['users'] as $user) {
        echo "Username: " . htmlspecialchars($user['username']) . " | Password: " . htmlspecialchars($user['password']) . "<br>";
    }

    // Tombol kembali dan login
    echo '<br><a href="register.html"><button>Kembali ke Registrasi</button></a>';
    echo '<br><a href="login.html"><button>Login</button></a>';
} else {
    echo "Belum ada pengguna yang terdaftar.";
    
    // Tombol kembali dan login tetap ditampilkan jika tidak ada pengguna
    echo '<br><a href="register.html"><button>Kembali ke Registrasi</button></a>';
    echo '<br><a href="login.html"><button>Login</button></a>';
}
?>
