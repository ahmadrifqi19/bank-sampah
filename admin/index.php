<?php
session_start();
if(!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard Admin | Bank Sampah</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="admin-bg">

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-success shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-bold" href="#">
      <i class="bi bi-recycle"></i> Bank Sampah Admin
    </a>
    <div class="d-flex">
      <a href="logout.php" class="btn btn-outline-light fw-semibold">
        <i class="bi bi-box-arrow-right"></i> Logout
      </a>
    </div>
  </div>
</nav>

<!-- Main Content -->
<div class="container py-5 text-center">
  <div class="card shadow-lg border-0 rounded-4 p-5 mx-auto" style="max-width: 600px;">
    <div class="card-body">
      <i class="bi bi-person-circle text-success" style="font-size: 3.5rem;"></i>
      <h3 class="fw-bold text-success mt-3">Selamat Datang, <?= htmlspecialchars($_SESSION['admin']); ?> 👋</h3>
      <p class="text-muted mb-4">Anda masuk sebagai <strong>Admin</strong>. Gunakan menu di atas untuk mengelola jenis sampah dan memantau data.</p>

      <a href="manage_sampah.php" class="btn btn-success px-4 py-2 fw-semibold rounded-pill shadow-sm">
        <i class="bi bi-gear"></i> Kelola Jenis Sampah
      </a>
    </div>
  </div>
</div>

<!-- Footer -->
<footer class="text-center py-3 text-muted small">
  © <?= date('Y'); ?> Bank Sampah Indonesia 🌿
</footer>

</body>
</html>
