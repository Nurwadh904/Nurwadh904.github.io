<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Input Produk</title>
    <style>
        body {
            font-family: 'Verdana', sans-serif; 
            background-color: #eaeaea; 
            margin: 0;
            padding: 0;
        }

        .wrapper {
            width: 620px; 
            margin: 40px auto; 
            padding: 25px;
            background-color: #ffffff; 
            border-radius: 12px; 
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.15); 
            animation: slideIn 0.6s ease-in-out; 
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-25px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        h2 {
            text-align: center; 
            color: #3b8d2a; 
            margin-bottom: 28px; 
            font-weight: 700;
        }

        .input-group {
            margin-bottom: 18px; 
            position: relative; 
        }

        label {
            display: block; 
            margin-bottom: 6px; 
            color: #444; 
            font-weight: 600; 
        }

        input[type="text"], input[type="file"] {
            width: 100%; 
            padding: 10px; 
            border: 1px solid #bbb; 
            border-radius: 6px; 
            box-sizing: border-box; 
            transition: border-color 0.3s ease; 
        }

        input[type="text"]:focus {
            border-color: #3b8d2a; 
            outline: none; 
        }

        .submit-btn {
            background-color: #3b8d2a; 
            color: white; 
            padding: 12px; 
            border: none; 
            border-radius: 6px; 
            cursor: pointer; 
            transition: background-color 0.3s, transform 0.2s; 
            width: 100%; 
            font-size: 17px; 
            font-weight: bold; 
        }

        .submit-btn:hover {
            background-color: #33691e; 
            transform: translateY(-3px); 
        }

        .error-alert {
            background-color: #f0b9bb; 
            color: #7a1c1e; 
            padding: 12px; 
            border-radius: 6px; 
            margin-top: 18px; 
            display: none; 
        }
    </style>
</head>
<body>
<div class="wrapper">
<?php
include "koneksi.php";

function sanitizeInput($inputData) {
    $inputData = trim($inputData);
    $inputData = stripslashes($inputData);
    $inputData = htmlspecialchars($inputData);
    return $inputData;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productName = sanitizeInput($_POST["nama_produk"]);
    $productCategory = sanitizeInput($_POST["kategori_produk"]);
    $productDescription = sanitizeInput($_POST["deskripsi_produk"]);

    $uploadDirectory = "uploads/";

    if (!is_dir($uploadDirectory)) {
        mkdir($uploadDirectory, 0755, true); 
    }

    $originalFileName = basename($_FILES["file_foto"]["name"]);
    $fileExtension = pathinfo($originalFileName, PATHINFO_EXTENSION);
    $uniqueFileName = date('Y-m-d_H.i.s') . '.' . $fileExtension; 
    $finalFilePath = $uploadDirectory . $uniqueFileName;

    if (move_uploaded_file($_FILES["file_foto"]["tmp_name"], $finalFilePath)) {
        $insertQuery = "INSERT INTO produk (nama_produk, kategori_produk, deskripsi_produk, file_foto) VALUES ('$productName', '$productCategory', '$productDescription', '$uniqueFileName')";
        $insertResult = mysqli_query($conn, $insertQuery);

        if ($insertResult) {
            header("Location: index.php");
        } else {
            echo "<div class='error-alert'>Data gagal disimpan ke database.</div>";
        }
    } else {
        echo "<div class='error-alert'>Gagal mengunggah file.</div>";
    }
}
?>

    <h2>Formulir Produk Toko Buah</h2>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
        <div class="input-group">
            <label>Nama Produk:</label>
            <input type="text" name="nama_produk" placeholder="Masukkan Nama Produk" required />
        </div>
        
        <div class="input-group">
            <label>Kategori Produk:</label>
            <input type="text" name="kategori_produk" placeholder="Masukkan Kategori Produk" required />
        </div>

        <div class="input-group">
            <label>Deskripsi Produk:</label>
            <input type="text" name="deskripsi_produk" placeholder="Masukkan Deskripsi Produk" required />
        </div>

        <div class="input-group">
            <label>Gambar Produk:</label>
            <input type="file" name="file_foto" required />
        </div>
        
        <button type="submit" class="submit-btn">Tambah Produk</button>
    </form>
</div>
</body>
</html>
