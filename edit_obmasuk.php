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

    $.post("obatdata.php", {
      dataidobat: num,
    }, function(response) {    
        console.log(response);
      document.getElementById('stock').value = response;
      document.getElementById('jumlah_masuk').focus();
    });
  }

  function cek_jumlah_masuk(input) {
    jml = document.formObatMasuk.jumlah_masuk.value;
    var jumlah = eval(jml);
    if(jumlah < 1){
      alert('Jumlah Masuk Tidak Boleh Nol !!');
      input.value = input.value.substring(0,input.value.length-1);
    }
  }

  function hitung_total_stok() {
    bil1 = document.formObatMasuk.stock.value;
    bil2 = document.formObatMasuk.jumlah_masuk.value;

    if (bil2 == "") {
      var hasil = "";
    }
    else {
      var hasil = eval(bil1) + eval(bil2);
    }

    document.formObatMasuk.total_stock.value = (hasil);
  }
</script>


<?php
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: loginapotek.php");
    exit();
  }

include "db.php";


$id_trans = $_GET['idtransaksi'];

// Query untuk mendapatkan data obat berdasarkan ID
$query = "SELECT * FROM ob_masuk WHERE trans_id = '$id_trans'";
$result = mysqli_query($mysqli, $query);
$row = mysqli_fetch_assoc($result);

// Menangani form submit
if (isset($_POST['submit'])) {
    // Mendapatkan data dari form
    $id_trans = $_POST['idtransaksi'];
    $tgl_masuk = $_POST['tglmasuk'];
    $idobat = $_POST['kode_obat'];
    $restock = $_POST['jumlah_masuk'];
    $total_stock = $_POST['total_stock'];

    // Query untuk mengupdate data obat
    $update_query1 = "UPDATE ob_masuk SET entry_date = '$tgl_masuk', drug_id = '$idobat', restock_amount = '$restock' WHERE trans_id = '$id_trans'";
    mysqli_query($mysqli, $update_query1);

    $update_query2 = "UPDATE dt_obat SET stock = '$total_stock' WHERE drug_id = '$idobat'";
    mysqli_query($mysqli, $update_query2);
    
    // Redirect ke halaman dataobat.php setelah data berhasil diupdate
    header("Location: pemasukan.php");
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
        crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="home.css">
    <link rel="stylesheet" type="text/css" href="fontawesome-free-6.4.0-web/css/all.min.css">
    <link rel="icon" href="hitam.png" type="image/png">

    <title>Edit Data</title>
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
                    <a class="nav-link active text-white" href="index.php"><i class="fa-solid fa-house mr-2"></i>Beranda</a><hr class="bg-secondary">
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="pembelian.php"><i class="fa-solid fa-cart-shopping mr-2"></i>Pembelian Obat</a><hr class="bg-secondary">
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="dataobat.php"><i class="fa-solid fa-tablets mr-2"></i>Data Obat</a><hr class="bg-secondary">
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="pemasukan.php"><i class="fa-solid fa-box mr-2"></i>Pemasukan Obat</a><hr class="bg-secondary">
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="laporan.php"><i class="fa-solid fa-file mr-2"></i>Laporan Transaksi</a><hr class="bg-secondary">
                </li>
            </ul>
        </div>
        <div class="col-md-10 p-5 pt-2">
            <h3><i class="fa-solid fa-box mr-2"></i>Edit Pemasukan Obat</h3>
            <hr>
            <form method="POST" name="formObatMasuk">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-2">
                            <label>ID Transaksi</label>
                        </div>
                        <div class="col-md-10">
                            <input type="text" name="idtransaksi" class="form-control" value="<?php echo $row['trans_id']; ?>" readonly>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                        <div class="row">
                            <div class="col-md-2">
                                <label>Tanggal Masuk</label>
                            </div>
                            <div class="col-md-10">
                                <input type="date" name="tglmasuk" class="form-control" value="<?php echo $row['entry_date']; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-2">
                                <label>Obat</label>
                            </div>
                            <div class="col-md-10">
                            <select class="chosen-select" name="kode_obat" data-placeholder="-- Pilih Obat --" onchange="tampil_obat(this)" autocomplete="off" required>
                                <?php
                                $query_obat = mysqli_query($mysqli, "SELECT drug_id, drug_name FROM dt_obat ORDER BY drug_name ASC")
                                    or die('Ada kesalahan pada query tampil obat: '.mysqli_error($mysqli));
                                while ($data_obat = mysqli_fetch_assoc($query_obat)) {
                                    $selected = ($data_obat['drug_id'] == $idobat) ? 'selected' : '';
                                    echo "<option value=\"$data_obat[drug_id]\" $selected> $data_obat[drug_id] | $data_obat[drug_name] </option>";
                                }
                                ?>
                            </select>

                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-2">
                                <label>Stok</label>
                            </div>
                            <div class="col-md-10">
                                <input type="text" class="form-control" id="stock" name="stock" value="<?php echo isset($row['stock']) ? $row['stock'] : ''; ?>" readonly required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-2">
                                <label>Jumlah Masuk</label>
                            </div>
                            <div class="col-md-10">
                                <input type="text" class="form-control" id="jumlah_masuk" name="jumlah_masuk" autocomplete="off" oninput="hitung_total_stok()" onchange="cek_jumlah_masuk(this)" required value="<?php echo $row['restock_amount']; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-2">
                                <label>Total Stok</label>
                            </div>
                            <div class="col-md-10">
                             <input type="text" class="form-control" id="total_stock" name="total_stock" readonly required>
                            </div>
                        </div>
                    </div>
                    <div class="text-right form-action">
                        <button type="submit" name="submit" class="btn custom-btn-color mr-3">UPDATE</button>
                        <a href="pemasukan.php" class="btn btn-dark">BATAL</a>
                    </div>  
            </form>
        </div>
    </body>
</html>
