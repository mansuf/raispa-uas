<?php
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: loginapotek.php");
    exit();
  }

include "db.php";

// Mendapatkan ID obat yang akan diedit dari parameter URL
$id_obat = $_GET['id'];

// Query untuk mendapatkan data obat berdasarkan ID
$query = "SELECT * FROM dt_obat WHERE drug_id = '$id_obat'";
$result = mysqli_query($mysqli, $query);
$row = mysqli_fetch_assoc($result);

// Menangani form submit
if (isset($_POST['submit'])) {
    // Mendapatkan data dari form
    $nama_obat = $_POST['nama_obat'];
    $harga_beli = $_POST['harga_beli'];
    $harga_jual = $_POST['harga_jual'];
    $tipe = $_POST['tipe'];

    // Query untuk mengupdate data obat
    $update_query = "UPDATE dt_obat SET drug_name = '$nama_obat', buy_price = '$harga_beli', sell_price = '$harga_jual', type = '$tipe' WHERE drug_id = '$id_obat'";
    mysqli_query($mysqli, $update_query);

    // Redirect ke halaman dataobat.php setelah data berhasil diupdate
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
                        <a class="nav-link active text-white" href="dashboard.php"><i class="fa-solid fa-house mr-2"></i>Beranda</a><hr class="bg-secondary">
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
                <h3><i class="fa-solid fa-tablets mr-2"></i>Edit Data Obat</h3>
                <hr>
                <form method="POST">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-2">
                                <label>ID Obat</label>
                            </div>
                            <div class="col-md-10">
                                <input type="text" name="id" class="form-control" value="<?php echo $row['drug_id']; ?>" readonly>
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
                                    <option <?php if ($row['drug_name'] == 'Albendazol') echo 'selected'; ?>>Albendazol</option>
                                    <option <?php if ($row['drug_name'] == 'Alopurinol') echo 'selected'; ?>>Alopurinol</option>
                                    <option <?php if ($row['drug_name'] == 'Alprazolam') echo 'selected'; ?>>Alprazolam</option>
                                    <option <?php if ($row['drug_name'] == 'Amilorida') echo 'selected'; ?>>Amilorida</option>
                                    <option <?php if ($row['drug_name'] == 'Aminofilin') echo 'selected'; ?>>Aminofilin</option>
                                    <option <?php if ($row['drug_name'] == 'Amoxicillin') echo 'selected'; ?>>Amoxicillin</option>
                                    <option <?php if ($row['drug_name'] == 'Anastan Forte') echo 'selected'; ?>>Anastan Forte</option>
                                    <option <?php if ($row['drug_name'] == 'Antangin JRG') echo 'selected'; ?>>Antangin JRG</option>
                                    <option <?php if ($row['drug_name'] == 'Arthemeter') echo 'selected'; ?>>Arthemeter</option>
                                    <option <?php if ($row['drug_name'] == 'Asam Folat') echo 'selected'; ?>>Asam Folat</option>
                                    <option <?php if ($row['drug_name'] == 'Asam Mefenat') echo 'selected'; ?>>Asam Mefenat</option>
                                    <option <?php if ($row['drug_name'] == 'Asiklovir krim 5%') echo 'selected'; ?>>Asiklovir krim 5%</option>
                                    <option <?php if ($row['drug_name'] == 'Asiklovir tablet 200 mg') echo 'selected'; ?>>Asiklovir tablet 200 mg</option>
                                    <option <?php if ($row['drug_name'] == 'Asiklovir tablet 400 mg') echo 'selected'; ?>>Asiklovir tablet 400 mg</option>
                                    <option <?php if ($row['drug_name'] == 'Atropin Sulfat Tablet') echo 'selected'; ?>>Atropin Sulfat Tablet</option>
                                    <option <?php if ($row['drug_name'] == 'Atropin Sulfat Tetes Mata') echo 'selected'; ?>>Atropin Sulfat Tetes Mata</option>
                                    <option <?php if ($row['drug_name'] == 'Azatioprin Tablet 50 mg') echo 'selected'; ?>>Azatioprin Tablet 50 mg</option>
                                    <option <?php if ($row['drug_name'] == 'Balsem Lang') echo 'selected'; ?>>Balsem Lang</option>
                                    <option <?php if ($row['drug_name'] == 'Benazepril') echo 'selected'; ?>>Benazepril</option>
                                    <option <?php if ($row['drug_name'] == 'Benzolac') echo 'selected'; ?>>Benzolac</option>
                                    <option <?php if ($row['drug_name'] == 'Betadine') echo 'selected'; ?>>Betadine</option>
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
                                <input type="text" name="harga_beli" class="form-control" value="<?php echo $row['buy_price']; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-2">
                                <label>Harga Jual</label>
                            </div>
                            <div class="col-md-10">
                                <input type="text" name="harga_jual" class="form-control" value="<?php echo $row['sell_price']; ?>">
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
                                    <option disabled selected>Pilih Tipe</option>
                                    <option <?php if ($row['type'] == 'Strip') echo 'selected'; ?>>Strip</option>
                                    <option <?php if ($row['type'] == 'Botol') echo 'selected'; ?>>Botol</option>
                                    <option <?php if ($row['type'] == 'Tube') echo 'selected'; ?>>Tube</option>
                                    <option <?php if ($row['type'] == 'Box') echo 'selected'; ?>>Box</option>
                                </select>
                            </div>
                        </div>
                    </div>

                                <div class="text-right">
                                    <button type="submit" name="submit" class="btn custom-btn-color mr-3">UPDATE</button>
                                    <a href="dataobat.php" class="btn btn-dark">BATAL</a>
                                </div>
                </form>
            </div>
        </div>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0r2UAM5Wz/WkZcSxqew0iPkfo9A5g4xBz+99gqFqZ1ktwEfo/1x"
            crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
            integrity="sha384-UO2eT0Iq5nL+9a1H8mgdygfgRg20pZxZloxpznXP+2lF+IgNom5C1X4ZKejmW+Tp"
            crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUc2tJW7kS2bF/+ALaFqNkNv4abtTEr1+SQ7I4it7LvMG"
            crossorigin="anonymous"></script>
    </body>

</html>
