<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Create Data Produk</title>
    <style>
        body {
            font-family: 'Arial', sans-serif; 
            background-color: #f5f5f5; 
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px; 
            margin: 50px auto; 
            padding: 30px;
            background-color: #ffffff; 
            border-radius: 10px; 
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); 
            animation: fadeIn 0.5s ease-in-out; 
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        h2 {
            text-align: center; 
            color: #388e3c; 
            margin-bottom: 30px; 
            font-weight: bold;
        }

        .form-group {
            margin-bottom: 20px; 
            position: relative; 
        }

        label {
            display: block; 
            margin-bottom: 5px; 
            color: #555; 
            font-weight: 600; 
        }

        input[type="text"], input[type="file"] {
            width: 100%; 
            padding: 10px 15px; 
            border: 1px solid #ccc; 
            border-radius: 5px; 
            box-sizing: border-box; 
            transition: border 0.3s ease; 
        }

        input[type="text"]:focus {
            border: 1px solid #388e3c; 
            outline: none; 
        }

        .btn {
            background-color: #388e3c; 
            color: white; 
            padding: 12px 20px; 
            border: none; 
            border-radius: 5px; 
            cursor: pointer; 
            transition: background-color 0.3s ease, transform 0.2s ease; 
            width: 100%; 
            font-size: 16px; 
            font-weight: bold; 
        }

        .btn:hover {
            background-color: #2e7d32; 
            transform: translateY(-2px); 
        }

        .alert {
            background-color: #f8d7da; 
            color: #721c24; 
            padding: 10px; 
            border-radius: 5px; 
            margin-top: 20px; 
            display: none; 
        }
    </style>
</head>
<body>
<div class="container">
    <?php
    include "koneksi.php";

    function input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nama_produk = input($_POST["nama_produk"]);
        $kategori_produk = input($_POST["kategori_produk"]);
        $deskripsi_produk = input($_POST["deskripsi_produk"]);

        $sql = "INSERT INTO produk (nama_produk, kategori_produk, deskripsi_produk) VALUES ('$nama_produk', '$kategori_produk', '$deskripsi_produk')";

        $hasil = mysqli_query($conn, $sql);
        if ($hasil) {
            header("Location:index.php");
            exit;
        } else {
            echo "<div class='alert'> Data Gagal disimpan.</div>";
        }
    }
    ?>
    <h2>Input Data</h2>
    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label>Nama Produk:</label>
            <input type="text" name="nama_produk" placeholder="Masukkan Nama Produk" required />
        </div>
        <div class="form-group">
            <label>Kategori Produk:</label>
            <input type="text" name="kategori_produk" placeholder="Masukkan Kategori Produk" required />
        </div>
        <div class="form-group">
            <label>Deskripsi Produk:</label>
            <input type="text" name="deskripsi_produk" placeholder="Masukkan Deskripsi Produk" required />
        </div>   

        <button type="submit" name="submit" class="btn">Submit</button>
    </form>
</div>
</body>
</html>