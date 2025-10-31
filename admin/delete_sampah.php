<?php
session_start();
if(!isset($_SESSION['admin'])) { header("Location: login.php"); exit; }
include('../config/db.php');

$id = $_GET['id'];
$result = $conn->query("SELECT foto FROM jenis_sampah WHERE id='$id'");
$data = $result->fetch_assoc();

// Hapus file foto jika ada
if ($data && $data['foto'] && file_exists("uploads/" . $data['foto'])) {
    unlink("uploads/" . $data['foto']);
}

// Hapus data dari database
$conn->query("DELETE FROM jenis_sampah WHERE id='$id'");

header("Location: manage_sampah.php");
exit;
?>
