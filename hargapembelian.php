<?php
session_start();
// Periksa apakah pengguna sudah login
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
  header("Location: loginapotek.php");
  exit();
}

// Panggil koneksi database.php untuk koneksi database
require_once "db.php";

if(isset($_POST['dataharga'])) {
  $nama_obat = $_POST['dataharga'];

  // Lakukan query untuk mengambil harga obat berdasarkan nama obat
  $query = mysqli_query($mysqli, "SELECT sell_price FROM dt_obat WHERE drug_name='$nama_obat'")
    or die('Ada kesalahan pada query tampil harga obat: '.mysqli_error($mysqli));

  // Ambil data harga
  $data = mysqli_fetch_assoc($query);
  if(is_null($data)){
    echo "harga oba non";
  }
  else{
  $harga_jual = $data['sell_price'];
  echo "$harga_jual";
  }
	
}
?>
