<?php
session_start();
if(!isset($_SESSION['admin'])) { header("Location: login.php"); exit; }
include('../config/db.php');
$result = $conn->query("SELECT * FROM jenis_sampah");
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Kelola Jenis Sampah | Bank Sampah</title>
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
      <a href="logout.php" class="btn btn-outline-light fw-semibold">
        <i class="bi bi-box-arrow-right"></i> Logout
      </a>
    </div>
  </div>
</nav>

<!-- Main Container -->
<div class="container py-5">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold text-success mb-0">
      <i class="bi bi-list-ul"></i> Daftar Jenis Sampah
    </h3>
    <a href="add_sampah.php" class="btn btn-success fw-semibold shadow-sm">
      <i class="bi bi-plus-circle"></i> Tambah
    </a>
  </div>

  <div class="card shadow-lg border-0 rounded-4">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table align-middle table-hover">
          <thead class="table-success text-center">
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Harga per Kg</th>
              <th>Deskripsi</th>
              <th>Foto</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php $no=1; while($row = $result->fetch_assoc()): ?>
            <tr>
              <td class="text-center"><?= $no++; ?></td>
              <td><?= htmlspecialchars($row['nama']); ?></td>
              <td>Rp<?= number_format($row['harga_per_kg'], 2, ',', '.'); ?></td>
              <td><?= htmlspecialchars($row['deskripsi']); ?></td>
              <td class="text-center">
                <?php if($row['foto']): ?>
                  <img src="uploads/<?= $row['foto']; ?>" width="70" class="rounded shadow-sm">
                <?php else: ?>
                  <span class="text-muted fst-italic">Belum ada</span>
                <?php endif; ?>
              </td>
              <td class="text-center">
                <a href="edit_sampah.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm rounded-pill px-3 shadow-sm">
                  <i class="bi bi-pencil-square"></i> Edit
                </a>
                <a href="delete_sampah.php?id=<?= $row['id']; ?>" 
                   class="btn btn-danger btn-sm rounded-pill px-3 shadow-sm" 
                   onclick="return confirm('Yakin ingin menghapus data ini?');">
                   <i class="bi bi-trash"></i> Hapus
                </a>
              </td>
            </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
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
