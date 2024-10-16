<?php
session_start();

if (isset($_SESSION['users']) && count($_SESSION['users']) > 0) {
    echo "<h2>Data Pengguna Terdaftar:</h2><br>";

    foreach ($_SESSION['users'] as $user) {
        echo "Username: " . htmlspecialchars($user['username']) . " | Password: " . htmlspecialchars($user['password']) . "<br>";
    }

    echo '<br><a href="register.html"><button>Kembali ke Registrasi</button></a>';
    echo '<br><a href="login.html"><button>Login</button></a>';
} else {
    echo "Belum ada pengguna yang terdaftar.";
    
    echo '<br><a href="register.html"><button>Kembali ke Registrasi</button></a>';
    echo '<br><a href="login.html"><button>Login</button></a>';
}
?>
