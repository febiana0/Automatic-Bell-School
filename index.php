<?php
$konek = mysqli_connect("localhost", "root", "", "bell");

if (!$konek) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

session_start();

if (!isset($_SESSION['loggedin'])) {
    header("Location: login.php");
    exit;
}

if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit;
}

if (isset($_POST['hapus_semua'])) {
  $hapus_semua = mysqli_query($konek, "DELETE FROM jam");

  if ($hapus_semua) {
      echo "<script>alert('Semua data berhasil dihapus!');</script>";
      echo "<script>window.location.href = 'index.php';</script>"; 
  } else {
      echo "<script>alert('Gagal menghapus data!');</script>";
  }
}
?>

<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>Dashboard - Bel Sekolah IoT</title>

  <!-- CDN for font-awesome, bootstrap, and jquery -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- Digital font from Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">

  <style>
  body {
    font-family: 'Poppins', sans-serif;
    background-color: #f7f7f7;
    margin: 0;
    padding: 0;
  }

  .dashboard-container {
    display: flex;
    height: 100vh;
    background: linear-gradient(135deg, #ffbc00, #ff8040);
  }

  .sidebar {
    width: 250px;
    background: #2d3e50;
    color: white;
    padding: 30px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    transition: width 0.3s ease, background-color 0.3s ease;
  }

  .sidebar:hover {
    width: 270px;
    background-color: #1c2833;
  }

  .sidebar h2 {
    font-size: 1.8rem;
    margin-bottom: 30px;
    text-align: center;
    color: #ffbc00;
  }

  .sidebar a {
    color: #e1e8f0;
    text-decoration: none;
    padding: 12px 20px;
    display: flex;
    align-items: center;
    border-radius: 8px;
    margin-bottom: 1rem;
    transition: all 0.3s ease;
  }

  .sidebar a:hover {
    background-color: #ff5722;
    transform: translateX(10px);
  }

  .sidebar a i {
    margin-right: 12px;
    font-size: 1.2rem;
  }

  .content {
    flex-grow: 1;
    padding: 40px;
    background-color: #ffffff;
    border-radius: 15px 0 0 15px;
    box-shadow: -5px 0 15px rgba(0, 0, 0, 0.1);
    overflow-y: auto;
  }

  .header {
    background-color: #5d9cec;
    color: white;
    padding: 20px;
    border-radius: 15px;
    text-align: center;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    font-size: 1.6rem;
    animation: fadeInDown 1s ease;
  }

  .card {
    border-radius: 12px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
    background-color: #f9f9f9;
    padding: 20px;
  }

  .card-header {
    background-color: #34495e;
    color: #ffffff;
    font-size: 1.3rem;
    border-radius: 10px 10px 0 0;
    padding: 10px;
  }

  .card-body {
    background-color: #ecf0f1;
    padding: 15px;
    border-radius: 8px;
  }

  #datatanggal, #datajam {
    font-family: 'Press Start 2P', cursive;
    font-size: 1.5rem;
    color: #ff5722;
    margin-bottom: 10px;
  }

  .table {
    border-radius: 10px;
    overflow: hidden;
  }

  .table-header {
    background-color: #3498db;
    color: white;
  }

  .table tbody tr:hover {
    background-color: #ffebcc;
    transition: background-color 0.3s ease;
  }

  .logout-btn {
    margin-top: 30px;
    padding: 12px;
    background-color: #e74c3c;
    color: white;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: transform 0.3s ease, background-color 0.3s ease;
  }

  .logout-btn:hover {
    transform: translateY(-5px);
    background-color: #c0392b;
  }

  @keyframes fadeInDown {
    from {
      opacity: 0;
      transform: translateY(-20px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }
  </style>

  <script>
    $(document).ready(function() {
      setInterval(function() {
        $("#datajam").load('cekjam.php'); // Jam
        $("#datatanggal").load('cektanggal.php'); // Tanggal
      }, 1000); // Perbarui setiap detik
    });
  </script>
</head>

<body>
  <div class="dashboard-container">
    <div class="sidebar">
      <h2><i class="fas fa-school"></i> Bel Sekolah</h2>
      <a href="index.php"><i class="fas fa-home"></i> Home</a>
      <a href="settings.php"><i class="fas fa-cog"></i> Settings</a>
      <form method="POST" onsubmit="return confirm('Apakah Anda yakin ingin logout?');">
        <button type="submit" name="logout" class="logout-btn">Logout</button>
      </form>
    </div>

    <div class="content">
      <div class="header">
        <i class="fas fa-bell"></i> Pengaturan Bel Sekolah IoT
      </div>

      <div class="card">
        <div class="card-header text-center">
          <p>Hari dan Tanggal:</p>
          <h2 id="datatanggal"></h2>
          <p>Jam Sekarang:</p>
          <h2 id="datajam"></h2>
        </div>
      </div>

      <div class="card">
        <table class="table table-striped table-hover text-center">
          <thead>
            <tr>
              <th>List Jam</th>
              <th>Status</th>
              <th>Keterangan</th>
              <th>Delete</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $sql = mysqli_query($konek, "SELECT * FROM jam ORDER BY id ASC");
            while ($data = mysqli_fetch_array($sql)) {
                $statusIcon = $data['status'] == 2 ? "<i class='fas fa-check text-success'></i>" : "<i class='fas fa-times text-danger'></i>";
                $statusKeterangan = $data['status'] == 2 ? "Aktif" : "Tidak Aktif";
                $keterangan = $data['keterangan'];
            ?>
            <tr>
              <td><?php echo $data['jam']; ?></td>
              <td><?php echo $statusIcon; ?></td>
              <td><?php echo $keterangan; ?></td>
              <td>
                <a href="hapus.php?id=<?php echo $data['id']; ?>" class="text-danger">
                  <i class="fa fa-trash"></i>
                </a>
              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
        <form method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus semua data?');">
    <!-- Menambahkan kelas d-flex dan justify-content-end untuk mengarahkan tombol ke kanan -->
    <div class="d-flex justify-content-end">
        <button type="submit" name="hapus_semua" class="btn btn-danger btn-block">Hapus Semua Data</button>
    </div>
</form>

      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"></script>
</body>
</html>