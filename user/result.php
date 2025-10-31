<?php
include('../config/db.php');

// Validasi input
if (!isset($_POST['jenis']) || !isset($_POST['berat'])) {
  header("Location: index.php");
  exit;
}

$id = $_POST['jenis'];
$berat = floatval($_POST['berat']);

$query = $conn->query("SELECT * FROM jenis_sampah WHERE id='$id'");
$data = $query->fetch_assoc();

if (!$data) {
  die("Data jenis sampah tidak ditemukan.");
}

$total = $berat * $data['harga_per_kg'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Hasil Perhitungan | Bank Sampah</title>

  <!-- Bootstrap & Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

  <!-- Custom CSS -->
  <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-success shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-bold" href="index.php">
      <i class="bi bi-recycle"></i> Bank Sampah
    </a>
  </div>
</nav>

<!-- Main Content -->
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-lg-6 col-md-8">
      <div class="card p-4 shadow-lg border-0 rounded-4 text-center">
        <h3 class="text-success mb-3 fw-bold">
          <i class="bi bi-cash-stack"></i> Hasil Perhitungan
        </h3>
        <hr>
        <div class="text-start">
          <p><i class="bi bi-recycle"></i> Jenis Sampah: <strong><?= htmlspecialchars($data['nama']); ?></strong></p>
          <p><i class="bi bi-box-seam"></i> Berat: <strong><?= $berat; ?> Kg</strong></p>
          <p><i class="bi bi-cash-coin"></i> Harga per Kg: <strong>Rp<?= number_format($data['harga_per_kg'], 2, ',', '.'); ?></strong></p>
        </div>
        <hr>
        <h4 class="text-dark">Total Uang yang Diterima:</h4>
        <h2 class="text-success fw-bold mt-2">
          Rp<?= number_format($total, 2, ',', '.'); ?>
        </h2>

        <div class="mt-4">
          <a href="index.php" class="btn btn-success px-4 py-2 fw-semibold">
            <i class="bi bi-arrow-left-circle"></i> Hitung Lagi
          </a>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Footer -->
<footer class="text-center py-3 text-muted small">
  © <?= date('Y'); ?> Bank Sampah Indonesia 🌿
</footer>

</body>
</html>
