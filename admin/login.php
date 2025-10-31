<?php
session_start();
include('../config/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $stmt = $conn->prepare("SELECT * FROM admin WHERE username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        if ($password === $row['password']) {
            $_SESSION['admin'] = $row['username'];
            header("Location: index.php");
            exit;
        } else {
            $error = "Password salah!";
        }
    } else {
        $error = "Username tidak ditemukan!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login Admin | Bank Sampah</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="login-bg">

<div class="d-flex justify-content-center align-items-center vh-100">
  <div class="card shadow-lg border-0 p-4 rounded-4 login-card">
    <div class="text-center mb-4">
      <i class="bi bi-recycle text-success" style="font-size: 3rem;"></i>
      <h3 class="fw-bold text-success mt-2">Bank Sampah</h3>
      <p class="text-muted small">Login Admin</p>
    </div>

    <?php if(isset($error)): ?>
      <div class="alert alert-danger py-2"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST">
      <div class="mb-3">
        <label class="form-label fw-semibold"><i class="bi bi-person-fill"></i> Username</label>
        <input type="text" name="username" class="form-control rounded-pill" required>
      </div>

      <div class="mb-3">
        <label class="form-label fw-semibold"><i class="bi bi-lock-fill"></i> Password</label>
        <input type="password" name="password" class="form-control rounded-pill" required>
      </div>

      <button type="submit" class="btn btn-success w-100 rounded-pill fw-semibold shadow-sm">
        <i class="bi bi-box-arrow-in-right"></i> Login
      </button>
    </form>
  </div>
</div>

</body>
</html>
