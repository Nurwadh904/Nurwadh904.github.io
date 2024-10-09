<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TOKO BUAH</title>
  <style>
    .navbar {
      background-color: #28a745;
      color: white;
      padding: 10px;
      text-align: center;
    }

    .navbar .navbar-brand {
      color: white;
      font-size: 24px;
      font-weight: bold;
    }

    .container {
      max-width: 800px;
      margin: 20px auto;
      background-color: #f9f9f9;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      animation: fadeIn 1s ease-in-out;
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
      }
      to {
        opacity: 1;
      }
    }

    h4 {
      color: #28a745;
      font-size: 28px;
      font-weight: bold;
      text-align: center;
      margin-bottom: 20px;
    }

    table {
      width: 100%;
      margin-top: 10px;
      border-collapse: collapse;
      background-color: white;
      animation: slideUp 0.5s ease-out;
    }

    @keyframes slideUp {
      from {
        transform: translateY(20px);
        opacity: 0;
      }
      to {
        transform: translateY(0);
        opacity: 1;
      }
    }

    th, td {
      border: 1px solid #ddd;
      padding: 12px;
      text-align: center;
      font-size: 16px;
      transition: background-color 0.3s ease;
    }

    th {
      background-color: #28a745;
      color: white;
      font-weight: bold;
    }

    tr:nth-child(even) {
      background-color: #f2f2f2;
    }

    tr:hover {
      background-color: #d4edda;
      transform: scale(1.02);
      transition: transform 0.2s ease-in-out;
    }

    .btn {
      padding: 8px 15px;
      margin: 4px 2px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      text-decoration: none;
      color: white;
      transition: background-color 0.3s ease, transform 0.2s ease-in-out;
      display: inline-block;
    }

    .btn-primary {
      background-color: #28a745;
    }

    .btn-primary:hover {
      background-color: #218838;
      transform: translateY(-2px);
    }

    .btn-warning {
      background-color: #ffc107;
      color: black;
    }

    .btn-warning:hover {
      background-color: #e0a800;
      transform: translateY(-2px);
    }

    .btn-danger {
      background-color: #dc3545;
    }

    .btn-danger:hover {
      background-color: #c82333;
      transform: translateY(-2px);
    }
  </style>
</head>
<body>
  <nav class="navbar">
    <span class="navbar-brand mb-0 h1">TOKO BUAH SEGAR</span>
  </nav>

  <div class="container">
    <h4>DAFTAR PRODUK</h4>

    <?php
      include "koneksi.php";

      if (isset($_GET['id_produk'])) {
          $id_produk = htmlspecialchars($_GET["id_produk"]);
          $sql = "delete from produk where id_produk='$id_produk'";
          $hasil = mysqli_query($conn, $sql);

          if ($hasil) {
              header("Location:index.php");
          } else {
              echo "<div class='alert alert-danger'> Data Gagal dihapus.</div>";
          }
      }
    ?>

    <table class="table table-bordered">
      <thead>
        <tr>
          <th>No</th>
          <th>Nama Produk</th>
          <th>Kategori Produk</th>
          <th>Deskripsi Produk</th>
          <th colspan='2'>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php
          include "koneksi.php";
          $sql = "SELECT * from produk order by id_produk asc";
          $hasil = mysqli_query($conn, $sql);
          $no = 0;

          while ($data = mysqli_fetch_array($hasil)) {
              $no++;
        ?>
          <tr>
            <td><?php echo $no; ?></td>
            <td><?php echo $data["nama_produk"]; ?></td>
            <td><?php echo $data["kategori_produk"]; ?></td>
            <td><?php echo $data["deskripsi_produk"]; ?></td>
            <td>
              <a href="update.php?id_produk=<?php echo htmlspecialchars($data['id_produk']); ?>" class="btn btn-warning" role="button">Update</a>
              <a href="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>?id_produk=<?php echo $data['id_produk']; ?>" class="btn btn-danger" role="button">Delete</a>
            </td>
          </tr>
        <?php
          }
        ?>
      </tbody>
    </table>
    <a href="create.php" class="btn btn-primary" role="button">Tambah Data</a>
  </div>
</body>
</html>
