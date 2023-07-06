<?php
session_start();

require_once 'realstock.php';

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
  header("Location: loginapotek.php");
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

  <title>Dashboard Administrasi Apotek</title>
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
          <a class="nav-link active text-white" style="background-color:#60a585;" href="index.php"><i class="fa-solid fa-house mr-2"></i>Beranda</a>
          <hr class="custom-bg-color" style="height: 1.5px;">
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
          <a class="nav-link text-white" href="laporan.php"><i class="fa-solid fa-file mr-2"></i>Laporan Transaksi</a>
          <hr class="custom-bg-color">
        </li>
      </ul>
    </div>
    <div class="col-md-10 p-5 pt-2">
      <h3>
        <i class="fa-solid fa-house mr-2"></i>BERANDA
      </h3>
      <hr>
      <h5><b>Selamat datang di sistem administrasi apotek!</b></h5>
      <br>

      <div class="row text-black">
        <div class="card custom-bg-color ml-5 mb-5" style="width: 18rem; background-color: #42d9d2;">
          <div class="card-body">
            <div class="card-body-icon">
              <i class="fa-solid fa-cart-shopping mr-2"></i>
            </div>
            <h5 class="card-title"><b>PEMBELIAN OBAT</b></h5>
            <div class="display-4"><?php echo getTransaksiCount(); ?></div>
            <a href="pembelian.php">
              <p class="card-text text-black-50">Details <i class="fas fa-angle-double-right ml-2"></i></p>
            </a>
          </div>
        </div>

        <div class="card custom-bg-color ml-5 mb-5" style="width: 18rem; background-color: #ceb6cf;">
          <div class="card-body">
            <div class="card-body-icon">
              <i class="fa-solid fa-tablets mr-2"></i>
            </div>
            <h5 class="card-title"><b>JENIS OBAT</b></h5>
            <div class="display-4"><?php echo getObatCount(); ?></div>
            <a href="dataobat.php">
              <p class="card-text text-black-50">Details <i class="fas fa-angle-double-right ml-2"></i></p>
            </a>
          </div>
        </div>

        <div class="card custom-bg-color ml-5 mb-5" style="width: 18rem; background-color: #FCAE87;">
          <div class="card-body">
            <div class="card-body-icon">
              <i class="fa-solid fa-box mr-2"></i>
            </div>
            <h5 class="card-title"><b>PEMASUKAN OBAT</b></h5>
            <div class="display-4"><?php echo getPemasukanCount(); ?></div>
            <a href="pemasukan.php">
              <p class="card-text text-black-50">Details <i class="fas fa-angle-double-right ml-2"></i></p>
            </a>
          </div>
        </div>

        <div class="card custom-bg-color ml-5 mb-5" style="width: 18rem; background-color: #FCF187;">
          <div class="card-body">
            <div class="card-body-icon">
              <i class="fa-solid fa-file mr-2"></i>
            </div>
            <h5 class="card-title"><b>LAPORAN PENJUALAN</b></h5>
            <div class="display-4"><?php echo getLaporanPenjualanCount(); ?></div>
            <a href="laporan.php">
              <p class="card-text text-black-50">Details <i class="fas fa-angle-double-right ml-2"></i></p>
            </a>
          </div>
        </div>
                  
      </div>
      <footer class="footer py-1"
      style="position: fixed; font-size: 14px; bottom: 0; left: 0; width: 100%; border-top: 0.5px solid grey; background-color: #E6FFEA; color: #898989; text-align: right;">
    <b>COPYRIGHT &copy; 2023  |  DEVELOPED BY </b><b href="" style="color: #3785FF;">HILMEN   .</b>
    </footer>

      <!-- Optional JavaScript -->
      <!-- jQuery first, then Popper.js, then Bootstrap JS -->
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
      <script type="text/javascript" src="home.js"></script>
</body>

</html>