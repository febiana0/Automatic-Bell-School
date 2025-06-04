<?php
$konek = mysqli_connect("localhost", "root", "", "bell");

if (!$konek) {
  die("Koneksi database gagal: " . mysqli_connect_error());
}

if (isset($_POST['btnsimpan'])) {
  $jam = $_POST['jam'];
  $keterangan = $_POST['keterangan'];  // Menambahkan variabel keterangan
  $status = 0;

  $cekJam = mysqli_query($konek, "SELECT * FROM jam WHERE jam='$jam'");
  if (mysqli_num_rows($cekJam) == 0) {
    mysqli_query($konek, "ALTER TABLE jam AUTO_INCREMENT=1");
    mysqli_query($konek, "INSERT INTO jam(jam, keterangan, status) VALUES('$jam', '$keterangan', '$status')");
  } else {
    echo "<script>alert('Jam yang diinput sudah ada!');</script>";
  }
}
?>

<!doctype html>
<html lang="id">
<head>
  <title>Pengaturan Jam - Bel Sekolah IoT</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <style>
    body {
      background: linear-gradient(120deg, #74ebd5, #ACB6E5);
      color: #2c3e50;
      font-family: 'Poppins', sans-serif;
      margin: 0;
      padding: 0;
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }
    .container {
      max-width: 800px;
      width: 100%;
      padding: 20px;
      background-color: #fff;
      border-radius: 16px;
      box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.2);
      animation: fadeIn 1s ease-in-out;
    }
    .header {
      background: linear-gradient(135deg, #42a5f5, #478ed1);
      color: white;
      padding: 20px;
      border-radius: 12px;
      box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
      text-align: center;
    }
    .header h1 {
      font-size: 2.5rem;
      margin: 0;
    }
    .card {
      margin-top: 20px;
      border: none;
      border-radius: 12px;
    }
    .card-header {
      background-color: #42a5f5;
      color: white;
      font-size: 1.2rem;
      font-weight: bold;
      text-align: center;
      border-radius: 12px 12px 0 0;
    }
    .input-group-text {
      background-color: #42a5f5;
      color: white;
      border: none;
    }
    .btn-success {
      background: linear-gradient(135deg, #00c9a7, #11998e);
      border: none;
      transition: transform 0.2s, box-shadow 0.2s;
    }
    .btn-success:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 15px rgba(0, 128, 128, 0.3);
    }
    .card-body h2 {
      font-size: 3rem;
      color: #34495e;
    }
    @keyframes fadeIn {
      from { opacity: 0; transform: scale(0.95); }
      to { opacity: 1; transform: scale(1); }
    }
  </style>
  <script>
    $(document).ready(function(){
      setInterval(function(){
        $("#datajam").load('cekjam.php');
      }, 1000);
    });
  </script>
</head>
<body>
  <div class="container">
    <div class="header">
      <h1><i class="fas fa-clock"></i> Pengaturan Jam</h1>
    </div>
    <div class="card">
      <div class="card-header">
        Jam Sekarang
      </div>
      <div class="card-body text-center">
        <h2 id="datajam">00:00:00</h2>
      </div>
    </div>
    <div class="card">
      <div class="card-header">
        Tambah Data Jam
      </div>
      <div class="card-body">
        <form method="POST">
          <div class="input-group mb-3">
            <span class="input-group-text"><i class="fas fa-clock"></i></span>
            <input type="text" name="jam" id="jam" class="form-control" placeholder="Jam : Menit : Detik" required>
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text"><i class="fas fa-comment"></i></span>
            <input type="text" name="keterangan" id="keterangan" class="form-control" placeholder="Keterangan" required>
          </div>
          <button type="submit" name="btnsimpan" class="btn btn-success ms-2">Simpan</button>
        </form>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
