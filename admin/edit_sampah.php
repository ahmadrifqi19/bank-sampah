<?php
session_start();
if(!isset($_SESSION['admin'])) { header("Location: login.php"); exit; }
include('../config/db.php');

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM jenis_sampah WHERE id='$id'");
$data = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = trim($_POST['nama']);
    $deskripsi = trim($_POST['deskripsi']);
    $harga = floatval($_POST['harga_per_kg']);
    $foto = $data['foto']; // default: tidak ganti foto

    // Jika ada foto baru
    if (!empty($_FILES['foto']['name'])) {
        // Hapus foto lama jika ada
        if ($foto && file_exists("uploads/$foto")) {
            unlink("uploads/$foto");
        }
        $target_dir = "uploads/";
        $foto = time() . "_" . basename($_FILES["foto"]["name"]);
        $target_file = $target_dir . $foto;
        move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file);
    }

    $stmt = $conn->prepare("UPDATE jenis_sampah SET nama=?, deskripsi=?, harga_per_kg=?, foto=? WHERE id=?");
    $stmt->bind_param("ssdsi", $nama, $deskripsi, $harga, $foto, $id);
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
  <title>Edit Jenis Sampah | Bank Sampah</title>
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
      <i class="bi bi-pencil-square"></i> Edit Jenis Sampah
    </h3>

    <form method="POST" enctype="multipart/form-data">
      <div class="mb-3">
        <label class="form-label fw-semibold">Nama Sampah</label>
        <input type="text" name="nama" class="form-control rounded-pill" value="<?= htmlspecialchars($data['nama']); ?>" required>
      </div>

      <div class="mb-3">
        <label class="form-label fw-semibold">Deskripsi</label>
        <textarea name="deskripsi" class="form-control rounded-3" rows="3"><?= htmlspecialchars($data['deskripsi']); ?></textarea>
      </div>

      <div class="mb-3">
        <label class="form-label fw-semibold">Harga per Kg (Rp)</label>
        <input type="number" name="harga_per_kg" class="form-control rounded-pill" step="0.01" value="<?= $data['harga_per_kg']; ?>" required>
      </div>

      <div class="mb-3 text-center">
        <label class="form-label fw-semibold d-block">Foto Saat Ini</label>
        <?php if($data['foto']): ?>
          <img src="uploads/<?= $data['foto']; ?>" width="120" class="rounded shadow-sm mb-3">
        <?php else: ?>
          <p class="text-muted fst-italic">Belum ada foto</p>
        <?php endif; ?>
        <label class="form-label fw-semibold">Ganti Foto (Opsional)</label>
        <input type="file" name="foto" class="form-control rounded-pill mt-2">
      </div>

      <div class="text-center mt-4">
        <button type="submit" class="btn btn-success px-4 py-2 fw-semibold rounded-pill shadow-sm">
          <i class="bi bi-save"></i> Simpan Perubahan
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
