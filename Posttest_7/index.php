<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Buah Segar</title>
    <style>
        .top-bar {
            background-color: #28a745;
            color: #ffffff;
            padding: 12px;
            text-align: center;
            font-size: 24px;
            font-weight: bold;
        }

        .content-container {
            max-width: 1000px; 
            margin: 30px auto;
            background: #e9ecef;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            animation: fade-in 0.8s ease;
        }

        @keyframes fade-in {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        h3 {
            text-align: center;
            color: #28a745;
            font-size: 26px;
            margin-bottom: 15px;
        }
        .welcome-message {
            text-align: center;
            font-size: 18px;
            color: #343a40;
            margin-bottom: 20px;
            font-weight: bold;
        }

        table {
            width: 100%; 
            border-collapse: collapse;
            background-color: #fff;
            margin-top: 15px;
        }

        th, td {
            border: 1px solid #dddddd;
            padding: 15px; 
            text-align: center;
            font-size: 18px; 
        }

        th {
            background-color: #28a745;
            color: #ffffff;
        }

        tr:nth-child(even) { background-color: #f8f9fa; }

        tr:hover {
            background-color: #c3e6cb;
            transition: all 0.3s ease;
        }

        .button {
            padding: 10px 18px; 
            margin: 5px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            color: #ffffff;
            display: inline-block;
        }

        .btn-edit {
            background-color: #ffc107;
            color: #000;
        }

        .btn-edit:hover { background-color: #e0a800; }

        .btn-remove {
            background-color: #dc3545;
        }

        .btn-remove:hover { background-color: #c82333; }

        .btn-add {
            background-color: #28a745;
            margin-top: 15px;
        }

        .btn-add:hover { background-color: #218838; }
        .search-form {
            text-align: center;
            margin-bottom: 20px;
        }

        .search-form input[type="text"] {
            padding: 10px;
            width: 300px;
            border: 2px solid #28a745;
            border-radius: 5px;
            font-size: 16px;
            outline: none;
        }

        .search-form input[type="text"]:focus {
            border-color: #218838;
        }

        .search-form button[type="submit"] {
            padding: 10px 18px;
            margin-left: 10px;
            background-color: #28a745;
            border: none;
            color: #ffffff;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .search-form button[type="submit"]:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="top-bar">
        TOKO BUAH SEGAR
    </div>

    <div class="content-container">
        <h3>Daftar Produk Buah</h3>

        <div class="welcome-message">
            <?php
            session_start();

            if (!isset($_SESSION['user_id'])) {
                header("Location: login.html");
                exit;
            }

            echo "Selamat datang, " . htmlspecialchars($_SESSION['username']) . "!"; 
            ?>
        </div>

        <div class="search-form">
            <form method="GET" action="index.php">
                <input type="text" name="search" placeholder="Cari produk..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>" />
                <button type="submit" class="button btn-add">Cari</button>
            </form>
        </div>

        <?php
        require 'koneksi.php'; 

        if (isset($_GET['id_produk'])) {
            $id_produk = htmlspecialchars($_GET["id_produk"]); 
            $sql = "DELETE FROM produk WHERE id_produk='$id_produk'";
            $hasil = mysqli_query($conn, $sql);

            if ($hasil) {
                header("Location: index.php"); 
                exit;
            } else {
                echo "<div class='alert alert-danger'> Data Gagal dihapus.</div>";
            }
        }
        ?>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Produk</th>
                    <th>Kategori Produk</th>
                    <th>Deskripsi Produk</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $search_keyword = isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '';

                $query_produk = "SELECT * FROM produk";
                if (!empty($search_keyword)) {
                    $query_produk .= " WHERE nama_produk LIKE '%$search_keyword%' OR kategori_produk LIKE '%$search_keyword%' OR deskripsi_produk LIKE '%$search_keyword%'";
                }
                $query_produk .= " ORDER BY id_produk ASC";
                $hasil_produk = mysqli_query($conn, $query_produk);
                
                $nomor = 1;
                while ($row = mysqli_fetch_assoc($hasil_produk)) {
                    echo "<tr>";
                    echo "<td>" . $nomor++ . "</td>";
                    echo "<td>" . htmlspecialchars($row["nama_produk"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["kategori_produk"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["deskripsi_produk"]) . "</td>";
                    echo "<td><img src='uploads/" . htmlspecialchars($row["file_foto"]) . "' style='width: 120px; height: auto;' alt='Gambar Produk'></td>";
                    echo "<td>";
                    echo "<a href='update.php?id_produk=" . htmlspecialchars($row['id_produk']) . "' class='button btn-edit'>Edit</a>";
                    echo "<a href='?id_produk=" . htmlspecialchars($row['id_produk']) . "' class='button btn-remove'>Hapus</a>";
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>

        <div>
            <a href="create.php" class="button btn-add">Tambah Produk</a>
            <a href="logout.php" class="button btn-add" role="button">Logout</a>
        </div>
    </div>
</body>
</html>
