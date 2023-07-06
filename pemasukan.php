<?php
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: loginapotek.php");
    exit();
}


include "db.php";

$query = "SELECT * FROM ob_masuk";
$result = mysqli_query($mysqli, $query);

if (isset($_GET['hapus'])) {
    $id_trans = $_GET['hapus'];

    // Query untuk menghapus data obat
    $delete_query = "DELETE FROM ob_masuk WHERE trans_id = '$id_trans'";
    mysqli_query($mysqli, $delete_query);

    // Setelah berhasil menghapus data, Anda dapat melakukan tindakan lain, seperti mengarahkan pengguna kembali ke halaman yang sesuai.
    // Misalnya:
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
            <h3><i class="fa-solid fa-box mr-2"></i></i>DAFTAR PEMASUKAN OBAT</h3>
            <hr>
            <a href="obatmasuk.php" class="btn custom-btn custom-btn-color mb-4" style="width: 140px;"><i class="fa-solid fa-plus mr-2"></i><b>Tambah</b></a>
            <table class="table table-bordered table-centered">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">ID Transaksi</th>
                        <th scope="col">Tanggal Masuk</th>
                        <th scope="col">ID Obat</th>
                        <th scope="col">Jumlah Masuk</th>
                        <th colspan="3" scope="col">Aksi</th>
                    </tr>
                <tbody>
                    <?php
                    while ($data = mysqli_fetch_assoc($result)) {
                    ?>
                        <tr>
                            <td> <?php echo $data['trans_id'] ?></td>
                            <td> <?php echo $data['entry_date'] ?></td>
                            <td> <?php echo $data['drug_id'] ?></td>
                            <td> <?php echo $data['restock_amount'] ?></td>
                            <td>
                                <a href="edit_obmasuk.php?idtransaksi=<?php echo $data['trans_id']; ?>">
                                    <button class="btn btn-success" type="button" title="Edit">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                </a>
                            </td>
                            <td>
                                <a href="pemasukan.php?hapus=<?php echo $data['trans_id']; ?>">
                                    <button class="btn btn-danger" type="button" title="Delete">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
                </thead>
            </table>
        </div>
    </div>
</body>

</html>