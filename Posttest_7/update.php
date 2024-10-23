<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Update Data Produk</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
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

if (isset($_GET['id_produk'])) {
    $id_produk = htmlspecialchars($_GET["id_produk"]);
    $sql = "SELECT * FROM produk WHERE id_produk='$id_produk'";
    $hasil = mysqli_query($conn, $sql);
    $data = mysqli_fetch_assoc($hasil);
}

if (isset($_POST['submit'])) {
    $id_produk = htmlspecialchars($_POST['id_produk']);  
    $nama_produk = htmlspecialchars($_POST['nama_produk']);
    $kategori_produk = htmlspecialchars($_POST['kategori_produk']);
    $deskripsi_produk = htmlspecialchars($_POST['deskripsi_produk']);

    if ($_FILES['file_foto']['name']) {
        $file_tmp = $_FILES['file_foto']['tmp_name'];
        $file_ext = pathinfo($_FILES['file_foto']['name'], PATHINFO_EXTENSION);

        $timestamp = date('Y-m-d H.i.s');
        $file_name = $timestamp . '.' . $file_ext;
        $target_dir = "uploads/";
        $target_file = $target_dir . $file_name;

        if (move_uploaded_file($file_tmp, $target_file)) {
            $sql = "UPDATE produk SET nama_produk='$nama_produk', kategori_produk='$kategori_produk', deskripsi_produk='$deskripsi_produk', file_foto='$file_name' WHERE id_produk='$id_produk'";
        } else {
            echo "<div class='alert alert-danger'>File gagal diupload.</div>";
        }
    } else {
        $sql = "UPDATE produk SET nama_produk='$nama_produk', kategori_produk='$kategori_produk', deskripsi_produk='$deskripsi_produk' WHERE id_produk='$id_produk'";
    }

    $hasil = mysqli_query($conn, $sql);

    if ($hasil) {
        header("Location: index.php");
    } else {
        echo "<div class='alert alert-danger'>Data gagal diupdate.</div>";
    }
}
?>

<h2>Update Data Toko Buah</h2>

<form action="<?php echo $_SERVER["PHP_SELF"] . '?id_produk=' . $data['id_produk']; ?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id_produk" value="<?php echo $data['id_produk']; ?>" /> 
    
    <div class="form-group">
        <label>Nama Produk:</label>
        <input type="text" name="nama_produk" class="form-control" value="<?php echo $data['nama_produk']; ?>" required />
    </div>
    
    <div class="form-group">
        <label>Kategori Produk:</label>
        <input type="text" name="kategori_produk" class="form-control" value="<?php echo $data['kategori_produk']; ?>" required />
    </div>

    <div class="form-group">
        <label>Deskripsi produk:</label>
        <input type="text" name="deskripsi_produk" class="form-control" value="<?php echo $data['deskripsi_produk']; ?>" required />
    </div>

    <div class="form-group">
        <label>File:</label>
        <input type="file" name="file_foto" class="form-control" />
    </div>
    
    <button type="submit" name="submit" class="btn btn-primary">Update Data</button>
</form>
</div>
</body>
</html>
