<?php
// Import file "db.php" untuk menggunakan koneksi database
require_once 'db.php';

// Fungsi untuk mengambil total hasil dari tabel dt_transaksi
function getTransaksiCount() {
  global $mysqli;

  $query = "SELECT COUNT(*) AS total FROM dt_transaksi";
  $result = $mysqli->query($query);
  $row = $result->fetch_assoc();
  $total = $row['total'];

  return $total;
}

// Fungsi untuk mengambil total hasil dari tabel dt_obat
function getObatCount() {
  global $mysqli;

  $query = "SELECT COUNT(*) AS total FROM dt_obat";
  $result = $mysqli->query($query);
  $row = $result->fetch_assoc();
  $total = $row['total'];

  return $total;
}

// Fungsi untuk mengambil total hasil dari tabel ob_masuk
function getPemasukanCount() {
  global $mysqli;

  $query = "SELECT COUNT(*) AS total FROM ob_masuk";
  $result = $mysqli->query($query);
  $row = $result->fetch_assoc();
  $total = $row['total'];

  return $total;
}

// Fungsi untuk mengambil total hasil dari tabel dt_transaksi untuk laporan penjualan
function getLaporanPenjualanCount() {
  global $mysqli;

  $query = "SELECT COUNT(*) AS total FROM dt_transaksi";
  $result = $mysqli->query($query);
  $row = $result->fetch_assoc();
  $total = $row['total'];

  return $total;
}

// Fungsi-fungsi lain yang diperlukan
// ...
?>
