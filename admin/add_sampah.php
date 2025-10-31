<?php
session_start();
if(!isset($_SESSION['admin'])) { header("Location: login.php"); exit; }
include('../config/db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = trim($_POST['nama']);
    $deskripsi = trim($_POST['deskripsi']);
    $harga = floatval($_POST['harga_per_kg']);

    // Upload foto (jika ada)
    $foto = null;
    if (!empty($_FILES['foto']['name'])) {
        $target_dir = "uploads/";
        $foto = time() . "_" . basename($_FILES["foto"]["name"]);
        $target_file = $target_dir . $foto;
        move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file);
    }

    $stmt = $conn->prepare("INSERT INTO jenis_sampah (nama, deskripsi, harga_per_kg, foto) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssds", $nama, $deskripsi, $harga, $foto);
    $stmt->execute();

    header("Location: manage_sampah.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Tambah Jenis Sampah | Bank Sampah</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="admin-bg">

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-success shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-bold" href="index.php">
      <i class="bi bi-recycle"></i> Bank Sampah Admin
    </a>
    <div class="d-flex">
      <a href="manage_sampah.php" class="btn btn-light me-2 fw-semibold">
        <i class="bi bi-list-ul"></i> Kembali
      </a>
      <a href="logout.php" class="btn btn-outline-light fw-semibold">
        <i class="bi bi-box-arrow-right"></i> Logout
      </a>
    </div>
  </div>
</nav>

<!-- Main Content -->
<div class="container py-5">
  <div class="card shadow-lg border-0 rounded-4 p-4 mx-auto" style="max-width: 650px;">
    <h3 class="text-success fw-bold mb-4 text-center">
      <i class="bi bi-plus-circle"></i> Tambah Jenis Sampah
    </h3>

    <form method="POST" enctype="multipart/form-data">
      <div class="mb-3">
        <label class="form-label fw-semibold">Nama Sampah</label>
        <input type="text" name="nama" class="form-control rounded-pill" required>
      </div>

      <div class="mb-3">
        <label class="form-label fw-semibold">Deskripsi</label>
        <textarea name="deskripsi" class="form-control rounded-3" rows="3" placeholder="Contoh: Botol plastik bekas, kertas, logam, dll."></textarea>
      </div>

      <div class="mb-3">
        <label class="form-label fw-semibold">Harga per Kg (Rp)</label>
        <input type="number" name="harga_per_kg" class="form-control rounded-pill" step="0.01" required>
      </div>

      <div class="mb-3">
        <label class="form-label fw-semibold">Foto (Opsional)</label>
        <input type="file" name="foto" class="form-control rounded-pill">
      </div>

      <div class="text-center mt-4">
        <button type="submit" class="btn btn-success px-4 py-2 fw-semibold rounded-pill shadow-sm">
          <i class="bi bi-save"></i> Simpan
        </button>
        <a href="manage_sampah.php" class="btn btn-secondary px-4 py-2 fw-semibold rounded-pill ms-2">
          <i class="bi bi-arrow-left-circle"></i> Batal
        </a>
      </div>
    </form>
  </div>
</div>

<!-- Footer -->
<footer class="text-center py-3 text-muted small">
  © <?= date('Y'); ?> Bank Sampah Indonesia 🌿
</footer>

</body>
</html>
