<?php
include "db.php";
session_start();

// Query untuk mendapatkan ID obat terakhir
$query = "SELECT MAX(trans_id) AS max_id FROM ob_masuk";
$result = mysqli_query($mysqli, $query);
$row = mysqli_fetch_assoc($result);
$max_id = $row['max_id'];

// Menentukan ID obat baru
if ($max_id === null) {
    $new_id = 'TOM001';
} else {
    $new_id = 'TOM' . str_pad((intval(substr($max_id, 3)) + 1), 3, '0', STR_PAD_LEFT);
}

// Menangani form submit
if (isset($_POST['submit'])) {
    // Mendapatkan data dari form
    $id_trans = $_POST['idtransaksi'];
    $tgl_masuk = $_POST['tglmasuk'];
    $idobat = $_POST['kode_obat'];
    $restock = $_POST['jumlah_masuk'];
    $total_stock = $_POST['total_stock'];


    // Query untuk menyimpan data ke tabel obat
    $insert_query = "INSERT INTO ob_masuk (trans_id, entry_date, drug_id, restock_amount) 
                     VALUES ('$new_id', '$tgl_masuk', '$idobat', '$restock')";
    mysqli_query($mysqli, $insert_query);

    $update_query = "UPDATE dt_obat SET stock = '$total_stock' WHERE drug_id = '$idobat'";
    mysqli_query($mysqli, $update_query);
    // Redirect ke halaman dataobat.php setelah data berhasil ditambahkan
    header("Location: pemasukan.php");
    exit();
}
?>

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
      }
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

        <title>Tambah Data</title>
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
                    <a class="nav-link text-white" href="pembelian.php"><i class="fa-solid fa-cart-shopping mr-2"></i>Pembelian Obat</a>
                    <hr class="custom-bg-color">
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="dataobat.php"><i class="fa-solid fa-tablets mr-2"></i>Data Obat</a>
                    <hr class="custom-bg-color">
                </li>
                <li class="nav-item">
                    <a class="nav-link active text-white" style="background-color:#60a585;" href="pemasukan.php"><i class="fa-solid fa-box mr-2"></i>Pemasukan Obat</a>
                    <hr class="custom-bg-color" style="height: 1.5px;">
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="laporan.php"><i class="fa-solid fa-file mr-2"></i>Laporan Transaksi</a>
                    <hr class="custom-bg-color">
                </li>
            </ul>
            </div>
            <div class="col-md-10 p-5 pt-2">
                <h3><i class="fa-solid fa-box mr-2"></i>Obat Masuk</h3><hr>
                <form method="POST" name="formObatMasuk">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-2">
                                <label>ID Transaksi</label>
                            </div>
                            <div class="col-md-10">
                                <input type="text" name="idtransaksi" class="form-control" value="<?php echo $new_id; ?>" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-2">
                                <label>Tanggal Masuk</label>
                            </div>
                            <div class="col-md-10">
                                <input type="date" name="tglmasuk" class="form-control">
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
                                        echo"<option value=\"$data_obat[drug_id]\"> $data_obat[drug_id] | $data_obat[drug_name] </option>";
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
                             <input type="text" class="form-control" id="stock" name="stock" readonly required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-2">
                                <label>Jumlah Masuk</label>
                            </div>
                            <div class="col-md-10">
                             <input type="text" class="form-control" id="jumlah_masuk" name="jumlah_masuk" autocomplete="off" onKeyPress="return goodchars(event,'0123456789',this)" onkeyup="hitung_total_stok(this)&cek_jumlah_masuk(this)" required>
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
                        <button type="submit" name="submit" class="btn custom-btn-color mr-3">TAMBAH</button>
                        <button type="reset" class="btn btn-danger">RESET</button>
                    </div>  
            </form>
        </div>
    </body>
</html>