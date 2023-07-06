<?php
session_start();
require_once('db.php');

// fungsi untuk melakukan pengecekan kredensial pengguna
function authenticateUser($username, $password, $mysqli)
{
    // Query untuk memeriksa username dan password pada tabel us_admin
    $query = "SELECT * FROM us_admin WHERE username = '$username' AND password = '$password'";
    $result = $mysqli->query($query);

    if ($result && $result->num_rows == 1) {
        $_SESSION['logged_in'] = true; // Simpan status login ke dalam sesi
        return true;
    } else {
        return false;
    }
}

// Memeriksa apakah pengguna telah mengirimkan data login
if (isset($_POST['proses'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Memeriksa kredensial pengguna dengan menggunakan fungsi authenticateUser
    if (authenticateUser($username, $password, $mysqli)) {
        // Jika kredensial valid, redirect pengguna ke halaman dashboard
        header("Location: dashboard.php");
        exit();
    } else {
        // Jika kredensial tidak valid, menampilkan popup
        echo "<script>alert('Username atau password salah.');</script>";
    }
}
?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="login.css">
  <link rel="stylesheet" type="text/css" href="fontawesome-free-6.4.0-web/css/all.min.css">

  <title>Login Admin</title>


</head>

<body style="background-color: #93e5ab;">
    
      <div class="container" style="margin-top: 150px; width: 500px;display: grid; grid-template-columns: 1fr 3fr; padding: 0px; background-color: white; border-radius: 15px; border: 1px solid #4e876c;">
        <div style="background: conic-gradient(from 180deg at 50% 50%, rgba(255, 255, 255, 1) 0%, rgba(78, 135, 108, 1) 0%, rgba(147, 229, 171, 1) 100%); border-radius: 13px;">
          <img src="putih.png" alt="Gambar" style="width: 40px; height: 40px; margin-left: 44px; margin-top: 20px;">
          <a style="font-size: 20px; display: flex; justify-content: center; color: white; text-shadow: 0.8px 0.8px 1px black;">FarmaCare</a>
        </div>
      
        <div>
        <h4 class="text-center mt-4 mb-3" style="color: #4e876c;">ADMIN LOGIN ^o^ </h4>

        <form action="loginapotek.php" method="POST">
          <div class="form-group ml-3 mr-3">
            <label>Username</label>

            <div class="input-group">
              <div class="input-group-prepend">
                <div class="input-group-text"  style="background-color: #93e5ab;"><i class="fas fa-user" style="color: #4e876c;"></i></div>
              </div>
                <input type="text" name="username" class="form-control" style="border-width: 1.5px; border-color: #93e5ab;" placeholder="Masukkan Username Anda">
            </div>
          </div>

          <div class="form-group ml-3 mr-3">
            <label>Password</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <div class="input-group-text"  style="background-color: #93e5ab;"><i class="fas fa-unlock-alt" style="color: #4e876c;"></i></div>
              </div>
            <input type="password" name="password" class="form-control" style="border-width: 1.5px; border-color: #93e5ab;" placeholder="Masukkan Password Anda"> 
            </div>
          </div>
          
          <button type="submit" class="btn btn-success ml-3 mt-3 mb-4 mr-2" style="width: 162px;" name="proses">SUBMIT</button> 
          <button type="reset" class="btn btn-danger mt-3 mb-4 mr-3" style="width: 162px;">RESET</button>
        </form>
        </div>
      </div>



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.6/dist/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
  </body>
</html>