<?php
session_start();

// Panggil koneksi database.php untuk koneksi database
require_once "db.php";

if(isset($_POST['dataidobat'])) {
	$drug_id = $_POST['dataidobat'];

  // fungsi query untuk menampilkan data dari tabel obat
  $query = mysqli_query($mysqli, "SELECT drug_id,drug_name,stock FROM dt_obat WHERE drug_id='$drug_id'")
                                  or die('Ada kesalahan pada query tampil data obat: '.mysqli_error($mysqli));

  // tampilkan data
  $data = mysqli_fetch_assoc($query);

  $stock   = $data['stock'];

	if($stock != '') {
		echo "$stock";
	} else {
		echo "stock obat tidak ada";
	}		
}
?> 