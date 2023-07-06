<?php  
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: loginapotek.php");
    exit();
  }
  

include "db.php";

// Query untuk mendapatkan ID obat terakhir
$query = "SELECT MAX(drug_id) AS max_id FROM dt_obat";
$result = mysqli_query($mysqli, $query);
$row = mysqli_fetch_assoc($result);
$max_id = $row['max_id'];

// Menentukan ID obat baru
if ($max_id === null) {
    $new_id = 'DRG001';
} else {
    $new_id = 'DRG' . str_pad((intval(substr($max_id, 3)) + 1), 3, '0', STR_PAD_LEFT);
}

// Menangani form submit
if (isset($_POST['submit'])) {
    // Mendapatkan data dari form
    $nama_obat = $_POST['nama_obat'];
    $harga_beli = $_POST['harga_beli'];
    $harga_jual = $_POST['harga_jual'];
    $tipe = $_POST['tipe'];

    // Query untuk menyimpan data ke tabel obat
    $insert_query = "INSERT INTO dt_obat (drug_id, drug_name, buy_price, sell_price, type) 
                     VALUES ('$new_id', '$nama_obat', '$harga_beli', '$harga_jual', '$tipe')";
    mysqli_query($mysqli, $insert_query);

    // Redirect ke halaman dataobat.php setelah data berhasil ditambahkan
    header("Location: dataobat.php");
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
                    <a class="nav-link text-white" href="dashboard.php"><i class="fa-solid fa-house mr-2"></i>Beranda</a>
                    <hr class="custom-bg-color">
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="pembelian.php"><i class="fa-solid fa-cart-shopping mr-2"></i>Pembelian Obat</a>
                    <hr class="custom-bg-color">
                </li>
                <li class="nav-item">
                    <a class="nav-link active text-white" style="background-color:#60a585;" href="dataobat.php"><i class="fa-solid fa-tablets mr-2"></i>Data Obat</a>
                    <hr class="custom-bg-color" style="height: 1.5px;">
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
            <div class="col-md-10 p-5 pt-2">
                <h3><i class="fa-solid fa-tablets mr-2"></i>Tambah Data Obat</h3><hr>
                <form method="POST">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-2">
                                <label>ID Obat</label>
                            </div>
                            <div class="col-md-10">
                                <input type="text" name="id" class="form-control" value="<?php echo $new_id; ?>" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-2">
                                <label>Nama Obat</label>
                            </div>
                            <div class="col-md-10">
                                <select class="form-control" name="nama_obat">
                                    <option disabled selected>Pilih Obat</option>
                                    <option> Albendazol </option>
                                    <option> Alopurinol </option>
                                    <option> Alprazolam </option>
                                    <option> Amilorida </option>
                                    <option> Aminofilin </option>
                                    <option> Amoxicillin </option>
                                    <option> Anastan Forte </option>
                                    <option> Antangin JRG </option>
                                    <option> Arthemeter </option>
                                    <option> Asam Folat </option>
                                    <option> Asam Mefenat </option>
                                    <option> Asiklovir krim 5% </option>
                                    <option> Asiklovir tablet 200 mg </option>
                                    <option> Asiklovir tablet 400 mg </option>
                                    <option> Atropin Sulfat Tablet </option>
                                    <option> Atropin Sulfat Tetes Mata </option>
                                    <option> Azatioprin Tablet 50 mg </option>
                                    <option> Balsem Lang </option>
                                    <option> Benazepril </option>
                                    <option> Benzolac </option>
                                    <option> Betadine </option>
                                    <option> Betametason krim 0,1% </option>
                                    <option> Betametason tablet 0,5 mg </option>
                                    <option> Bisoprolol </option>
                                    <option> Bisfosfonat </option>
                                    <option> Bromheksin </option>
                                    <option> Bodrex </option>
                                    <option> Cetirizine </option>
                                    <option> Clobetasol </option>
                                    <option> Dapson </option>
                                    <option> Deksametason </option>
                                    <option> Diazepam </option>
                                    <option> Digoksin </option>
                                    <option> Domperidon </option>
                                    <option> Famotidine </option>
                                    <option> Fenitoin </option>
                                    <option> Gemfibrozil </option>
                                    <option> Gentamisin </option>
                                    <option> Glipzid </option>
                                    <option> Gliserin </option>
                                    <option> Glukosa larutan infus </option>
                                    <option> Haloperidol </option>
                                    <option> Ibuprofen </option>
                                    <option> Ketoprofin </option>
                                    <option> Ketorolac </option>
                                    <option> Klomifen </option>
                                    <option> Klonidin </option>
                                    <option> Konidin </option>
                                    <option> Levamisol </option>
                                    <option> Linkomisin </option>
                                    <option> Meloksikam </option>
                                    <option> Metampiron </option>
                                    <option> Metronidazol </option>
                                    <option> Neomisin </option>
                                    <option> Nevirapin </option>
                                    <option> OBH </option>
                                    <option> Oseltamivir </option>
                                    <option> Paracetamol </option>
                                    <option> Piracetam </option>
                                    <option> Risperidon </option>
                                    <option> Salicyl Bedak </option>
                                    <option> Sefiksim </option>
                                    <option> Sulfadiazin </option>
                                    <option> Sulfasazalin </option>
                                    <option> Teofilin </option>
                                    <option> Tiamin </option>
                                    <option> Tramadol </option>
                                    <option> Trimetoprim </option>
                                    <option> Valproat </option>
                                    <option> Vitamin B </option>
                                    <option> Zidovudin </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-2">
                                <label>Harga Beli</label>
                            </div>
                            <div class="col-md-10">
                                <input type="text" name="harga_beli" class="form-control" placeholder="Masukkan Harga Beli">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-2">
                                <label>Harga Jual</label>
                            </div>
                            <div class="col-md-10">
                                <input type="text" name="harga_jual" class="form-control" placeholder="Masukkan Harga Jual">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-2">
                            <label>Tipe</label>
                            </div>
                            <div class="col-md-10">
                                <select class="form-control" name="tipe">
                                    <option disabled selected>Pilih Tipe Obat</option>
                                    <option> Strip </option>
                                    <option> Botol </option>
                                    <option> Tube </option>
                                    <option> Box </option>
                                </select>
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