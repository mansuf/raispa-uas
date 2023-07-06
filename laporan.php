<?php
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: loginapotek.php");
    exit();
}

include "db.php";

// Fetch data from dt_transaksi table
$selectTransaksiQuery = "SELECT * FROM dt_transaksi";
$result = mysqli_query($mysqli, $selectTransaksiQuery);
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Tambahkan JavaScript untuk fungsi cetak -->
    <script>
        function cetakLaporan() {
            window.print();
        }
    </script>

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

    <title>Laporan Transaksi</title>
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
                    <a class="nav-link text-white" href="pemasukan.php"><i class="fa-solid fa-box mr-2"></i>Pemasukan Obat</a>
                    <hr class="custom-bg-color">
                </li>
                <li class="nav-item">
                    <a class="nav-link active text-white" style="background-color:#60a585;" href="laporan.php"><i class="fa-solid fa-file mr-2"></i>Laporan Transaksi</a>
                    <hr class="custom-bg-color" style="height: 1.5px;">
                </li>
            </ul>
        </div>
        <div class="container">
            <h2 class="alert custom-alert custom-alert-color text-center mt-4">LAPORAN TRANSAKSI</h2><br>
            <table class="table table-bordered table-centered">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">Nama Pelanggan</th>
                        <th scope="col">Nomor Handphone</th>
                        <th scope="col">Tanggal Transaksi</th>
                        <th scope="col">Jumlah Obat</th>
                        <th scope="col">Nama Obat</th>
                        <th scope="col">Tipe</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($data = mysqli_fetch_assoc($result)) {
                    ?>
                        <tr>
                            <td><?php echo $data['cus_name']; ?></td>
                            <td><?php echo $data['phone_num']; ?></td>
                            <td><?php echo $data['tgltransaksi']; ?></td>
                            <td><?php echo $data['drug_amount']; ?></td>
                            <td><?php echo $data['drug_name']; ?></td>
                            <td><?php echo $data['drug_type']; ?></td>
                            <td><?php echo $data['unit_price']; ?></td>
                            <td><?php echo $data['ttl_price']; ?></td>
                        </tr>
                    <?php
                    }
                    ?>

                </tbody>
            </table>
            <div class="text-right">
                <button class="btn btn-primary" onclick="cetakLaporan()">
                    <i class="fa-solid fa-print"></i> Cetak
                </button>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7f83Wy8LGsHnR9sEY+8E/5lvn6q4ZpOJtkf9V4yfE6QC1fBHV" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0pSFf3Vo3gBqG9+gFqzdz+K5p+60MWBxEpF3gxhrlj4cpw+qF86f8Knj5mW" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>