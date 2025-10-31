<?php include('../config/db.php'); ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Kalkulator Bank Sampah</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="bg-light">

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

<div class="container mt-5 mb-5">
  <h2 class="text-center mb-4 fw-bold text-success">Kalkulator Bank Sampah</h2>
  
  <form action="result.php" method="POST" class="card p-4 shadow-lg border-0 rounded-4 mx-auto" style="max-width: 600px;">
    <div class="mb-3">
      <label for="jenis" class="form-label fw-semibold">Jenis Sampah</label>
      <select name="jenis" id="jenis" class="form-select rounded-pill" required>
        <option value="">-- Pilih Jenis Sampah --</option>
        <?php
          $result = $conn->query("SELECT * FROM jenis_sampah");
          while ($row = $result->fetch_assoc()) {
            echo "<option value='{$row['id']}' data-harga='{$row['harga_per_kg']}'>{$row['nama']} - Rp{$row['harga_per_kg']}/kg</option>";
          }
        ?>
      </select>
    </div>

    <div class="mb-3">
      <label for="berat" class="form-label fw-semibold">Jumlah (Kg)</label>
      <input type="number" name="berat" id="berat" class="form-control rounded-pill" min="0.1" step="0.1" required placeholder="Masukkan berat sampah...">
    </div>

    <!-- Rekomendasi otomatis tampil di sini -->
    <div id="rekomendasi"></div>

    <button type="submit" class="btn btn-success w-100 mt-3 fw-semibold rounded-pill shadow-sm">
      <i class="bi bi-calculator"></i> Hitung Total
    </button>
  </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const beratInput = document.getElementById('berat');
  const jenisSelect = document.getElementById('jenis');
  const rekomDiv = document.getElementById('rekomendasi');

  function hitungRekomendasi() {
    const berat = parseFloat(beratInput.value);
    const harga = parseFloat(jenisSelect.options[jenisSelect.selectedIndex]?.getAttribute('data-harga'));

    if (!isNaN(berat) && !isNaN(harga)) {
      const total = berat * harga;
      rekomDiv.innerHTML = `
        <div class="alert alert-info mt-3 rounded-3 shadow-sm">
          💡 Estimasi nilai sampah kamu adalah <strong>Rp${total.toLocaleString('id-ID')}</strong>.
        </div>`;
    } else {
      rekomDiv.innerHTML = "";
    }
  }

  beratInput.addEventListener('input', hitungRekomendasi);
  jenisSelect.addEventListener('change', hitungRekomendasi);
});

function flashHighlight(element) {
  element.style.transition = "background 0.5s";
  element.style.background = "#d4edda"; // hijau lembut
  setTimeout(() => element.style.background = "transparent", 600);
}

document.getElementById('berat').addEventListener('input', function() {
  flashHighlight(this);
});
document.getElementById('jenis').addEventListener('change', function() {
  flashHighlight(this);
});

</script>

<!-- Footer -->
<footer class="text-center py-3 text-muted small">
  © <?= date('Y'); ?> Bank Sampah Indonesia 🌿
</footer>


</body>
</html>
