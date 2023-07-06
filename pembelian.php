<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script type="text/javascript">
    function getkey(e)
      {
        if (window.event)
          return window.event.keyCode;
        else if (e)
          return e.which;
        else
          return null;
      }
    
    function goodchars(e, goods, field)
      {
        var key, keychar;
        key = getkey(e);
        if (key == null) return true;
       
        keychar = String.fromCharCode(key);
        keychar = keychar.toLowerCase();
        goods = goods.toLowerCase();
       
        // check goodkeys
        if (goods.indexOf(keychar) != -1)
            return true;
        // control keys
        if ( key==null || key==0 || key==8 || key==9 || key==27 )
          return true;
          
        if (key == 13) {
          var i;
          for (i = 0; i < field.form.elements.length; i++)
            if (field == field.form.elements[i])
              break;
          i = (i + 1) % field.form.elements.length;
          field.form.elements[i].focus();
          return false;
        };
        // else return false
        return false;
      };

</script>
<script type="text/javascript">
  function tampil_obat(input){
    var num = input.value;
    console.log(num);

    $.post("hargapembelian.php", {
      dataharga: num,
    }, function(response) {    
        console.log(response);
      document.getElementById('harga').value = response;
      document.getElementById('jumlahobat').focus();
    });
  }

  function cek_jumlah_masuk(input) {
    jml = document.formPembelian.jumlahobat.value;
    var jumlah = eval(jml);
    if(jumlah < 1){
      alert('Jumlah Masuk Tidak Boleh Nol !!');
      input.value = input.value.substring(0,input.value.length-1);
    }
  }

  function hitung_total_stok() {
    bil1 = document.formPembelian.harga.value;
    bil2 = document.formPembelian.jumlahobat.value;

    if (bil2 == "") {
      var hasil = "";
    }
    else {
      var hasil = parseInt(bil1) * parseInt(bil2);
    }

    document.formPembelian.total.value = (hasil);
  }
</script>

<?php
session_start();
// Periksa apakah pengguna sudah login
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
  header("Location: loginapotek.php");
  exit();
}

include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Retrieve form data
  $nama_pelanggan = $_POST['nama'];
  $nomor_handphone = $_POST['telp'];
  $alamat = $_POST['alamat'];
  $penyakit = $_POST['penyakit'];
  $jumlah_obat = $_POST['jumlahobat'];
  $nama_obat = $_POST['namaobat'];
  $tipe_obat = $_POST['tipeobat'];
  $harga_obat = $_POST['harga'];
  $total_harga = $_POST['total'];
  $tanggal_transaksi = $_POST['tgltrans'];

  
  // Insert into customer table
  $insertCustomerQuery = "INSERT INTO customer (cus_name, phone_num, alamat, penyakit, tgltransaksi) 
                          VALUES ('$nama_pelanggan', '$nomor_handphone', '$alamat', '$penyakit', '$tanggal_transaksi')";
  mysqli_query($mysqli, $insertCustomerQuery);

  $update = "UPDATE dt_obat SET stock = stock - $jumlah_obat WHERE drug_name = '$nama_obat'";
  mysqli_query($mysqli, $update);

  // Insert into dt_transaksi table
  $insertTransaksiQuery = "INSERT INTO dt_transaksi (cus_name, phone_num, tgltransaksi, drug_amount, drug_name, drug_type, unit_price, ttl_price) 
                           VALUES ('$nama_pelanggan', '$nomor_handphone', '$tanggal_transaksi', '$jumlah_obat', '$nama_obat', '$tipe_obat', $harga_obat, '$total_harga')";
  mysqli_query($mysqli, $insertTransaksiQuery);

  header("Location: laporan.php");
  exit();
}
?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="home.css">
  <link rel="stylesheet" type="text/css" href="fontawesome-free-6.4.0-web/css/all.min.css">
  <link rel="icon" href="hitam.png" type="image/png">

  <script>
    function logout() {
      // Tampilkan pesan konfirmasi
      var result = confirm("Apakah anda yakin ingin logout?");

      // Jika pengguna mengklik "OK", lakukan logout
      if (result) {
        window.location.href = "logout.php";
      }
    }
  </script>

  <title>Pembelian Obat</title>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light custom-bg-color fixed-top">
        <img src="./putih.png" alt="Logo" width="40" height="40" class="mr-2">
        <a class="navbar-brand" href="#"><b style="color: black; text-shadow: 1px 1px 1px white; font-size: 24px;">FarmaCare</b></a>
        <div class="icon navbar-nav ml-auto">
            <h5>
                <i class="fa-solid fa-right-from-bracket custom-icon" data-toggle="tooltip" title="Logout" onclick="logout()"></i>
            </h5>
        </div>
    </nav>

  <div class="row no-gutters mt-5">
    <div class="col-md-2 bg-green  mt-2 pr-3 pt-4">
      <ul class="nav flex-column ml-3 mb-5">
        <li class="nav-item">
          <a class="nav-link text-white" href="index.php"><i class="fa-solid fa-house mr-2"></i>Beranda</a>
          <hr class="custom-bg-color">
        </li>
        <li class="nav-item">
          <a class="nav-link active text-white" style="background-color:#60a585;" href="pembelian.php"><i class="fa-solid fa-cart-shopping mr-2"></i>Pembelian Obat</a>
          <hr class="custom-bg-color" style="height: 1.5px;">
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="dataobat.php"><i class="fa-solid fa-tablets mr-2"></i>Data Obat</a>
          <hr class="custom-bg-color">
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="pemasukan.php"><i class="fa-solid fa-box mr-2"></i>Pemasukan Obat</a>
          <hr class="custom-bg-color">
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="laporan.php"><i class="fa-solid fa-file mr-2"></i>Laporan Transaksi</a>
          <hr class="custom-bg-color">
        </li>
      </ul>
    </div>
    <div class="container">
      <h2 class="alert custom-alert custom-alert-color text-center mt-4">FORMULIR PEMBELIAN OBAT</h2>
      <br>

      <form method="POST" class="custom-form" name="formPembelian">
        <div class="form-group mt-3">
          <div class="row">
            <div class="col-md-3">
              <label>Nama Pelanggan</label>
            </div>
            <div class="col-md-9">
              <input type="text" name="nama" class="form-control" placeholder="Masukkan Nama Pelanggan">
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="row">
            <div class="col-md-3">
              <label>Nomor Handphone</label>
            </div>
            <div class="col-md-9">
              <input type="text" name="telp" class="form-control" placeholder="Masukkan Nomor Handphone">
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="row">
            <div class="col-md-3">
              <label>Alamat</label>
            </div>
            <div class="col-md-9">
              <input type="text" name="alamat" class="form-control" placeholder="Masukkan Alamat Pelanggan">
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="row">
            <div class="col-md-3">
              <label>Penyakit</label>
            </div>
            <div class="col-md-9">
              <input type="text" name="penyakit" class="form-control" placeholder="Masukkan Penyakit Pelanggan">
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="row">
            <div class="col-md-3">
              <label>Nama Obat</label>
            </div>
            <div class="col-md-9">
              <select class="form-control" name="namaobat" onchange="tampil_obat(this)" autocomplete="off" required>
              <option value="" disabled selected>-Pilih Obat-</option>
              <?php
                $query_obat = mysqli_query($mysqli, "SELECT drug_id, drug_name FROM dt_obat ORDER BY drug_name ASC")
                    or die('Ada kesalahan pada query tampil obat: '.mysqli_error($mysqli));
                while ($data_obat = mysqli_fetch_assoc($query_obat)) {
                    $selected = ($data_obat['drug_id'] == $idobat) ? 'selected' : '';
                    echo "<option value=\"$data_obat[drug_name]\" $selected> $data_obat[drug_name] </option>";
                }
                ?>
              </select>
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="row">
            <div class="col-md-3">
              <label>Jumlah Obat</label>
            </div>
            <div class="col-md-9">
              <select class="form-control" name="jumlahobat" id="jumlahobat" autocomplete="off" oninput="hitung_total_stok()" onchange="cek_jumlah_masuk(this)">
                <option disabled selected>-Pilih Jumlah Obat-</option>
                <option> 1 </option>
                <option> 2 </option>
                <option> 3 </option>
                <option> 4 </option>
                <option> 5 </option>
                <option> 6 </option>
                <option> 7 </option>
                <option> 8 </option>
                <option> 9 </option>
                <option> 10 </option>
              </select>
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="row">
            <div class="col-md-3">
              <label>Tipe</label>
            </div>
            <div class="col-md-9">
              <select class="form-control" name="tipeobat" id="tipeobat">
                <option disabled selected>-Pilih Tipe Obat-</option>
                <option> Strip </option>
                <option> Botol </option>
                <option> Tube </option>
                <option> Box </option>
              </select>
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="row">
            <div class="col-md-3">
              <label>Harga Obat</label>
            </div>
            <div class="col-md-9">
              <input type="text" name="harga" id="harga" class="form-control" readonly required>
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="row">
            <div class="col-md-3">
              <label>Total</label>
            </div>
            <div class="col-md-9">
              <input type="text" name="total" id="total" class="form-control" readonly required>
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="row">
            <div class="col-md-3">
              <label>Tanggal Transaksi</label>
            </div>
            <div class="col-md-9">
              <input type="date" name="tgltrans" class="form-control">
            </div>
          </div>
        </div>

        <div class="text-right">
          <button type="submit" class="btn custom-btn-color mr-3 mb-2">SIMPAN</button>
          <button type="reset" class="btn btn-danger mb-2">RESET</button>
        </div>
      </form>
    </div>
  </div>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.6/dist/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</body>

</html>