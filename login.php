<?php
session_start();
$konek = mysqli_connect("localhost", "root", "", "bell");

if (!$konek) {
  die("Koneksi database gagal: " . mysqli_connect_error());
}

// Cek apakah user sudah login
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
  header("Location: index.php");
  exit;
}

if (isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Query untuk memeriksa username dan password
  $query = mysqli_query($konek, "SELECT * FROM users WHERE username='$username' AND password='$password'");
  if (mysqli_num_rows($query) == 1) {
    $_SESSION['loggedin'] = true;
    header("Location: index.php");
    exit;
  } else {
    $error = "Username atau password salah!";
  }
}
?>

<!doctype html>
<html lang="id">
<head>
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {
      background: url('https://source.unsplash.com/1600x900/?technology,login') no-repeat center center fixed;
      background-size: cover;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: 'Poppins', sans-serif;
      color: #333;
    }
    .card {
      border-radius: 15px;
      overflow: hidden;
      box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
      animation: fadeIn 1s ease;
    }
    .card-header {
      background: linear-gradient(135deg, #6a11cb, #2575fc);
      color: #fff;
    }
    .btn-primary {
      background: linear-gradient(135deg, #6a11cb, #2575fc);
      border: none;
      transition: all 0.3s ease-in-out;
    }
    .btn-primary:hover {
      background: linear-gradient(135deg, #2575fc, #6a11cb);
      transform: scale(1.05);
    }
    .form-control {
      border-radius: 10px;
      transition: box-shadow 0.3s ease-in-out;
    }
    .form-control:focus {
      box-shadow: 0 0 10px rgba(106, 17, 203, 0.5);
    }
    .alert {
      border-radius: 8px;
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
  </style>
</head>
<body>

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-5">
        <div class="card">
          <div class="card-header text-center py-3">
            <h4 class="fw-bold">Selamat Datang</h4>
          </div>
          <div class="card-body p-4">
            <?php if (isset($error)): ?>
              <div class="alert alert-danger text-center"><?= $error; ?></div>
            <?php endif; ?>
            <form method="POST">
              <div class="mb-4">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" id="username" class="form-control" placeholder="Masukkan username" required>
              </div>
              <div class="mb-4">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan password" required>
              </div>
              <button type="submit" name="login" class="btn btn-primary w-100 py-2">Masuk</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

</body>
</html>
